<?php
namespace Madsis\User\Services;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Madsis\User\Models\User;
use stdClass;
use Storage;
use File;
use Auth;


class TeamService
{

    public function store(Request $request){
        $postulant = Postulant::find($request->postulant);
        $postulant->delete();
        DB::beginTransaction();
        try {
            $user = new User;
            $user->is_active = 1;
            $user->password = bcrypt($request->PTLNDOCUMENTO);
            $user->email = $request->emailempresarial;
            $user->nombres = $request->PTLNOMBRES;
            $user->apellidos = $request->PTLAPELLIDOS;
            $user->username = $request->PTLUSERNAME;
            $user->usuariopadre = $request->userfather;
            $user->save();
        }
        catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }
        try {
            $user->assignRole($request->perfil);
        }
        catch(\Exception $e) {
            DB::rollback();
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
            $identificacion->save();
        } catch(\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        $this->MigratePostulantFolder($request->PTLUSERNAME);
        return response("Usuario Creado Correctamente!",201);
    }

    public function MigratePostulantFolder($USERNAME){
        $SOURCEPATH = '/siecstorage/postulantefotos/'.$USERNAME.'/';
        $DESTINATIONPATH = '/siecstorage/userfotos/'.$USERNAME.'/';
        $success = Storage::disk('public')->move($SOURCEPATH, $DESTINATIONPATH);
        return $success;
    }

    public function Update($request){
        $user = User::where('id',$request->User)->first();
        if ($user->exists()) {
            if($request->Rol!=null){
                $user->assignRole($request->Rol);
            }
            $user->fill(['UsuarioPadre' => $request->UsuarioPadre,'is_active'=>$request->Activo]);
            return $user;
        }else{
            return "Usuario no existe";
        }
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
        $userinfo->RUSROL = ['id'=>$user->roles[0]->id,'nombre'=>$user->roles[0]->name];
        $userinfo->USERACTIVE = $user->is_active;
        $userinfo->IDTFECNACIMIENTO = $user->identificacion()->first()->IDTFECNACIMIENTO;
        $userinfo->USEREDAD = Carbon::parse($userinfo->IDTFECNACIMIENTO)->age.' AÑOS';
        $userinfo->IDTDIRECCION = $user->identificacion()->first()->IDTDIRECCION;
        $userinfo->IDTTELEFONO = $user->identificacion()->first()->IDTTELEFONO;
        $userinfo->IDTCELULAR = $user->identificacion()->first()->IDTCELULAR;
        $userinfo->USERPADRE = (object)['id'=>$user->UsuarioPadre($user->usuariopadre)->id,'nombre'=>$user->UsuarioPadre($user->usuariopadre)->nombres.' '.$user->UsuarioPadre($user->usuariopadre)->apellidos];
        $userinfo->USERDIRECTPERMISSIONS = $user->getDirectPermissions()->toArray();

        if($user->identificacion()->first()->provincia()->first()!=null){
            $userinfo->IDTPROVINCIA = (object)['id'=>$user->identificacion()->first()->provincia()->first()->id,'nombre'=>$user->identificacion()->first()->provincia()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTCANTON = (object)['id'=>$user->identificacion()->first()->canton()->first()->id,'nombre'=>$user->identificacion()->first()->canton()->first()->nombre];
        }
        if($user->identificacion()->first()->canton()->first()!=null){
            $userinfo->IDTPARROQUIA = (object)['id'=>$user->identificacion()->first()->parroquia()->first()->id,'nombre'=>$user->identificacion()->first()->parroquia()->first()->nombre];
        }

        $userinfo->USERSONS = User::select('id')->where('usuariopadre',$user->id)->count();
        $userinfo->IDTIMGPROFILESMALL = $user->identificacion()->first()->IDTIMGURL;

        if(Auth::user()->can('editar-usuario')){
            $userinfo->ACTIONEDITARUSUARIO =  '<button type="button" data-user="'.$userinfo->USERID.'" class="UserEdit btn btn-warning btn-xs">Editar</button>';
        }

        if($user->identificacion()->first()->CATESTADOCIVIL!=null){
            $userinfo->CATESTADOCIVIL = ['id'=>$user->identificacion()->first()->est_civil->id,'nombre'=>$user->identificacion()->first()->est_civil->nombre];
        }
        if($user->identificacion()->first()->CATGENERO!=null){
            $userinfo->CATGENERO = ['id'=>$user->identificacion()->first()->tipo_genero->id,'nombre'=>$user->identificacion()->first()->tipo_genero->nombre];
        }
        return $userinfo;
    }
}
