<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            if (!Schema::hasColumn('orientadores', 'telemovel')) {
                $table->string('telemovel')->nullable()->after('departamento');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orientadores', function (Blueprint $table) {
            if (Schema::hasColumn('orientadores', 'telemovel')) {
                $table->dropColumn('telemovel');
            }
        });
    }
};
