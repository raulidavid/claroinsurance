<?php

namespace Madsis\User\Repositories;

use Carbon\Carbon;
use Illuminate\Container\Container as Application;
use Illuminate\Database\DatabaseManager as DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Madsis\Core\Eloquent\Repository;
use Madsis\Postulant\Repositories\PostulantRepository;
use Madsis\User\Models\Identificacion;
use Hashids\Hashids;
use Madsis\User\Models\User;
use stdClass;
use Prettus\Repository\Traits\CacheableRepository;

class UserRepository extends Repository
{
    use CacheableRepository;

    /**
     * @var TeamRepository
     */
    private $teamRepository;
    /**
     * @var PostulantRepository
     */
    private $postulantRepository;
    /**
     * @var DB
     */
    private $db;

    public function __construct(
        Application $app,
        TeamRepository $teamRepository,
        PostulantRepository $postulantRepository,
        DB $db
    )
    {
        parent::__construct($app);
        $this->teamRepository = $teamRepository;
        $this->postulantRepository = $postulantRepository;
        $this->db = $db;
    }

    function model()
    {
        return User::class;
    }

    public function Info($id){
        $user = $this->model->where('id',$id)->first();

        $userinfo = new stdClass;
        $userinfo->USERID = $user->id;
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

        if($user->identificacion()->first()->provincia()->first()!=null){
            $userinfo->IDTPROVINCIA = (object)['id'=>$user->identificacion()->first()->provincia()->first()->id,'nombre'=>$user->identificacion()->first()->provincia()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTCANTON = (object)['id'=>$user->identificacion()->first()->canton()->first()->id,'nombre'=>$user->identificacion()->first()->canton()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTPARROQUIA = (object)['id'=>$user->identificacion()->first()->parroquia()->first()->id,'nombre'=>$user->identificacion()->first()->parroquia()->first()->nombre];
        }
    
        $userinfo->ACTIONEDITARUSUARIO =  '<button type="button" data-user="'.$userinfo->USERID.'" class="UserEdit btn btn-warning btn-xs">Editar</button>';

        $userinfo->ACTIONELIMINARUSUARIO = html_entity_decode('<form action="/User/Eliminar/'.$userinfo->USERID.'" method="POST">
        
        <button type="submit" class="btn btn-danger btn-xs" title="Borrar">Borrar</button>
        </form>');
        //$userinfo->ACTIONELIMINARUSUARIO =  '<button type="button" data-user="'.$userinfo->USERID.'" class="UserEliminar btn btn-danger btn-xs">Eliminar</button>';
        
        return $userinfo;
    }

    

    public function descendants($user){

        $team = $this->teamRepository->where('name',$user->id)->first();

        $descendants = $this->teamRepository->whereDescendantOrSelf($team)
            ->orderBy('name', 'asc')
            ->count();
        return $descendants;

    }

    public function UserUpdate($request){
        $data = $request->all();
        $user = $this->where('id',$request->User)->first();
        
        
        //$data = [];
        
        if($request->Activo!=null){
            $activo = ["is_active" => $request->Activo];
            array_push($data,$activo);
            $data = ["UsuarioPadre" => "$request->UsuarioPadre", "is_active" => $request->Activo];
        }
        
        $user->fill($data);
        $user->save();
        return $user;
    }

    public function UpdateIdentificacion($request){
        $request = array_filter($request->all());
        $USRID = $request['USRID'];
        $USERNAME = $this->where('id',$USRID)->first()->username;
        $IDTIMGURL = '/storage/siecstorage/userfotos/'.$USERNAME.'/';

        if(Arr::has($request, 'imagen')){
            $IMAGELARGE = $request['imagen'];
            $IMAGESMALL = $request['imagen-profile'];
            $this->UpdateUserImage($USERNAME,$IMAGELARGE,$IMAGESMALL);
        }
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


    public function store(Request $request){
        $data = $request->all();
        $this->db->beginTransaction();
        try {
            $user = new User;
            $user->is_active = 1;
            $user->password = bcrypt($data['password']);
            $user->email = strtolower($data['email']);
            $user->nombres = $data['nombres'];
            $user->apellidos = $data['apellidos'];
            $user->username = $this->CheckAvailableUsername($data);
            $user->save();
        }
        catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
        try {
            $identificacion = new Identificacion();
            $identificacion->USUID = $user->id;
            $identificacion->IDTNDOCUMENTO = $data['ndocumento'];
            $identificacion->IDTCELULAR = $data['telfmovil'];
            $identificacion->UBCPROVINCIA = $data['provincia'];
            $identificacion->UBCCANTON = $data['canton'];
            $identificacion->UBCPARROQUIA = $data['parroquia'];
            $identificacion->save();
        } catch(\Exception $e) {
            $this->db->rollback();
            throw $e;
        }
        $this->db->commit();
        return response("Usuario Creado Correctamente!",201);
    }

    private function CheckAvailableUsername($data){
        $hashids = new Hashids($data['nombres'].$data['apellidos'],9);
        $random = rand(1, 15);
        $username = $hashids->encode((int)($data['ndocumento']),$random);
        $randomcharacter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomcharacter = $this->randomChars($randomcharacter, 1);
        return $randomcharacter.$username;
    }

    function randomChars($str, $numChars){
        return substr(str_shuffle($str), 0, $numChars);
    }

}