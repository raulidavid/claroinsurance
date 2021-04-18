<?php

namespace Madsis\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Madsis\Contact\Models\Contact;
use Madsis\Contact\Repositories\ContactRepository;
use Madsis\Contact\Requests\ContactRequest;
use Madsis\Contact\Services\ContactService;
use Madsis\Sales\Repositories\OrderRepository;
use Route;

class ContactController extends Controller
{
    protected $orderRepository, $route;
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    public function  __construct(
        OrderRepository $orderRepository,
        ContactRepository $contactRepository
    ){
        $this->route = Route::currentRouteName();
        $this->orderRepository = $orderRepository;
        $this->contactRepository = $contactRepository;
    }
    public function index(){
        return view('tthh.contact')
            ->with('route',$this->route)
            ;
    }
    public function store(ContactRequest $request){
        $contact = new ContactService();
        return response()->json($contact->Store($request),201);
    }
    public function getContact($contact){
        $temp = $this->contactRepository->where('CTODOCUMENTO', $contact)->firstOrfail();
        $contact = new ContactService();
        return $contact->Info($temp->CTOID);
    }
    public function getContacts(Request $request){
        $limit = $request->input('length');
        $start = $request->input('start');
        $Buscar = $request->input('Buscar');
        $MySales = $this->contactRepository->select('CTOID')
            ->offset($start)
            ->limit($limit)
            ->orderBy('CTOID','ASC')
            ->get();
        $totalData = $this->contactRepository->count();
        $totalFiltered = $totalData;

        if (!empty($Buscar)) {
            $MySales = $this->contactRepository->where('CTONOMBRES', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('CTOAPELLIDOS', 'LIKE', "%".strtoupper($Buscar)."%")
                ->orwhere('CTOEMAIL', 'LIKE', "%".strtolower($Buscar)."%")
                ->select(['CTOID'])
                ->offset($start)
                ->limit($limit)
                ->orderBy('CTOID','ASC')
                ->get();
            $totalFiltered = $MySales->count();
        }
        $usuarios = [];
        if(!$MySales->isEmpty()){
            foreach ($MySales as $MySale){
                $data = new ContactService();
                $data = $data->Info($MySale->CTOID);
                $usuarios[] = $data;
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

    public function ValidateCustomers(Request $request){
        return response()->json('NO OPERATIVO', 200);
        $data = $request->all();

        //$this->validate($request, ['Filtro' => new FilterOrders($request)]);
        $default = $this->paymentRepository->filters(['Date' => $data]);
        $totalFiltered = $default->count();
        $totalData = $totalFiltered;

        $sales = $this->paymentRepository->filters([
            'Date' => $data,
            'Paginate'=> $data,
            'Payment' => ($data['Filtro'] == 'DEPOSITO' && $data['Buscar'] != null) ? $data : null,
        ])->get();

        $usuarios = [];
        if(!$sales->isEmpty()){
            foreach ($sales as $sale){
                $usuarios[] = $this->orderRepository->Info($sale->order()->first()->ORDID);
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
