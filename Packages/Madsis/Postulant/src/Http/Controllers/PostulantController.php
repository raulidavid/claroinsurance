<?php

namespace Madsis\Postulant\Http\Controllers;

use Illuminate\Http\Request;
use Madsis\Api\Rules\PostulantApproved;
use Madsis\Postulant\Repositories\PostulantRepository;
use Madsis\Postulant\Services\PostulantService;
use Collection;
use Madsis\User\Repositories\UserRepository;
use Route;
use Madsis\User\Services\UserService;


class PostulantController extends Controller
{
    protected $route;
    /**
     * @var PostulantService
     */
    private $postulantService;
    /**
     * @var PostulantRepository
     */
    private $postulantRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function  __construct(
        PostulantService $postulantService,
        PostulantRepository $postulantRepository,
        UserRepository $userRepository
    ){
        $this->route = Route::currentRouteName();
        $this->postulantService = $postulantService;
        $this->postulantRepository = $postulantRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('tthh.user')
            ->with('route',$this->route)
            ;
    }

    public function getPostulantInfoById($postulant){
        return response()->json($this->postulantService->Info($postulant['PTLID']),200);
    }

    public function getPostulantsInfo(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $Buscar = $request->input('Buscar');
        $MySales = $this->postulantRepository->select('PTLID')
            ->offset($start)
            ->limit($limit)
            ->orderBy('PTLID','ASC')
            ->get();

        $totalData = $this->postulantRepository->count();
        $totalFiltered = $totalData;

        if (!empty($Buscar)) {
            $MySales = $this->postulantRepository->
                orwhere('PTLNOMBRES', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('PTLAPELLIDOS', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('PTLUSERNAME', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('PTLNDOCUMENTO', 'LIKE', "%".strtolower($Buscar)."%")
                ->orwhere('PTLNDOCUMENTO', 'LIKE', "%".($Buscar)."%")
                ->select('PTLID')
                ->offset($start)
                ->limit($limit)
                ->orderBy('PTLID','ASC')
                ->get();
            $totalFiltered = $MySales->count();
        }
        $usuarios = [];

        if(!$MySales->isEmpty()){
            foreach ($MySales as $MySale){
                $usuarios[] = $this->postulantService->Info($MySale['PTLID']);
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

    public function Approve(Request $request)
    {
        $postulant = $this->postulantRepository->find($request->postulant);
        $request = array_merge($request->all(), $postulant->toArray());
        $storeuser = $this->userRepository->store(new Request($request));
        //$postulant->estado = 117;
        //$postulant->save();
        return $storeuser;
    }
}
