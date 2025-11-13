<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Garantir o tipo correto da coluna
        Schema::table('vagas', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id')->change();
        });

        // Remover qualquer FK antiga na coluna empresa_id
        $fk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
            ->where('TABLE_NAME', 'vagas')
            ->where('COLUMN_NAME', 'empresa_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        if ($fk) {
            DB::statement("ALTER TABLE `vagas` DROP FOREIGN KEY `$fk`");
        }

        // Nota: A relação vagas.empresa_id -> empresas.user_id é gerida pelo Eloquent
        // Não criamos FK formal no MySQL porque user_id não é chave primária
    }

    public function down(): void
    {
        // Nada a reverter
    }
};
