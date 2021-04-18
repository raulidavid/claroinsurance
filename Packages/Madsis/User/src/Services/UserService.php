<?php
namespace Madsis\User\Services;

use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Support\Facades\Mail;
use Madsis\Postulant\Repositories\PostulantRepository;
use Madsis\User\Repositories\UserRepository;
use SIEC\Mail\MailApprovedPostulant;
use SIEC\Mail\MailCreatedUser;
use Illuminate\Support\Arr;
use Madsis\User\Models\User;
use Madsis\User\Models\Identificacion;
use Madsis\User\Models\Team;
use Carbon\Carbon;
use stdClass;
use Storage;
use File;


class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PostulantRepository
     */
    private $postulantRepository;
    /**
     * @var DB
     */
    private $db;

    public function __construct(
        UserRepository $userRepository,
        PostulantRepository $postulantRepository,
        DB $db
    ){
        $this->userRepository = $userRepository;
        $this->postulantRepository = $postulantRepository;
        $this->db = $db;
    }

    public function store(Request $request){
        $postulant = $this->postulantRepository->find($request->postulant);
        $postulant->delete();
        $this->db->beginTransaction();
        try {
            $user = new User;
            $user->is_active = 1;
            $user->password = bcrypt($request->PTLNDOCUMENTO);
            $user->email = strtolower($request->emailempresarial);
            $user->nombres = $request->PTLNOMBRES;
            $user->apellidos = $request->PTLAPELLIDOS;
            $user->username = $request->PTLUSERNAME;
            $user->usuariopadre = $request->userfather;
            $user->save();
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
        try {
            $identificacion = new Identificacion();
            $identificacion->USUID = $user->id;
            $identificacion->CATTIPODOCUMENTO = $request->PTLTIPODOCUMENTO;
            $identificacion->CATNACIONALIDAD = $request->PTLNACIONALIDAD;
            $identificacion->IDTNDOCUMENTO = $request->PTLNDOCUMENTO;
            $identificacion->CATGENERO = $request->PTLGENERO;
            $identificacion->CATESTADOCIVIL = $request->PTLESTADOCIVIL;
            $identificacion->IDTFECNACIMIENTO = date('Y-m-d', strtotime($request->PTLFECNACIMIENTO));
            $identificacion->IDTFECINGRESO = date('Y-m-d', strtotime(Carbon::now()));
            $identificacion->IDTIMGURL = str_replace("postulantefotos", "userfotos", $request->PTLIMGURL);
            $identificacion->IDTHOJAVIDAURL = str_replace("postulantefotos", "userfotos", $request->PTLHOJAVIDAURL);
            $identificacion->IDTCELULAR = $request->PTLCELULAR;
            $identificacion->IDTTELEFONO = $request->PTLTELEFONO;
            $identificacion->IDTDIRECCION = $request->PTLDIRECCION;
            $identificacion->UBCPROVINCIA = $request->PTLPROVINCIA;
            $identificacion->UBCCANTON = $request->PTLCANTON;
            $identificacion->UBCPARROQUIA = $request->PTLPARROQUIA;
            $identificacion->IDTNOTAS = $request->obsuser;
            $identificacion->save();
        } catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
        $this->db->commit();
        return response("Usuario Creado Correctamente!",201);
    }

    public function Update($request){
        $user = $this->userRepository->where('id',$request->User)->first();
        if($request->UsuarioPadre!=null){
            $node = Team::where('name',$request->User)->first();
            $parent = Team::where('name',$request->UsuarioPadre)->first();
            $node->parent()->associate($parent)->save();
        }
        $data = [];
        if($request->obsuser!=null){
            $user->identificacion()
                ->update([
                    'IDTNOTAS'=> $request->obsuser,
                ]);
        }
        if($request->Activo!=null){
            $activo = ["is_active" => $request->Activo];
            array_push($data,$activo);
            $data = ["UsuarioPadre" => "$request->UsuarioPadre", "is_active" => $request->Activo];
        }
        if($request->Activo!=null){
            $usuariopadre = ["usuariopadre" => $request->UsuarioPadre];
            array_push($data,$usuariopadre);
        }
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function UpdateUser($request){
        $user = $this->userRepository->where('id',$request->USRID)->exists();
        if ($user==true) {
            $user = $this->userRepository->where('id',$request->USRID)->first();
            $user->is_active = 1;
            $user->password = bcrypt($request->PTLNDOCUMENTO);
            $user->email = $request->emailempresarial;
            $user->nombres = $request->PTLNOMBRES;
            $user->apellidos = $request->PTLAPELLIDOS;
            $user->username = $request->PTLUSERNAME;
            $user->usuariopadre = $request->userfather;
            $user->save();
            return response(["Usuario Actualizado Correctamente!",$user],201);
        }
        return response("Usuario no existe!",200);
    }

    public function UpdateIdentificacion($request){
        $request = array_filter($request->all());
        $USRID = $request['USRID'];
        $USERNAME = $this->userRepository->where('id',$USRID)->first()->username;
        $IDTIMGURL = '/storage/siecstorage/userfotos/'.$USERNAME.'/';

        $request = Arr::except($request,['_token','USRID','imagen','imagen-profile']);
        $request = Arr::add( $request, 'IDTIMGURL', $IDTIMGURL);

        $identificacion = Identificacion::where('USUID',$USRID)->exists();
        if($identificacion==true){
            Identificacion::where('USUID',$USRID)->update($request);
            return response('Usuario Actualizado Correctamente', 200)
                ->header('Content-Type', 'text/plain');
        }
        return response('Usuario No entontrado!!!', 204)
            ->header('Content-Type', 'text/plain');
    }

    public function Info($id){
        $user = User::find($id);

        $userinfo = new stdClass;
        $userinfo->USERID = $user->id;
        $userinfo->CATNACIONALIDAD = ['id'=>$user->identificacion()->first()->nacionalidad()->first()->id,'nombre'=>$user->identificacion()->first()->nacionalidad()->first()->nombre];
        $userinfo->CATTIPOIDENTIFICACION = ['id'=>$user->identificacion()->first()->tipo_identificacion()->first()->id,'nombre'=>$user->identificacion()->first()->tipo_identificacion()->first()->nombre];
        $userinfo->IDTNDOCUMENTO = $user->identificacion()->first()->IDTNDOCUMENTO;
        $userinfo->USERNOMBRES = $user->nombres;
        $userinfo->USERAPELLIDOS = $user->apellidos;
        $userinfo->USERUSUARIO = $user->username;
        $userinfo->USEREMAIL = $user->email;
        $userinfo->USERACTIVE = $user->is_active;
        $userinfo->IDTFECNACIMIENTO = $user->identificacion()->first()->IDTFECNACIMIENTO;
        $userinfo->USEREDAD = Carbon::parse($userinfo->IDTFECNACIMIENTO)->age.' AÑOS';
        $userinfo->IDTDIRECCION = $user->identificacion()->first()->IDTDIRECCION;
        $userinfo->IDTTELEFONO = $user->identificacion()->first()->IDTTELEFONO;
        $userinfo->IDTCELULAR = $user->identificacion()->first()->IDTCELULAR;
        $userinfo->IDTNOTAS = $user->identificacion()->first()->IDTNOTAS;

        if($user->identificacion()->first()->provincia()->first()!=null){
            $userinfo->IDTPROVINCIA = (object)['id'=>$user->identificacion()->first()->provincia()->first()->id,'nombre'=>$user->identificacion()->first()->provincia()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTCANTON = (object)['id'=>$user->identificacion()->first()->canton()->first()->id,'nombre'=>$user->identificacion()->first()->canton()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTPARROQUIA = (object)['id'=>$user->identificacion()->first()->parroquia()->first()->id,'nombre'=>$user->identificacion()->first()->parroquia()->first()->nombre];
        }

        //$userinfo->USERSONS = User::select('id')->where('usuariopadre',$user->id)->count();
        $userinfo->IDTIMGPROFILESMALL = $user->identificacion()->first()->IDTIMGURL;
        $userinfo->IDTCOMPLETE = $this->Complete($user);
        $userinfo->IDTHOJAVIDAURL = $user->identificacion()->first()->IDTHOJAVIDAURL;
        $userinfo->ACTIONEDITARUSUARIO =  '<button type="button" data-user="'.$userinfo->USERID.'" class="UserEdit btn btn-warning btn-xs">Editar</button>';
        

        if($user->identificacion()->first()->CATESTADOCIVIL!=null){
            $userinfo->CATESTADOCIVIL = ['id'=>$user->identificacion()->first()->est_civil->id,'nombre'=>$user->identificacion()->first()->est_civil->nombre];
        }
        if($user->identificacion()->first()->CATGENERO!=null){
            $userinfo->CATGENERO = ['id'=>$user->identificacion()->first()->tipo_genero->id,'nombre'=>$user->identificacion()->first()->tipo_genero->nombre];
        }
        return $userinfo;
    }

    private function Complete($user){
        $fields = [
            'UBCPROVINCIA',
            'UBCCANTON',
            'UBCPARROQUIA',
            'CATGENERO',
            'CATESTADOCIVIL',
            'IDTFECNACIMIENTO',
            'IDTCELULAR',
            'IDTTELEFONO',
            'IDTDIRECCION',
        ];

        $identificaciones = $user->identificacion()->select("IDTIMGURL")->first();
        if($identificaciones->IDTIMGURL=='/images/user/'){
            return false;
        }
        $identificaciones = $user->identificacion()->select($fields)->first();
        foreach ($identificaciones->getAttributes() as $identificacion){
            if($identificacion==null){
                return false;
            }
        }
        return true;
    }

    public function descendants($user){

        $team = Team::where('name',$user->id)->first();

        $descendants = Team::whereDescendantOrSelf($team)
            ->orderBy('name', 'asc')
            ->count();
        return $descendants;

    }
}
