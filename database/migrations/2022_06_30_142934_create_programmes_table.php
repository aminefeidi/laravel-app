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
            $table->string('fn_carrier')->nullable();
            $table->string('fn_number')->nullable();
            $table->string('fn_suffix')->nullable();
            $table->string('day_of_origin')->nullable();
            $table->string('ac_owner')->nullable();
            $table->string('ac_subtype')->nullable();
            $table->string('ac_logical_no')->nullable();
            $table->string('ac_version')->nullable();
            $table->string('ac_registration')->nullable();
            $table->string('dep_ap_actual')->nullable();
            $table->string('dep_ap_sched')->nullable();
            $table->string('next_info_dt')->nullable();
            $table->string('dep_dt_est')->nullable();
            $table->dateTime('dep_sched_dt')->nullable();
            $table->string('arr_ap_actual')->nullable();
            $table->string('arr_ap_sched')->nullable();
            $table->string('arr_dt_est')->nullable();
            $table->dateTime('arr_sched_dt')->nullable();
            $table->string('slot_time_actual')->nullable();
            $table->string('leg_state')->nullable();
            $table->string('leg_type')->nullable();
            $table->string('employer_cockpit')->nullable();
            $table->string('employer_cabin')->nullable();
            $table->string('flight_hours')->nullable();
            $table->string('flight_minutes')->nullable();
            $table->string('cycles')->nullable();
            $table->string('delay_code_01')->nullable();
            $table->string('delay_code_02')->nullable();
            $table->string('delay_code_03')->nullable();
            $table->string('delay_code_04')->nullable();
            $table->string('delay_time_01')->nullable();
            $table->string('delay_time_02')->nullable();
            $table->string('delay_time_03')->nullable();
            $table->string('delay_time_04')->nullable();
            $table->string('subdelay_code_01')->nullable();
            $table->string('subdelay_code_02')->nullable();
            $table->string('subdelay_code_03')->nullable();
            $table->string('subdelay_code_04')->nullable();
            $table->string('pax_booked_f')->nullable();
            $table->string('pax_booked_c')->nullable();
            $table->string('pax_booked_y')->nullable();
            $table->string('pax_booked_trs_f')->nullable();
            $table->string('pax_booked_trs_c')->nullable();
            $table->string('pax_booked_trs_y')->nullable();
            $table->string('pad_booked_f')->nullable();
            $table->string('pad_booked_c')->nullable();
            $table->string('pad_booked_y')->nullable();
            $table->string('pad_booked_trs_f')->nullable();
            $table->string('pad_booked_trs_c')->nullable();
            $table->string('pad_booked_trs_y')->nullable();
            $table->string('pax_flown_male')->nullable();
            $table->string('pax_flown_female')->nullable();
            $table->string('pax_flown_adult')->nullable();
            $table->string('pax_flown_children')->nullable();
            $table->string('pax_infant')->nullable();
            $table->string('pax_flown_f')->nullable();
            $table->string('pax_flown_c')->nullable();
            $table->string('pax_flown_y')->nullable();
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
