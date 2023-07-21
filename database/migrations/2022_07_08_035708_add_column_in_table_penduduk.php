<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_penduduk', function (Blueprint $table) {
            $table->string('tempat_lahir')->after('agama');
            $table->date('tgl_lahir')->after('tempat_lahir');
            $table->string('pekerjaan')->after('tgl_lahir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_penduduk', function (Blueprint $table) {
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tgl_lahir');
            $table->dropColumn('pekerjaan');
        });
    }
};
