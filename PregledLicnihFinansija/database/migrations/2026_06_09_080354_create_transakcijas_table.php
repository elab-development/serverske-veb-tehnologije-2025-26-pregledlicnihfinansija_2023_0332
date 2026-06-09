<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transakcije', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klijent_id')->constrained('klijenti')->onDelete('cascade');
            $table->foreignId('kategorija_id')->constrained('kategorije')->onDelete('cascade');
            $table->double('kolicina');
            $table->date('datum');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transakcije');
    }
};