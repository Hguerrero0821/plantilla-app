<?php

namespace Database\Seeders;
use App\Models\menu;
use App\Models\roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $usuarios = new User();
        $usuarios->name = "Admin User";
        $usuarios->email = "admin@admin.com";
        $usuarios->password = "12345678";
        $usuarios->save();

        $menus = new menu();
        $menus->name = "MANTENIMIENTOS";
        $menus->description = "Mantenimientos para backend";
        $menus->save();

        $submenusData = [
            [
                'menu_id' => $menus->id,
                'name' => 'USUARIOS',
                'url' => 'usuarios',
            ],
            [
                'menu_id' => $menus->id,
                'name' => 'MENUS',
                'url' => 'menus',
            ],
            [
                'menu_id' => $menus->id,
                'name' => 'ROLES Y PERFILES',
                'url' => 'roles',
            ],
            [
                'menu_id' => $menus->id,
                'name' => 'AUDITORIAS',
                'url' => 'auditorias',
            ],
        ];

        DB::table('submenus')->insert($submenusData);

        $roles = new roles();
        $roles->name = "Rol de administrador del sitio";
        $roles->description = "Rol para crear, editar y eliminar en todo el sitio";
        $roles->save();

        $RolsubmenusData = [
            [
                'rol_id' => $roles->id,
                'submenu_id' => 1,
                'create' => 1,
                'edit' => 1,
                'delete' => 1,
            ],
            [
                'rol_id' => $roles->id,
                'submenu_id' => 2,
                'create' => 1,
                'edit' => 1,
                'delete' => 1,
            ],
            [
                'rol_id' => $roles->id,
                'submenu_id' => 3,
                'create' => 1,
                'edit' => 1,
                'delete' => 1,
            ],
            [
                'rol_id' => $roles->id,
                'submenu_id' => 4,
                'create' => 1,
                'edit' => 1,
                'delete' => 1,
            ],
        ];

        DB::table('roles_submenuses')->insert($RolsubmenusData);

        $RolusuarioData = [
            [
                'rol_id' => $roles->id,
                'user_id' => 1,
            ]
        ];

        DB::table('roles_usuarios')->insert($RolusuarioData);
    }
}
