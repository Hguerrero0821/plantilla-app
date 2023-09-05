<?php

namespace App\Http\Middleware;
use App\Models\rolesUsuarios;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // if (Auth::user() == null){

        //     return $next($request); /* Si el usuario ya no tiene token de auth automaticamente se le mandara al login */
        // }

        $parcial_url = request()->segment(1);
        $rol_user = rolesUsuarios::where('user_id','=',Auth::user()->id)->get()->pluck('rol_id')->toArray();
        $usuarios_submenus = DB::table('roles_usuarios as A')
                ->join('roles_submenuses as B', 'A.rol_id', '=', 'B.rol_id')
                ->join('submenus as D', 'D.id', '=', 'B.submenu_id')
                ->join('menus as F', 'F.id', '=', 'D.menu_id')
                ->select(
                    'A.rol_id', 'B.submenu_id', 'D.menu_id', 'A.user_id', 'D.name as name2',
                    'D.url', 'F.name as name3', 'B.create', 'B.edit', 'B.delete'
                )
                ->where('A.user_id', '=',Auth::user()->id)
                ->where('D.url','=', $parcial_url)
                ->orderBy('F.id','asc')
                ->orderBy('D.id','asc')
                ->get();

                $route = Route::currentRouteAction();
                $actionParts = explode('@', $route);
                // dd($usuarios_submenus);
                if (count($actionParts) > 2) {
                    $action = $actionParts[1];
                } else {
                    if( count($usuarios_submenus) > 0 ) {
                        $route = Route::currentRouteAction();
                        $action = explode('@',$route)[1];
                        // dd($action,$usuarios_submenus);
                        if ( ($action == 'index')
                            || (in_array($action, array('create','store')) && $usuarios_submenus[0]->create ?? 0 == 1)
                            || (in_array($action, array('edit','update')) && $usuarios_submenus[0]->edit ?? 0 == 1)
                            || (in_array($action, array('destroy')) && $usuarios_submenus[0]->delete ?? 0 == 1)
                        ) {
                            return $next($request);
                        }

                    }

                }
                return redirect('/home');
    }
}
