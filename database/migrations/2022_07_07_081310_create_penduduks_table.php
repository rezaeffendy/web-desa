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
        Schema::create('tb_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->string('nik', 50);
            $table->enum('jk', ['L', 'P']);
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            $table->enum('agama', ['Islam', 'Protestan', 'Hindu', 'Buddha', 'Katolik', 'Kong Hu Cu']);
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penduduk');
    }
};
