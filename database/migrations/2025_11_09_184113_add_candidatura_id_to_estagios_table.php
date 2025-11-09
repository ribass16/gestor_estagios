<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('estagios', function (Blueprint $table) {
            $table->unsignedBigInteger('candidatura_id')->nullable()->after('id');

            $table->foreign('candidatura_id')
                ->references('id')->on('candidaturas')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('estagios', function (Blueprint $table) {
            $table->dropForeign(['candidatura_id']);
            $table->dropColumn('candidatura_id');
        });
    }

};
