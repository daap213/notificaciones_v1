<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MensajeNotification;
use App\User;
use App\Receptor;

class MensajeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //Para uno solo where, no except. ->except($event->mensaje->user_id)
		//$recept = Receptor::where('mensaje_id','=',$event->mensaje->id)->get();
		User::leftJoin("receptors","users.id","=","receptors.receptor")
			->select("users.*")
			->where('receptors.mensaje_id','=',$event->mensaje->id)
			->each(function(User $user) use ($event){
				Notification::send($user, new MensajeNotification($event->mensaje));
		});
		
    }
}
