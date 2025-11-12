<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            if (!Schema::hasColumn('empresas', 'descricao')) {
                $table->text('descricao')->nullable()->after('estado');
            }
            if (!Schema::hasColumn('empresas', 'logo_path')) {
                $table->string('logo_path')->nullable()->after('descricao');
            }
        });
    }

    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn(['descricao', 'logo_path']);
        });
    }
};
