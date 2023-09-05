<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles_submenuses', function (Blueprint $table) {
            /*
                Llave foreanea de la tabla roles
            */
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
             /*
                Llave foreanea de la tabla submenus
            */
            $table->unsignedBigInteger('submenu_id');
            $table->foreign('submenu_id')
            ->references('id')
            ->on('submenus')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            /*
                validaciones de metodos de los submenus
            */
            $table->boolean('create')->default(false);
            $table->boolean('edit')->default(false);
            $table->boolean('delete')->default(false);
            $table->primary(['rol_id','submenu_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_submenuses');
    }
};
