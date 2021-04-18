<?php

namespace Madsis\Contact\Repositories;

use Illuminate\Support\Facades\DB;
use Madsis\Contact\Models\Contact;
use Madsis\Core\Eloquent\Repository;
use Madsis\User\Models\User;

class ContactRepository extends Repository {

    public function model()
    {
        return Contact::class;
    }

    public function Info($contact){
        $contact = Contact::find($contact);
        $contact->CTOTIPONACIONALIDAD = ['id'=>$contact->Nacionalidad()->first()->id,'nombre'=>$contact->Nacionalidad()->first()->nombre];
        $contact->CTOTIPODOCUMENTO = ['id'=>$contact->Identificacion()->first()->id,'nombre'=>$contact->Identificacion()->first()->nombre];
        $contact->CTOPROVINCIA = ['id'=>$contact->Provincia()->first()->id,'nombre'=>$contact->Provincia()->first()->nombre];
        $contact->CTOCANTON = ['id'=>$contact->Canton()->first()->id,'nombre'=>$contact->Canton()->first()->nombre];
        $contact->CTOPARROQUIA = ['id'=>$contact->Parroquia()->first()->id,'nombre'=>$contact->Parroquia()->first()->nombre];

        $CTOSUPERVISOR = User::find($contact->CTOSUPERVISOR);
        if($CTOSUPERVISOR!=null){
            $contact->CTOSUPERVISOR = [
                'id'=>$CTOSUPERVISOR->first()->id,
                'nombre'=> $CTOSUPERVISOR->identificacion()->first()->IDTNDOCUMENTO.' - '.$CTOSUPERVISOR->first()->nombres.' '.$CTOSUPERVISOR->first()->apellidos,
                'url'=>$CTOSUPERVISOR->identificacion()->first()->IDTIMGURL
            ];
        }
        return $contact;
    }

    public function Store(array $request){
        DB::beginTransaction();
        try {
            $contact = Contact::where('CTODOCUMENTO',$request['ndocumento'])->exists();
            ///$identificacion = Identificacion::where('IDTNDOCUMENTO',$request['ndocumento'])->exists();
            //dd($identificacion);
            if ($contact==true) {
                //Contacto existe se actualiza
                $contact = Contact::where('CTODOCUMENTO',$request['ndocumento'])->first();
            }
            //if ($contact==false && $identificacion==false){
            if ($contact==false){
                //Contacto no existe y no es usuario
                $contact = new Contact();
            }

            if($request['convenio']) {
                $contact['CTONOTAS'] = $request['convenio'];
            }

            $contact['CTODOCUMENTO'] = $request['ndocumento'];
            $contact['CTONOMBRES'] = $request['nombres'];
            $contact['CTOAPELLIDOS'] = $request['apellidos'];
            $contact['CTOEMAIL'] = $request['email'];
            $contact['CTOCELULAR'] = $request['telfmovil'];
            $contact['CTOTELEFONO'] = $request['telfdomicilio'];
            $contact['CTODIRECCION'] = $request['calleprimaria'].' '.$request['callesecundaria'].' '.$request['numero'].' '.$request['referencia'];
            $contact['CTOTIPODOCUMENTO'] = $request['tipodocumento'];
            $contact['CTOTIPONACIONALIDAD'] = $request['nacionalidad'];
            $contact['CTOPROVINCIA'] = $request['provincia'];
            $contact['CTOCANTON'] = $request['canton'];
            $contact['CTOPARROQUIA'] = $request['parroquia'];
            //$contact['CTOSUPERVISOR'] = $request['supervisor'];

            $contact->save();
            DB::commit();
            return $contact;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
            Log::info('Error Create Contact', ['event'=> $e]);
        }
    }
}