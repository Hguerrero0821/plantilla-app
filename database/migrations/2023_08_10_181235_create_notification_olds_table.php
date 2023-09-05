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
        Schema::create('notification_olds', function (Blueprint $table) {
            $table->unsignedBigInteger('notificacion_id'); /* ID de la notificacion vieja */
            $table->unsignedBigInteger('user_id');  /* ID del usuario receptor */
            $table->text('body');
            $table->primary(['notificacion_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_olds');
    }
};
