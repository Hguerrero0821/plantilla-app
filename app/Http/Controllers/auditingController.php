<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
class auditingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session()->flashInput($request->input());
        $auditorias = new Audit();
        session()->forget('filtrosFechaAudit');
        if(!empty($request->get('nombre')) || !empty($request->get('evento')) || !empty($request->get('desde')) || !empty($request->get('hasta'))) {

            if(!empty($request->get('nombre'))) {
                $auditorias = $auditorias->whereHas('User',function($query) use ($request){
                    $query->where('name','like','%'.$request->get('nombre').'%');
                });
            }
            if(!empty($request->get('evento'))) {

                $auditorias = $auditorias->where('event','like','%'.$request->get('evento').'%');

            }
            if(!empty($request->get('desde')) || !empty($request->get('hasta'))) {
                session(['filtrosFechaAudit' => [$request->get('desde'),$request->get('hasta')]]);
                $auditorias = $auditorias::whereBetween('updated_at',[$request->get('desde'),$request->get('hasta')]);
            }
        }
        $auditorias = $auditorias->latest()->paginate(3);
        return view('auditorias.index',compact('auditorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
