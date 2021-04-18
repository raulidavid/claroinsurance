<?php

namespace Madsis\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Madsis\User\Models\User;

class MailSaleWasAssignedUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user,$venta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$venta)
    {
        //
        $this->user = $user;
        $this->venta = $venta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $palabra="";
        if($this->user->rol->tipo_rol->name=="capacitador.comercial"){ 
            $palabra="Meta"; 
        }else {
            $palabra="Venta";
        }
        return $this
            ->from('denny.ayala@mad.ec', 'Departamento Logistico SIEC')
            //->from('admin@mad.ec', 'Administrador SIEC')
            //->to('francisco.flores@mad.ec','FRANCISCO FLORES')
            ->subject(('Nueva '. $palabra .' Registrada! '. $this->user->nombres .' '. $this->user->apellidos ))
            ->markdown('mail.salewasassigned');

    }
}
