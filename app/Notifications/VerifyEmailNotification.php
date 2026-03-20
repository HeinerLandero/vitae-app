<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Usuario;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channel.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/email/verify/' . $notifiable->id);

        return (new MailMessage)
            ->subject('Confirma tu cuenta en Vitae App')
            ->greeting('¡Bienvenido a Vitae App!')
            ->line('Gracias por registrarte. Por favor confirma tu dirección de correo electrónico haciendo clic en el botón de abajo:')
            ->action('Confirmar mi cuenta', $url)
            ->line('Si no creaste una cuenta en Vitae App, puedes ignorar este correo.')
            ->salutation('Saludos, Vitae App');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
