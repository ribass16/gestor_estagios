<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            if (!Schema::hasColumn('orientadores', 'descricao')) {
                $table->text('descricao')->nullable()->after('estado');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });
    }
};
