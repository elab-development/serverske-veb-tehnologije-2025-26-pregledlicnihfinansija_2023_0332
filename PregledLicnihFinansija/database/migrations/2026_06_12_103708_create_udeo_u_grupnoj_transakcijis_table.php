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
        Schema::create('udeli_u_grupnoj_transakciji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupna_transakcija_id')->constrained('grupne_transakcije')->onDelete('cascade');
            $table->foreignId('klijent_id')->constrained('klijenti')->onDelete('cascade');
            $table->double('iznosUdela');
            $table->date('datumUplate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('udeo_u_grupnoj_transakcijis');
    }
};
