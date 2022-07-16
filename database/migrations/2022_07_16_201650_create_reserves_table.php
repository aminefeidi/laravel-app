<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->string('Matricule');
            $table->time('DEPARTURE_TIME');
            $table->time('ARRIVAL_TIME');
            $table->string('AIRPORT_C_IS_DEP');
            $table->double('CREDIT');
            $table->string('CORPS');
            $table->integer('SENIORITY');
            $table->integer('ISSENIOR');
            $table->date('Date');
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
        Schema::dropIfExists('reserves');
    }
}
