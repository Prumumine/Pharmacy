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
      Schema::table('commandes', function (Blueprint $table) {
        $table->string('ordonnance_pdf')->nullable();
    });

      
    Schema::table('produits', function (Blueprint $table) {
        $table->boolean('ordonnance_oligatoire')->default(0);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            //
        });
    }
};
