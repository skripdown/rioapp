<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HadirRapat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hadir_rapat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rapat');
            $table->string('peserta');
            $table->string('pukul');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hadir_rapat');
    }
}
