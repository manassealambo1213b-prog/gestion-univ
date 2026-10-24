<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('etudiant_id')->constrained('etudiants')->onDelete('cascade');
            $table->integer('montant');
            $table->string('motif');
            $table->string('reference')->unique();
            $table->dateTime('date_paiement');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};