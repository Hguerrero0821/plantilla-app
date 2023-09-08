<?php

namespace App\Http\Controllers;

use App\Models\profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class profileController extends Controller
{
    public function create() {

        $usr = User::select('id','name')->where('id','=',Auth::user()->id ?? '' )->first();
        return view('profile.create',compact('usr'));
    }

    public function store(Request $request) {
        // dd(request()->all());
        DB::beginTransaction();

            $usr = User::select('id','name')->where('id','=',Auth::user()->id ?? '' )->first();

            $usuario = User::find(Auth::user()->id);
            // dd($request->get('user_name')); // Verifica si el valor se recupera correctamente
            // dd($usuario); // Verifica si el modelo de usuario se obtiene correctamente
            $usuario->name = $request->get('user_name');
            // dd($usuario); // Verifica si el valor se asigna correctamente
            $usuario->save();

            // $usr = User::updateOrCreate(
            //     [
            //         'id' => $usr->id
            //     ],

            //     [
            //         'name' => $request->get('user_name')
            //     ]
            // );

            // if ($usr->name !== $request->get('user_name')) {
            //     $usr->update(['name' => $request->get('user_name')]);
            // }
            // dd($user_name);

            $request->validate([
                'image' => 'required|image'
            ]);

            $imagen = $request->file('image')->store('public');
            $url = Storage::url($imagen);

            $profile = profile::updateOrCreate(
                [
                    'user_id' => $request->get('user_id')
                ],

                [
                    'imagen' => $url
                ]
            );


        DB::commit();
        return view('profile.create',compact('usr'));
    }
}
