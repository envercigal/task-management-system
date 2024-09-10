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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id');
            $table->string('provider');
            $table->integer('value'); // Saat cinsinden süre
            $table->integer('estimated_duration'); // Zorluk derecesi (ör: 1-5 arası)
            $table->timestamps(); // created_at ve updated_at alanları

            $table->unique(['provider_id', 'provider']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
