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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            /* usuario emisor */
            $table->unsignedBigInteger('sender_id');
            $table->string('user_name'); /* Nombre del usuario que mando el mensaje */
            /* usuario receptor */
            $table->unsignedBigInteger('recipient_id');
            $table->text('body');
            $table->boolean('reed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
