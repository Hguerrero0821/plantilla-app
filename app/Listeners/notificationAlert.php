<?php

namespace App\Listeners;
use Carbon\Carbon;
use Illuminate\Auth\Events\Login;
use App\Models\notification;
use App\Models\notification_old;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class notificationAlert
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $notification_body = notification::select('recipient_id','reed','created_at')
            ->where('recipient_id', '=', Auth::user()->id ?? '')
            ->where('reed', '=', 'false')
            ->get(); /* Para traer quien mando el mensaje y el contenido del mensaje
                        de la notficacion */
                        // dd($notification_body);

            foreach( $notification_body as $noty) {

                if( $noty->reed == false ) {

                    $fechaHoy = Carbon::now()->toDateString(); /* Variable para la fecha de hoy */

                    $notificacion_date = notification::select('created_at')
                    ->where('recipient_id', '=', Auth::user()->id ?? '')->first();

                        if( $notificacion_date && $notificacion_date->created_at->toDateString() > $fechaHoy ) {

                            $notificacion_old = notification::select('id','recipient_id','body','reed')
                            ->where('reed', '=', 'false')
                            ->where('recipient_id', '=', Auth::user()->id ?? '')->first();

                            $alerta = new notification_old();
                                $alerta->notificacion_id = $notificacion_old->id ;
                                $alerta->user_id = Auth::user()->id;
                                $alerta->body = "No has revisado la siguiente notificacion: ".$notificacion_old->body;
                            $alerta->save();

                        }
                }
        }
    }
}
