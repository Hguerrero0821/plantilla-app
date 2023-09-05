<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Models\notification;
use App\Models\notification_old;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {

            if( isset(Auth::user()->id) ) {

                $usuarios_submenus = DB::table('roles_usuarios as A')
                ->join('roles_submenuses as B', 'A.rol_id', '=', 'B.rol_id')
                ->join('submenus as D', 'D.id', '=', 'B.submenu_id')
                ->join('menus as F', 'F.id', '=', 'D.menu_id')
                ->select(
                    'A.rol_id', 'B.submenu_id', 'D.menu_id', 'A.user_id', 'D.name as name2',
                    'D.url', 'F.name as name3'
                )
                ->where('A.user_id', '=',Auth::user()->id)
                ->orderBy('F.id','asc')
                ->orderBy('D.id','asc')
                ->get();

                 /*
                Accedemos a las variables de dominio del ENV
                */
                $url_host = config('app.url');
                /*
                    Cargamos todos los url de los submenus y le cambiamos el valor
                    concatenando el valor del archivo env
                */
                for( $i = 0; count($usuarios_submenus) > $i; $i++ ) {

                    $usuarios_submenus[$i]->url = $url_host.$usuarios_submenus[$i]->url;

                }

                $view->with(['gbl_menus' => $usuarios_submenus]);
            }

            /*
                NOTIFICACIONES!!
            */
            $notification_body = notification::select('id','sender_id','body','user_name')
            ->where('recipient_id', '=', Auth::user()->id ?? '')
            ->where('reed', '=', 'false')
            ->get(); /* Para traer quien mando el mensaje y el contenido del mensaje
                        de la notficacion */

            /* Para traer todas las notificaciones del usuario que esta logeado */
            $notification = notification::where('recipient_id', '=', Auth::user()->id ?? '')
            ->where('reed', '=', 'false')
            ->get();

            $notification_old = notification_old::where('user_id', '=', Auth::user()->id ?? '')
            ->get();

            $sql = count($notification) + count($notification_old); /* Para contar la cantidad de notificaciones
                                            por usuario logeado */

            $notify_old_message = notification_old::select( 'user_id','body')
            ->where('user_id', '=', Auth::user()->id ?? '')
            ->get();

            $view->with(['noty'=>$sql,
            'noty_body' => $notification_body, 'alert' =>  $notify_old_message]);

        });
    }
}
