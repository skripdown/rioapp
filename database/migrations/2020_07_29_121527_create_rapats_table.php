<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRapatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapats', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->string('tanggal');
            $table->string('mulai');
            $table->string('selesai')->default('selesai');
            $table->integer('hadir')->default(0);
            $table->integer('izin')->default(0);
            $table->integer('absen')->default(0);
            $table->string('status')->default('0');
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
        Schema::dropIfExists('rapats');
    }
}
