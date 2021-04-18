<?php
namespace Madsis\Postulant\Services;

use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Http\Request;
use Illuminate\Database\DatabaseManager as DB;
use Madsis\Postulant\Repositories\PostulantRepository;
use Madsis\Postulant\Models\Postulant;
use stdClass;
use Hashids\Hashids;
use Madsis\User\Repositories\UserRepository;

class PostulantService{

    protected $request,$postulant;
    /**
     * @var DB
     */
    private $db;
    /**
     * @var PostulantRepository
     */
    private $postlantRepository;
    /**
     * @var Storage
     */
    private $fs;

    public function  __construct(
        PostulantRepository $postulantRepository,
        UserRepository $userRepository,
        Storage $fs,
        DB $db
    ){
        $this->postlantRepository = $postulantRepository;
        $this->userRepository = $userRepository;
        $this->fs = $fs;
        $this->postulant = new stdClass;
        $this->db = $db;
    }

    public function Store(Request $request){
        $this->userRepository->store($request->all());

        $this->db->beginTransaction();
        try {
            $postulant = new Postulant;
            $postulant->PTLCONTACTED = FALSE;
            $postulant->PTLNOMBRES = $request->nombres;
            $postulant->PTLAPELLIDOS = $request->apellidos;
            $postulant->PTLUSERNAME = $this->CheckAvailableUsername($request);
            $postulant->PTLEMAIL = $request->email;
            $postulant->PTLNDOCUMENTO = $request->ndocumento;
            $postulant->PTLFECNACIMIENTO = $request->fecnacimiento;
            $postulant->PTLDIRECCION = $request->direccion;
            $postulant->PTLPROVINCIA = $request->provincia;
            $postulant->PTLCANTON = $request->canton;
            $postulant->PTLPARROQUIA = $request->parroquia;
            $postulant->PTLCELULAR = $request->telfmovil;
            $postulant->save();
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            throw $e;
        } catch (\Throwable $e) {
            $this->db->rollback();
            throw $e;
        }

        return response('Gracias '.$request->nombres.' hemos recibido tu postulación exitosamente, te contactaremos en la brevedad posible',201);
    }

    function randomChars($str, $numChars){
        return substr(str_shuffle($str), 0, $numChars);
    }

    private function CheckAvailableUsername($request){
        $hashids = new Hashids($request->nombres.$request->apellidos,9);
        $random = rand(1, 15);
        $username = $hashids->encode((int)($request->ndocumento),$random);
        $randomcharacter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomcharacter = $this->randomChars($randomcharacter, 1);
        return $randomcharacter.$username;
    }

    private function StorePostulantImage($request,$username){
        $path = 'siecstorage/postulantefotos/'.$username;
        $imagen = $request->imagen;
        $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagen));
        $this->fs->disk('public')->put($path.'/foto.jpg',$imagen);
        $imagenperfil = $request->input('imagen-profile');
        $imagenperfil = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenperfil));
        $this->fs->disk('public')->put($path.'/fotoperfil.jpg',$imagenperfil);
    }

    private function StoreHojaVida($request,$username){
        $path = '/siecstorage/postulantefotos/'.$username;
        $extension = $request->hojavida->getClientOriginalExtension();
        $this->fs->disk('public')->putFileAs($path, $request->hojavida, 'HojaVida.'.$extension);
        $pathhojavida = '/storage'.$path.'/HojaVida.'.$extension;
        return $pathhojavida;
    }

    public function Info($postulant){

        $postulant = $this->postlantRepository->find($postulant);
    
        $this->postulant = new stdClass;
        $this->postulant->PTLID = $postulant->PTLID;
        $this->postulant->PTLCONTACTADO = $postulant->PTLCONTACTED;
        $this->postulant->PTLACCION = '<a href="/Postulant/View/' . $postulant->PTLID . '/show?Postulant='.$postulant->PTLID.'" class="btn btn-primary btn-xs">Aprobar</a>';
        $this->postulant->PTLNOMBRES = $postulant->PTLNOMBRES;
        $this->postulant->PTLAPELLIDOS = $postulant->PTLAPELLIDOS;
        $this->postulant->PTLEMAIL = $postulant->PTLEMAIL;
        $this->postulant->PTLNDOCUMENTO = $postulant->PTLNDOCUMENTO;
        $this->postulant->PTLFECNACIMIENTO = $postulant->PTLFECNACIMIENTO;
        $this->postulant->PTLEDAD = core()->CustomCarbon(core()->formatDate($postulant->PTLFECNACIMIENTO, 'Y-m-d'))->age.' AÑOS';
        
        
        $this->postulant->PTLPROVINCIA = (object)['id'=>$postulant->provincia()->first()->id,'nombre'=>$postulant->provincia()->first()->nombre];
        $this->postulant->PTLCANTON = (object)['id'=>$postulant->canton()->first()->id,'nombre'=>$postulant->canton()->first()->nombre];
        $this->postulant->PTLPARROQUIA = (object)['id'=>$postulant->parroquia()->first()->id,'nombre'=>$postulant->parroquia()->first()->nombre];
        $this->postulant->PTLESTADOPOSTULANTE = (object)['id'=>$postulant->estadopostulante()->first()->id,'nombre'=>$postulant->estadopostulante()->first()->nombre];
        $this->postulant->PTLCELULAR = $postulant->PTLCELULAR;
        $this->postulant->PTLUSERNAME = $postulant->PTLUSERNAME;
        return $this->postulant;
    }

}