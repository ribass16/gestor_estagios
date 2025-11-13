<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 0) (opcional) garantir o tipo da coluna
        Schema::table('vagas', function (Blueprint $table) {
            // se precisares que aceite NULL troca para ->nullable()->change();
            $table->unsignedBigInteger('empresa_id')->change();
        });

        // 1) Se existir uma FK qualquer na coluna empresa_id, remover
        $fk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
            ->where('TABLE_NAME', 'vagas')
            ->where('COLUMN_NAME', 'empresa_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        if ($fk) {
            DB::statement("ALTER TABLE `vagas` DROP FOREIGN KEY `$fk`");
        }

        // 2) Criar a FK certa (vagas.empresa_id -> empresas.id)
        Schema::table('vagas', function (Blueprint $table) {
            $table->foreign('empresa_id')
                ->references('id')->on('empresas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // Remover a FK se existir
        $fk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('TABLE_SCHEMA', DB::raw('DATABASE()'))
            ->where('TABLE_NAME', 'vagas')
            ->where('COLUMN_NAME', 'empresa_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->value('CONSTRAINT_NAME');

        if ($fk) {
            DB::statement("ALTER TABLE `vagas` DROP FOREIGN KEY `$fk`");
        }
    }
};
