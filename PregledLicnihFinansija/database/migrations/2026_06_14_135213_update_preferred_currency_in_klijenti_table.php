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
        Schema::table('klijenti', function (Blueprint $table) {
            $table->string('preferred_currency', 3)->default('RSD')->change();
        });
    }

    public function down(): void
    {
        Schema::table('klijenti', function (Blueprint $table) {
            $table->string('preferred_currency', 10)->default('RSD')->change();
        });
    }
};
