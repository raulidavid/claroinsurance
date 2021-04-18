<?php

namespace Madsis\Postulant\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailPostulantCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $postulant;

    public function __construct($postulant)
    {
        $this->postulant = $postulant;
    }


    public function build()
    {
        return $this
            ->from('admin@mad.ec', 'Administrador Madsis')
            //->to('francisco.flores@mad.ec','FRANCISCO FLORES')
            ->subject(('Nuevo Postulante! '. $this->postulant->PTLNOMBRES .' '. $this->postulant->PTLAPELLIDOS ))
            //->attachFromStorageDisk('public',$this->postulant->PTLHOJAVIDAURL)
            ->markdown('mail.postulantcreated');
    }
}
