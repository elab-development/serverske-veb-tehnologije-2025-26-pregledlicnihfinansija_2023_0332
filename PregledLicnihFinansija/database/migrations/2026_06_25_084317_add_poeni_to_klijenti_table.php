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
            $table->integer('poeni')->default(0)->after('preferred_currency');
            $table->string('bedz')->default('Pocetnik')->after('poeni');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klijenti', function (Blueprint $table) {
            $table->dropColumn(['poeni', 'bedz']);
        });
    }
};
