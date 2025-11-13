<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            if (!Schema::hasColumn('orientadores', 'estado')) {
                $table->string('estado')->default('pendente');
                // pendente, aprovado, rejeitado
            }
        });
    }

    public function down(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            if (Schema::hasColumn('orientadores', 'estado')) {
                $table->dropColumn('estado');
            }
        });
    }
};
