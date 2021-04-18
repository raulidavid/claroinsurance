<?php

namespace Madsis\User\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Madsis\Postulant\Requests\CreatePostulantRequest;
use Madsis\Postulant\Services\PostulantService;
use Madsis\User\Repositories\UserRepository;
use SIEC\Services\UserStore;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';
    /**
     * @var PostulantService
     */
    private $postulantService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        PostulantService $postulantService,
        UserRepository $userRepository
    )
    {
        parent::__construct();
        $this->middleware('guest');
        $this->postulantService = $postulantService;
        $this->userRepository = $userRepository;
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data){
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(CreatePostulantRequest $request){
            return $this->userRepository->Store($request);
    }

    public function index()
    {
        return view($this->_config['view']);
    }
}
