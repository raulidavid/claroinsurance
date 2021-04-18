<?php
namespace Madsis\User\Http\Controllers;

use Illuminate\Http\Request;
use Madsis\User\Repositories\TeamRepository;
use Madsis\User\Repositories\UserRepository;
use Madsis\User\Services\UserService;
use Madsis\User\Models\Team;
use Route;
use Auth;
use Log;
class TeamController extends Controller
{
    private $route;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    public function  __construct(
        UserRepository $userRepository,
        TeamRepository $teamRepository
    ){
        $this->route = Route::currentRouteName();
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
    }
    public function index(){
        return view('seguridad.RolPermissions')->with('route',$this->route);
    }

    public function descendants(Request $request){
        $limit = $request->input('length');
        $start = $request->input('start');
        if($request->User){
            $team = $this->teamRepository->where('name',$request->User)->first();
        }else{
            $team = $this->teamRepository->where('name',auth()->user()->id)->first();
        }
        $totalData = $this->teamRepository->whereDescendantOrSelf($team)
            ->join('users', 'users.id', 'name')
            ->where('users.is_active','1')
            ->orderBy('name', 'asc')
            ->count();
        $team = $this->teamRepository->whereDescendantOrSelf($team)
            ->join('users', 'users.id', 'name')
            ->where('users.is_active','1')
            ->offset($start)
            ->limit($limit)
            ->orderBy('name', 'asc')
            ->get();
        $descendants = $team;
        // dd($descendants);
        $totalFiltered = $totalData;
        $consulta = [];
        if(!$team->isEmpty()) {
            foreach ($descendants as $descendant) {
                $userinfo = $this->userRepository->Info($descendant->name);
                $consulta [] = $userinfo;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $consulta
        );
        return $json_data;
    }

    public function migrate(){
        $users = $this->userRepository->select('id','usuariopadre')->orderby('id')->get();
        foreach ($users as $user){
            $this->teamRepository->create(['name' => $user->id,]);
        }
        foreach ($users as $user){
            $node = $this->teamRepository->where('name',$user->id)->first();
            $parent = $this->teamRepository->where('name',$user->usuariopadre)->first();
            $node->parent()->associate($parent)->save();
        }
    }
}
