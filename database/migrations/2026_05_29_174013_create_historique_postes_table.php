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
    Schema::create('historique_postes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('employe_id')->constrained()->onDelete('cascade');
        $table->string('poste');

        $table->date('date_debut');
        $table->date('date_fin')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_postes');
    }
};
