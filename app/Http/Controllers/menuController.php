<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\submenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = menu::latest()->paginate(5);
        return view('menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( menu $menu )
    {
        return view('menus.create', [
            'menu' => $menu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
            $menus = new menu();
            $menus->name = $request->get('name');
            $menus->description = $request->get('description');
            $menus->save();
            /*
                Contamos todo el arreglo de submenus que vienen del formulario
            */
            $sql = $request->get('submenu_name');
            $cant = count($sql);

            if( $cant > 0 ) {
                for( $i = 0; $i < $cant; $i++ ) {
                    $submenu_name = $request->get('submenu_name')[$i];
                    $submenu_url = $request->get('url_name')[$i];

                    $submenus[] = [
                        'menu_id' => $menus->id,
                        'name' => $submenu_name,
                        'url' => $submenu_url
                    ];
                }
            }
            submenu::insert($submenus);

        DB::commit();
        return redirect()->route('menus.index');
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
        $menu = menu::find($id);
        $submenu = submenu::where('menu_id','=',$menu->id)->get();
        return view('menus.edit',compact('menu','submenu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
            $menus = menu::find($id);
            $menus->name = $request->get('name');
            $menus->description = $request->get('description');
            $menus->save();
             /*
                Contamos todo el arreglo de submenus que vienen del formulario
            */
            $reg_new_id = request()->submenu_id;
            $reg_new_submenu = request()->submenu_name;
            $reg_submenu_url = request()->url_name;
            // traemos el id del submenu existente en la base de datos
            $submenu_original = (submenu::where('menu_id', '=', $menus->id)
            ->get())
            ->pluck('id')->toArray();
            // hacemos un arraydiff para tener una comparacion
            // de los datos nuevos y los datos existentes
            $array_submenu = array_diff($submenu_original, $reg_new_id);
            // eliminamos los datos que viejos
            submenu::destroy($array_submenu);
            // insertamos los datos nuevos en el ciclo for
            for($i = 0; $i < sizeof($reg_new_submenu);$i++) {
                submenu::updateOrCreate(
                    [
                        'id' => array_key_exists($i,$reg_new_id) ? $reg_new_id[$i]:0
                    ],
                    [
                        'menu_id'=> $id,
                        'name'=> $reg_new_submenu[$i],
                        'url'=> $reg_submenu_url[$i]
                    ]
                );
            }

        DB::commit();
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        menu::find($id)->delete();
        return redirect()->route('menus.index');
    }
}
