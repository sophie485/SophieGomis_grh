<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employe_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('type'); // CDI, CDD, Stage, Freelance

            $table->date('date_debut');

            $table->date('date_fin')->nullable();

            $table->decimal('salaire', 10, 2)->nullable();

            $table->string('statut')->default('Actif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contrats');
    }
};