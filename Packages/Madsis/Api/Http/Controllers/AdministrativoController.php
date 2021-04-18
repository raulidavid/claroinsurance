<?php

namespace Madsis\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Madsis\Core\Models\Sesiones;
use Collection;
use Storage;
use Route;
use Auth;
use Log;

class AdministrativoController extends Controller
{
    protected $route;

    public function __construct(){
        $this->route = Route::currentRouteName();
    }

    public function index(){
        return view('seguridad.RolPermissions')
            ->with('route',$this->route);
    }

    public function getConvenios(){
        return core()->getConvenios();
    }

    public function getNacionalidades(){
        return core()->getNacionalidades();
    }

    public function getTiposDocumentos(){
        return core()->getTiposDocumentos();
    }

    public function getEstadoCivil(){
        return core()->getEstadoCivil();
    }

    public function getGeneros(){
        return core()->getGeneros();
    }

    public function getOrdenEstados(){
        return core()->getOrdenEstados();
    }

    public function getParentezco(){
        return core()->getParentezco();
    }

    public function getDocumentosClienteCocina($documentosid){
        return core()->getDocumentosClienteCocina($documentosid);
    }

    public function getEntidadesFinancieras(){
        return core()->getEntidadesFinancieras();
    }

    public function getObsUsuarios() {
        return core()->getObsUsuarios();
    }

    public function getRoutesAngular() {
        return core()->getRoutesAngular();
    }

    public function getDespachos() {
        return core()->getDespachos();
    }

    public function getPerfiles(){
        $array = array(
            "foo" => "bar",
            "bar" => "foo",
        );
        return $array;
    }
    public function getUsersConnected(){
        $usuariosconectados = Sesiones::whereNotNull('user_id')->get();
        return view('seguridad.usuariosconectados')
            ->with('usuariosconectados', $usuariosconectados);
    }
}
