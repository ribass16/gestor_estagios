<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('candidaturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vaga_id')->constrained('vagas')->onDelete('cascade');
            $table->foreignId('orientador_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('estado', ['pendente', 'aceite', 'recusada'])->default('pendente');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidaturas');
    }
};
