<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('tlc');
            $table->string('ac_type_code')->nullable();
            $table->string('airline')->nullable();
            $table->string('flight_no')->nullable();
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
            $table->string('airport_c_is_dep')->nullable();
            $table->string('airport_c_is_dest')->nullable();
            $table->string('code')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('programmes');
    }
}
