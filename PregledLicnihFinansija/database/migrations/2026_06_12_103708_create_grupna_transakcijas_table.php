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
        Schema::create('grupne_transakcije', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kreator_id')->constrained('klijenti')->onDelete('cascade');
            $table->string('naziv');
            $table->double('ciljIznos');
            $table->double('trenutnoPrikupljeno')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupna_transakcijas');
    }
};
