<?php

namespace App\Http\Controllers;

use App\Models\notification;
use App\Models\notification_old;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class notificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notification = notification::all();
        return view('notification.index', compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        $users = User::where('id', '!=', auth()->id())->get();
        return view('notification.create', compact('users','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notification = new notification();
            $notification->sender_id = Auth::user()->id;
            $notification->user_name = Auth::user()->name;
            $notification->recipient_id = $request->get('user_id');
            $notification->body = $request->get('body');
            $notification->reed = false;
        $notification->save();

        return redirect('/notification');
    }

    /**
     * Display the specified resource.
     */

    public function fecha($notification) {



    }


    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notification = notification::find($id);
        $usuarios = User::all();
        $users = User::where('id', '!=', auth()->id())->get();
        return view('notification.edit',compact('notification','users','usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $notification = notification::find($id);
        $notification->reed = true;
        $notification->save();

        /*
         * Para eliminar la alerta de notficiaciones que no han sido leidas despues de cierto tiempo
        */

        $notify_old_messages = notification_old::where('notificacion_id', '=', $id)->delete();



        return redirect('/notification');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
