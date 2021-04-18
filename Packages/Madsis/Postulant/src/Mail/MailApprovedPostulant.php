<?php

namespace Madsis\Postulant\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Madsis\User\Models\User;

class MailApprovedPostulant extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $postulant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userinfo)
    {
        $this->postulant = $userinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('soporte@mad.ec', 'Madsis  Market&Delivery S.A')
            ->subject(('Nuevo Postulante Aprobado! '. $this->postulant->names .' '. $this->postulant->surnames ))
            ->markdown('mail.postulantapproved');
    }
}
