<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            // Usa colunas que EXISTEM na tua tabela (por ex. 'nome' e 'email_contacto')
            if (!Schema::hasColumn('empresas', 'responsavel_nome')) {
                $table->string('responsavel_nome')->nullable()->after('nome');
            }
            if (!Schema::hasColumn('empresas', 'responsavel_email')) {
                $table->string('responsavel_email')->nullable()->after('email_contacto');
            }
            if (!Schema::hasColumn('empresas', 'responsavel_telemovel')) {
                $table->string('responsavel_telemovel')->nullable()->after('telemovel');
            }
        });
    }

    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            if (Schema::hasColumn('empresas', 'responsavel_telemovel')) {
                $table->dropColumn('responsavel_telemovel');
            }
            if (Schema::hasColumn('empresas', 'responsavel_email')) {
                $table->dropColumn('responsavel_email');
            }
            if (Schema::hasColumn('empresas', 'responsavel_nome')) {
                $table->dropColumn('responsavel_nome');
            }
        });
    }
};
