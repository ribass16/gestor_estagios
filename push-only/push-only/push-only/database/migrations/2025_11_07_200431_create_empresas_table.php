<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nome');
            $table->string('nif')->nullable();
            $table->string('telemovel')->nullable();
            $table->string('email_contacto')->nullable();
            $table->string('morada')->nullable();
            $table->string('website')->nullable();
            $table->string('setor')->nullable();
            $table->text('descricao')->nullable();
            $table->boolean('aceita_estagios')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
