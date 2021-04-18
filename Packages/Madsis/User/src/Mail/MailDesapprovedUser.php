<?php

namespace Madsis\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailDesapprovedUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('admin@mad.ec', 'Administrador SIEC')
            //->to('francisco.flores@mad.ec','FRANCISCO FLORES')
            ->subject(('Usuario Desaprobado! '. $this->user->nombres .' '. $this->user->apellidos ))
            ->markdown('mail.desapproveduser');
    }
}
