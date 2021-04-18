<?php

namespace Madsis\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager as DB;
use Madsis\Postulant\Requests\CreatePostulantRequest;
use Madsis\User\Repositories\TeamRepository;
use Madsis\User\Repositories\UserRepository;
use Madsis\User\Requests\UpdateUserProfileRequest;
use Route;
use View;


class UserController extends Controller
{
    protected $route, $userRepository;
    /**
     * @var DB
     */
    private $db;
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    public function  __construct(
        UserRepository $userRepository,
        TeamRepository $teamRepository,
        DB $db
    ){
        $this->route = Route::currentRouteName();
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->db = $db;
    }

    public function index(){
        return view('tthh.user')
        ->with('route',$this->route)
        ;
    }

    public function Update(Request $request){
        $updateuser = $this->userRepository->UserUpdate($request);
        return response($updateuser,201);
    }

    public function UpdateUserProfile(UpdateUserProfileRequest $request){
        return $this->userRepository->UpdateIdentificacion($request);
    }

    public function show(User $user){
        return view('tthh.administrar_usuarios.user')
        ->with('route',$this->route)
        ;
    }

    public function getUserInfoById($user){
        $userinfo =  $this->userRepository->Info($user);
        return response()->json($userinfo,200);
    }

    public function getUserSons (Request $request){
        $team = $this->teamRepository->where('name',auth()->user()->id)->first();
        $descendants = $this->teamRepository->whereDescendantOrSelf($team)->orderBy('name', 'asc')->get();
        $consulta = [];
        foreach ($descendants as $descendant){
            $consulta [] = $this->userRepository->Info($descendant->name);
        }
        return response()->json([$consulta,"U"],200);
    }

    public function getSons (Request $request){
        if ($request->search){
            $team = $this->teamRepository->where('name',auth()->user()->id)->first();
            $descendants = $this->teamRepository->whereDescendantOrSelf($team)->orderBy('name', 'asc')->get();
            $owners = [];
            if($descendants->isNotEmpty()) {
                foreach ($descendants as $descendant) {
                    $owners [] = $this->userRepository->Info($descendant->name);
                }
                return response()->json([$owners,"U"],200);
            }
        }

        return response()->json("No existen registros",200);
    }

    public function me(){
        $userinfo = $this->userRepository->Info(auth('api')->id());
        return response()->json($userinfo);
    }

    public function getAuthInfoById(){
        $userinfo = $this->userRepository->Info(auth()->user()->id);
        return response()->json($userinfo,200);
    }

    public function Search(Request $request){
        if ($request->search){
            $consulta = null;
            $request->search = strtoupper($request->search);
            $users = $this->db->table('users')
                ->join('identificaciones', 'users.id', '=', 'identificaciones.USUID')
                //->orwhere('id', '=', "%{$request->search}%")
                ->orwhere('nombres', 'LIKE', "%{$request->search}%")
                ->orwhere('apellidos', 'LIKE', "%{$request->search}%")
                ->orwhere('identificaciones.IDTNDOCUMENTO', 'LIKE', "%{$request->search}%")
                //->select(['users.id', 'users.id as userid'])
                ->select('users.id')
                ->get();

            foreach ($users as $user){
                $userinfo = $this->userRepository->Info($user->id);
                $consulta [] = $userinfo;
            }
            return response()->json($consulta);
        }
        return response()->json("No existen registros");
    }

    public function Eliminar(Request $request)
    {
        $user = $this->userRepository->where('id',$request->id)->first();
        $user->delete();
        return redirect('/home');
    }

    public function getUsuarios(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $Buscar = $request->input('Buscar');
        $MySales = $this->userRepository->join('identificaciones', 'users.id', '=', 'identificaciones.USUID')
            ->where('users.is_active',1)
            ->select('id')
            ->offset($start)
            ->limit($limit)
            ->orderBy('id','ASC')
            ->get();
        $totalData = $this->userRepository->where('is_active',1)->count();
        $totalFiltered = $totalData;

        if (!empty($Buscar)) {
            $MySales = $this->userRepository->join('identificaciones', 'users.id', '=', 'identificaciones.USUID')
                //->where('users.id', '=', "".strtoupper($Buscar)."")
                ->orwhere('users.nombres', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('users.apellidos', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('users.username', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('users.email', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('identificaciones.IDTNDOCUMENTO', 'LIKE', "%".($Buscar)."%")
                ->select('id')
                ->offset($start)
                ->limit($limit)
                ->orderBy('id','ASC')
                ->get();
            $totalFiltered = $MySales->count();
        }
        $usuarios = [];
        if(!$MySales->isEmpty()){
            foreach ($MySales as $MySale){
                $data = $this->userRepository->Info($MySale->id);
                if($data->USERACTIVE == 1){
                    $usuarios[] = $data;
                }
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $usuarios
        );
        return $json_data;
    }
}
