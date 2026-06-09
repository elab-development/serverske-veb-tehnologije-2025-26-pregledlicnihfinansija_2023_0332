<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('krediti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klijent_id')->constrained('klijenti')->onDelete('cascade');
            $table->double('pozajmljenaCifra');
            $table->double('kamatnaStopa');
            $table->double('mesecnaRata');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('krediti');
    }
};