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
            $table->string('FN_CARRIER');
            $table->string('FN_NUMBER');
            $table->string('FN_SUFFIX');
            $table->string('DAY_OF_ORIGIN');
            $table->string('AC_OWNER');
            $table->string('AC_SUBTYPE');
            $table->string('AC_LOGICAL_NO');
            $table->string('AC_VERSION');
            $table->string('AC_REGISTRATION');
            $table->string('DEP_AP_ACTUAL');
            $table->string('DEP_AP_SCHED');
            $table->string('NEXT_INFO_DT');
            $table->string('DEP_DT_EST');
            $table->dateTime('DEP_SCHED_DT');
            $table->string('ARR_AP_ACTUAL');
            $table->string('ARR_AP_SCHED');
            $table->string('ARR_DT_EST');
            $table->dateTime('ARR_SCHED_DT');
            $table->string('SLOT_TIME_ACTUAL');
            $table->string('LEG_STATE');
            $table->string('LEG_TYPE');
            $table->string('EMPLOYER_COCKPIT');
            $table->string('EMPLOYER_CABIN');
            $table->string('FLIGHT_HOURS');
            $table->string('FLIGHT_MINUTES');
            $table->string('CYCLES');
            $table->string('DELAY_CODE_01');
            $table->string('DELAY_CODE_02');
            $table->string('DELAY_CODE_03');
            $table->string('DELAY_CODE_04');
            $table->string('DELAY_TIME_01');
            $table->string('DELAY_TIME_02');
            $table->string('DELAY_TIME_03');
            $table->string('DELAY_TIME_04');
            $table->string('SUBDELAY_CODE_01');
            $table->string('SUBDELAY_CODE_02');
            $table->string('SUBDELAY_CODE_03');
            $table->string('SUBDELAY_CODE_04');
            $table->string('PAX_BOOKED_F');
            $table->string('PAX_BOOKED_C');
            $table->string('PAX_BOOKED_Y');
            $table->string('PAX_BOOKED_TRS_F');
            $table->string('PAX_BOOKED_TRS_C');
            $table->string('PAX_BOOKED_TRS_Y');
            $table->string('PAD_BOOKED_F');
            $table->string('PAD_BOOKED_C');
            $table->string('PAD_BOOKED_Y');
            $table->string('PAD_BOOKED_TRS_F');
            $table->string('PAD_BOOKED_TRS_C');
            $table->string('PAD_BOOKED_TRS_Y');
            $table->string('PAX_FLOWN_MALE');
            $table->string('PAX_FLOWN_FEMALE');
            $table->string('PAX_FLOWN_ADULT');
            $table->string('PAX_FLOWN_CHILDREN');
            $table->string('PAX_INFANT');
            $table->string('PAX_FLOWN_F');
            $table->string('PAX_FLOWN_C');
            $table->string('PAX_FLOWN_Y');
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
