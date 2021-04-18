<?php

namespace Madsis\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordToken extends Notification implements ShouldQueue
{
    use Queueable;
    private $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {      
        return (new MailMessage)
            ->from('admin@mad.ec', 'Administrador SIEC')
            ->subject(('Restablecer Password'))
            ->line('Recibiste este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.')
            ->action('Reset Password', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Si no solicitaste un restablecimiento de contraseña, no se requiere ninguna otra acción.')
            ->markdown('mail.passwordreset', [
                'token' => $this->token,
                'notifiable' => $notifiable, 
                ]);
            ;   
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];

    }
}
