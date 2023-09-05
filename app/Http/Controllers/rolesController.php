<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\rolesSubmenus;
use App\Models\rolesUsuarios;
use App\Models\submenu;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = roles::latest()->paginate(5);
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( roles $rol )
    {

        $usuarios = User::all();
        $submenus = submenu::all();

        return view('roles.create', [
            'rol' => $rol,
            'usuarios' => $usuarios,
            'submenus' => $submenus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        DB::beginTransaction();
            $roles = new roles();
            $roles->name = $request->get('name');
            $roles->description = $request->get('description');
            $roles->save();
            /*
                Contamos el arreglo de usuarios que mandamos en el formulario
            */
            $sql = $request->get('usuarios');
            $cant = count($sql);

            if( $cant > 0 ) {
                for( $i = 0; $i < $cant; $i++ ) {

                    $user = $request->get('usuarios')[$i];

                    $users[] = [
                        'rol_id' =>  $roles->id,
                        'user_id' => $user,
                    ];
                }
            }
            rolesUsuarios::insert($users);
            /*
                Contamos el arreglo de submenus que mandamos en el formulario
            */
            $sql = $request->get('submenus');
            $cant = count($sql);

            if( $cant > 0 ) {
                for( $i = 0; $i < $cant; $i++ ) {

                    $submenu = $request->get('submenus')[$i];

                    $submenus[] = [
                        'rol_id' =>  $roles->id,
                        'submenu_id' => $submenu,
                        'create' => $request->get('create')[$i],
                        'edit' => $request->get('edit')[$i],
                        'delete' => $request->get('delete')[$i],
                    ];
                }
            }
            rolesSubmenus::insert($submenus);


        DB::commit();

        return redirect('roles');
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
        $rol = roles::find($id);
        $usuarios = User::all();
        $submenus = submenu::all();
        $usuariosSelected = rolesUsuarios::where('rol_id','=',$rol->id)->pluck('user_id')->toArray();
        $SubmenuSelected = rolesSubmenus::where('rol_id','=',$rol->id)->pluck('submenu_id')->toArray();
        $createSelected = rolesSubmenus::where('rol_id','=',$rol->id)
        ->pluck('create','submenu_id')->toArray();
        $editSelected = rolesSubmenus::where('rol_id','=',$rol->id)
        ->pluck('edit','submenu_id')->toArray();
        $deleteSelected = rolesSubmenus::where('rol_id','=',$rol->id)
        ->pluck('delete','submenu_id')->toArray();
        return view('roles.edit',compact('rol','usuarios','submenus',
        'usuariosSelected','SubmenuSelected','createSelected','editSelected','deleteSelected'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
            $roles = roles::find($id);
            $roles->name = $request->get('name');
            $roles->description = $request->get('description');
            $roles->save();
            /*
                cargo el nuevo arreglo de usuario que viene del formulario
            */
            // dd(request()->all());
            $sql = $request->get('usuarios');

            $cant = count($sql);
            /*
                Eliminamos los submenos que no esten en el arreglo
            */
            rolesUsuarios::where('rol_id','=',$roles->id)->delete();
            if( $cant > 0 ) {
                for( $i = 0; $i < $cant; $i++ ) {

                    $usuario = $request->get('usuarios')[$i];

                    $usuarios[] = [
                        'rol_id' =>  $roles->id,
                        'user_id' => $usuario,
                    ];
                }
            }
            rolesUsuarios::insert($usuarios);
            /*
                Contamos el arreglo de submenus que mandamos en el formulario
            */
            $sql = $request->get('submenus');
            $cant = count($sql);
            /*
                Eliminamos los submenos que no esten en el arreglo
            */
            rolesSubmenus::where('rol_id','=',$roles->id)->delete();
            if( $cant > 0 ) {
                for( $i = 0; $i < $cant; $i++ ) {

                    $submenu = $request->get('submenus')[$i];
                    $create = $request->get('create');
                    $edit = $request->get('edit');
                    $delete = $request->get('delete');

                    $submenus[] = [
                        'rol_id' =>  $roles->id,
                        'submenu_id' => $submenu,
                        'create' => $create[$submenu],
                        'edit' => $edit[$submenu],
                        'delete' =>$delete[$submenu],
                    ];
                }
            }
            rolesSubmenus::insert($submenus);

        DB::commit();

        return redirect('roles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        roles::find($id)->delete();
        return redirect()->route('roles.index');
    }
}
