<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Mensaje;
use App\User;
use App\Receptor;
use Carbon\Carbon;

class MensajeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mensaje $mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $usuario = auth::user();
        $recept = User::leftJoin("receptors", "users.id", "=", "receptors.receptor")
            ->select("users.id")
            ->where('receptors.mensaje_id', '=', $this->mensaje->id)->get();
        return [
            'mensaje' => $this->mensaje->id,
            'emisor_id' => $this->mensaje->user_id,
            'emisor' => $usuario->name,
            'receptor' => $recept,
            'tema' => $this->mensaje->tema,
            'contenido' => $this->mensaje->mensaje,
            'importancia' => $this->mensaje->importancia,
            'time' => Carbon::now()->diffForHumans(),

        ];
    }
}
