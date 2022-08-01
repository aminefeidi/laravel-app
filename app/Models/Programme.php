<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tlc',
        'ac_type_code',
        'airline',
        'flight_no',
        'departure_date',
        'arrival_date',
        'airport_c_is_dep',
        'airport_c_is_dest',
        'code',
        'type',
        'fn_carrier',
        'fn_number',
        'fn_suffix',
        'day_of_origin',
        'ac_owner',
        'ac_subtype',
        'ac_logical_no',
        'ac_version',
        'ac_registration',
        'dep_ap_actual',
        'dep_ap_sched',
        'next_info_dt',
        'dep_dt_est',
        'dep_sched_dt',
        'arr_ap_actual',
        'arr_ap_sched',
        'arr_dt_est',
        'arr_sched_dt',
        'slot_time_actual',
        'leg_state',
        'leg_type',
        'employer_cockpit',
        'employer_cabin',
        'flight_hours',
        'flight_minutes',
        'cycles',
        'delay_code_01',
        'delay_code_02',
        'delay_code_03',
        'delay_code_04',
        'delay_time_01',
        'delay_time_02',
        'delay_time_03',
        'delay_time_04',
        'subdelay_code_01',
        'subdelay_code_02',
        'subdelay_code_03',
        'subdelay_code_04',
        'pax_booked_f',
        'pax_booked_c',
        'pax_booked_y',
        'pax_booked_trs_f',
        'pax_booked_trs_c',
        'pax_booked_trs_y',
        'pad_booked_f',
        'pad_booked_c',
        'pad_booked_y',
        'pad_booked_trs_f',
        'pad_booked_trs_c',
        'pad_booked_trs_y',
        'pax_flown_male',
        'pax_flown_female',
        'pax_flown_adult',
        'pax_flown_children',
        'pax_infant',
        'pax_flown_f',
        'pax_flown_c',
        'pax_flown_y',
    ];
}
