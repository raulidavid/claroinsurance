<?php

namespace Madsis\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Madsis\User\Models\Identificacion;
use Madsis\User\Models\User;

class MailCreatedUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user,$ndocumento;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$ndocumento)
    {
        $user = User::find($user);
        $ndocumento = Identificacion::where('n_documento',$ndocumento)->first();
        $this->user = $user;
        $this->ndocumento = $ndocumento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if(($this->to[0]['address']=='soporte@mad.ec')or(($this->to[0]['address']=='adriana.chalco@mad.ec'))){
            return $this
                ->from('soporte@mad.ec', 'Madsis  Market&Delivery S.A')
                ->subject(('Nuevo usuario creado! '. $this->user->nombres .' '. $this->user->apellidos ))
                ->markdown('mail.usercreated-beta');

        }else{
            return $this
                //->from('admin@mad.ec', 'Administrador SIEC')
                ->from('adriana.chalco@mad.ec', 'Departamento Talento Humano Market&Delivery S.A')
                //->to('francisco.flores@mad.ec','FRANCISCO FLORES')
                ->subject(('Bienvenido a Market and Delivery! '. $this->user->nombres .' '. $this->user->apellidos ))
                ->markdown('mail.usercreated');
        }



    }
}
