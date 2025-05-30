<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('suivis', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // ex: vente, stock, alerte
        $table->text('description')->nullable();
        $table->json('donnees')->nullable(); // pour stocker des données de graphique par exemple
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivis');
    }
};
