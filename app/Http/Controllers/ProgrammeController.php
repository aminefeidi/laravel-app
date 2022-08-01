<?php

namespace App\Http\Controllers;

use App\Imports\ProgrammeImport;
use App\Models\Programme;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programme');
    }

    public function findAll(Request $request)
    {
        if (!$request->has('start') || !$request->has('end')) {
            return response()->json([
                'error' => 'Missing start or end',
            ]);
        }
        $start = $request->get('start');
        $end = $request->get('end');
        $data = Programme::where('departure_date', '>=', $start)->where('departure_date', '<=', $end)->where('tlc', '=', $request->user()->matricule)->get();
        //$data = Programme::where('DEP_SCHED_DT', '>=', $start)->where('ARR_SCHED_DT', '<=', $end)->get();
        return response()->json($data);
    }

    public function import(Request $request)
    {
        if ($request->hasFile('spreadsheet')) {
            $file = $request->file('spreadsheet');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'csv') {
                Programme::truncate();
                $path = $file->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $header = array_shift($data);
                $csv = [];
                foreach ($data as $key => $value) {
                    $csv[$key] = array_combine($header, $value);
                }
                foreach ($csv as $row) {
                    Log::debug($row['DEP_SCHED_DT']);
                    Log::debug($row['ARR_SCHED_DT']);
                    if (empty($row['DEP_SCHED_DT']) || empty($row['ARR_SCHED_DT'])) {
                        continue;
                    }
                    $programme = new Programme();
                    $depDate = Carbon::createFromFormat('d/m/y g:i a', $row['DEP_SCHED_DT'])->format('Y-m-d H:i');
                    $programme->DEP_SCHED_DT = $depDate;
                    $arrDate = Carbon::createFromFormat('d/m/y g:i a', $row['ARR_SCHED_DT'])->format('Y-m-d H:i');
                    $programme->ARR_SCHED_DT = $arrDate;
                    $programme->FN_CARRIER = $row['FN_CARRIER'];
                    $programme->FN_NUMBER = $row['FN_NUMBER'];
                    $programme->FN_SUFFIX = $row['FN_SUFFIX'];
                    $programme->DAY_OF_ORIGIN = $row['DAY_OF_ORIGIN'];
                    $programme->AC_OWNER = $row['AC_OWNER'];
                    $programme->AC_SUBTYPE = $row['AC_SUBTYPE'];
                    $programme->AC_LOGICAL_NO = $row['AC_LOGICAL_NO'];
                    $programme->AC_VERSION = $row['AC_VERSION'];
                    $programme->AC_REGISTRATION = $row['AC_REGISTRATION'];
                    $programme->DEP_AP_ACTUAL = $row['DEP_AP_ACTUAL'];
                    $programme->DEP_AP_SCHED = $row['DEP_AP_SCHED'];
                    $programme->NEXT_INFO_DT = $row['NEXT_INFO_DT'];
                    $programme->DEP_DT_EST = $row['DEP_DT_EST'];
                    $programme->ARR_AP_ACTUAL = $row['ARR_AP_ACTUAL'];
                    $programme->ARR_AP_SCHED = $row['ARR_AP_SCHED'];
                    $programme->ARR_DT_EST = $row['ARR_DT_EST'];
                    $programme->SLOT_TIME_ACTUAL = $row['SLOT_TIME_ACTUAL'];
                    $programme->LEG_STATE = $row['LEG_STATE'];
                    $programme->LEG_TYPE = $row['LEG_TYPE'];
                    $programme->EMPLOYER_COCKPIT = $row['EMPLOYER_COCKPIT'];
                    $programme->EMPLOYER_CABIN = $row['EMPLOYER_CABIN'];
                    $programme->FLIGHT_HOURS = $row['FLIGHT_HOURS'];
                    $programme->FLIGHT_MINUTES = $row['FLIGHT_MINUTES'];
                    $programme->CYCLES = $row['CYCLES'];
                    $programme->DELAY_CODE_01 = $row['DELAY_CODE_01'];
                    $programme->DELAY_CODE_02 = $row['DELAY_CODE_02'];
                    $programme->DELAY_CODE_03 = $row['DELAY_CODE_03'];
                    $programme->DELAY_CODE_04 = $row['DELAY_CODE_04'];
                    $programme->DELAY_TIME_01 = $row['DELAY_TIME_01'];
                    $programme->DELAY_TIME_02 = $row['DELAY_TIME_02'];
                    $programme->DELAY_TIME_03 = $row['DELAY_TIME_03'];
                    $programme->DELAY_TIME_04 = $row['DELAY_TIME_04'];
                    $programme->SUBDELAY_CODE_01 = $row['SUBDELAY_CODE_01'];
                    $programme->SUBDELAY_CODE_02 = $row['SUBDELAY_CODE_02'];
                    $programme->SUBDELAY_CODE_03 = $row['SUBDELAY_CODE_03'];
                    $programme->SUBDELAY_CODE_04 = $row['SUBDELAY_CODE_04'];
                    $programme->PAX_BOOKED_F = $row['PAX_BOOKED_F'];
                    $programme->PAX_BOOKED_C = $row['PAX_BOOKED_C'];
                    $programme->PAX_BOOKED_Y = $row['PAX_BOOKED_Y'];
                    $programme->PAX_BOOKED_TRS_F = $row['PAX_BOOKED_TRS_F'];
                    $programme->PAX_BOOKED_TRS_C = $row['PAX_BOOKED_TRS_C'];
                    $programme->PAX_BOOKED_TRS_Y = $row['PAX_BOOKED_TRS_Y'];
                    $programme->PAD_BOOKED_F = $row['PAD_BOOKED_F'];
                    $programme->PAD_BOOKED_C = $row['PAD_BOOKED_C'];
                    $programme->PAD_BOOKED_Y = $row['PAD_BOOKED_Y'];
                    $programme->PAD_BOOKED_TRS_F = $row['PAD_BOOKED_TRS_F'];
                    $programme->PAD_BOOKED_TRS_C = $row['PAD_BOOKED_TRS_C'];
                    $programme->PAD_BOOKED_TRS_Y = $row['PAD_BOOKED_TRS_Y'];
                    $programme->PAX_FLOWN_MALE = $row['PAX_FLOWN_MALE'];
                    $programme->PAX_FLOWN_FEMALE = $row['PAX_FLOWN_FEMALE'];
                    $programme->PAX_FLOWN_ADULT = $row['PAX_FLOWN_ADULT'];
                    $programme->PAX_FLOWN_CHILDREN = $row['PAX_FLOWN_CHILDREN'];
                    $programme->PAX_INFANT = $row['PAX_INFANT'];
                    $programme->PAX_FLOWN_F = $row['PAX_FLOWN_F'];
                    $programme->PAX_FLOWN_C = $row['PAX_FLOWN_C'];
                    $programme->PAX_FLOWN_Y = $row['PAX_FLOWN_Y'];
                    $programme->save();
                }
                return back();
            } else {
                return back()->withErrors(['spreadsheet' => 'Please select a csv file']);
            }
        } else {
            return back()->withErrors(['spreadsheet' => 'Please select a file']);
        }
    }

    public function importExcel(Request $request)
    {
        ini_set('max_execution_time', 300);
        $request->validate([
            'spreadsheet' => 'required|max:10000|mimes:xlsx,xls',
        ]);
        if ($request->hasFile('spreadsheet')) {
            $file = $request->file('spreadsheet');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'xlsx') {
                Programme::truncate();
                //Excel::import(new ProgrammeImport, $file);
                $users = (new FastExcel)->import($file, function ($line) {
                    Log::debug($line);
                    if (strlen($line['DEPARTURE_TIME']) < 4 || strlen($line['ARRIVAL_TIME']) < 4 || $line['TLC'] == '') {
                        return null;
                    }
                    //$depDateExp = $line['DEPARTURE_DATE'] . ' ' . substr_replace($line['DEPARTURE_TIME'], ':', 2, 0);
                    //$arrDateExp = $line['ARRIVAL_DATE'] . ' ' . substr_replace($line['ARRIVAL_TIME'], ':', 2, 0);
                    //$depDate = Carbon::createFromFormat('m/d/Y H:i', $depDateExp)->format('Y-m-d H:i');
                    //$arrDate = Carbon::createFromFormat('m/d/Y H:i', $arrDateExp)->format('Y-m-d H:i');
                    return Programme::create([
                        'tlc' => $line['TLC'],
                        'departure_date' => date_time_set($line['DEPARTURE_DATE'], substr($line['DEPARTURE_TIME'], 0, 2), substr($line['DEPARTURE_TIME'], 2, 2)),
                        'arrival_date' => date_time_set($line['ARRIVAL_DATE'], substr($line['ARRIVAL_TIME'], 0, 2), substr($line['ARRIVAL_TIME'], 2, 2)),
                        'airport_c_is_dep' => $line['AIRPORT_C_IS_DEP'],
                        'airport_c_is_dest' => $line['AIRPORT_C_IS_DEST'],
                        'airline' => $line['AIRLINE'],
                        'flight_no' => $line['FLIGHT_NO'],
                        'ac_type_code' => $line['AC_TYPE_CODE'],
                        'code' => $line['CODE'],
                        'type' => $line['TYPE'],
                        'day_of_origin' => $line['DAY_OF_ORIGIN'],
                        // 'fn_carrier' => $line['FN_CARRIER'],
                        // 'fn_number' => $line['FN_NUMBER'],
                        // 'fn_suffix' => $line['FN_SUFFIX'],
                        // 'day_of_origin' => $line['DAY_OF_ORIGIN'],
                        // 'ac_owner' => $line['AC_OWNER'],
                        // 'ac_subtype' => $line['AC_SUBTYPE'],
                        // 'ac_logical_no' => $line['AC_LOGICAL_NO'],
                        // 'ac_version' => $line['AC_VERSION'],
                        // 'ac_registration' => $line['AC_REGISTRATION'],
                        // 'dep_ap_actual' => $line['DEP_AP_ACTUAL'],
                        // 'dep_ap_sched' => $line['DEP_AP_SCHED'],
                        // 'next_info_dt' => $line['NEXT_INFO_DT'],
                        // 'dep_dt_est' => $line['DEP_DT_EST'],
                        // 'dep_sched_dt' => $line['DEP_SCHED_DT'],
                        // 'arr_ap_actual' => $line['ARR_AP_ACTUAL'],
                        // 'arr_ap_sched' => $line['ARR_AP_SCHED'],
                        // 'arr_dt_est' => $line['ARR_DT_EST'],
                        // 'arr_sched_dt' => $line['ARR_SCHED_DT'],
                        // 'slot_time_actual' => $line['SLOT_TIME_ACTUAL'],
                        // 'leg_state' => $line['LEG_STATE'],
                        // 'leg_type' => $line['LEG_TYPE'],
                        // 'employer_cockpit' => $line['EMPLOYER_COCKPIT'],
                        // 'employer_cabin' => $line['EMPLOYER_CABIN'],
                        // 'flight_hours' => $line['FLIGHT_HOURS'],
                        // 'flight_minutes' => $line['FLIGHT_MINUTES'],
                        // 'cycles' => $line['CYCLES'],
                        // 'delay_code_01' => $line['DELAY_CODE_01'],
                        // 'delay_code_02' => $line['DELAY_CODE_02'],
                        // 'delay_code_03' => $line['DELAY_CODE_03'],
                        // 'delay_code_04' => $line['DELAY_CODE_04'],
                        // 'delay_time_01' => $line['DELAY_TIME_01'],
                        // 'delay_time_02' => $line['DELAY_TIME_02'],
                        // 'delay_time_03' => $line['DELAY_TIME_03'],
                        // 'delay_time_04' => $line['DELAY_TIME_04'],
                        // 'subdelay_code_01' => $line['SUBDELAY_CODE_01'],
                        // 'subdelay_code_02' => $line['SUBDELAY_CODE_02'],
                        // 'subdelay_code_03' => $line['SUBDELAY_CODE_03'],
                        // 'subdelay_code_04' => $line['SUBDELAY_CODE_04'],
                        // 'pax_booked_f' => $line['PAX_BOOKED_F'],
                        // 'pax_booked_c' => $line['PAX_BOOKED_C'],
                        // 'pax_booked_y' => $line['PAX_BOOKED_Y'],
                        // 'pax_booked_trs_f' => $line['PAX_BOOKED_TRS_F'],
                        // 'pax_booked_trs_c' => $line['PAX_BOOKED_TRS_C'],
                        // 'pax_booked_trs_y' => $line['PAX_BOOKED_TRS_Y'],
                        // 'pad_booked_f' => $line['PAD_BOOKED_F'],
                        // 'pad_booked_c' => $line['PAD_BOOKED_C'],
                        // 'pad_booked_y' => $line['PAD_BOOKED_Y'],
                        // 'pad_booked_trs_f' => $line['PAD_BOOKED_TRS_F'],
                        // 'pad_booked_trs_c' => $line['PAD_BOOKED_TRS_C'],
                        // 'pad_booked_trs_y' => $line['PAD_BOOKED_TRS_Y'],
                        // 'pax_flown_male' => $line['PAX_FLOWN_MALE'],
                        // 'pax_flown_female' => $line['PAX_FLOWN_FEMALE'],
                        // 'pax_flown_adult' => $line['PAX_FLOWN_ADULT'],
                        // 'pax_flown_children' => $line['PAX_FLOWN_CHILDREN'],
                        // 'pax_infant' => $line['PAX_INFANT'],
                        // 'pax_flown_f' => $line['PAX_FLOWN_F'],
                        // 'pax_flown_c' => $line['PAX_FLOWN_C'],
                        // 'pax_flown_y' => $line['PAX_FLOWN_Y'],
                    ]);
                });
                return back();
            }
        }
    }

    public function importExcel2(Request $request)
    {
        ini_set('max_execution_time', 300);
        $request->validate([
            'spreadsheet2' => 'required|max:10000|mimes:xlsx,xls',
        ]);
        if ($request->hasFile('spreadsheet2')) {
            $file = $request->file('spreadsheet2');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'xlsx') {
                $users = (new FastExcel)->import($file, function ($line) {
                    Log::debug($line);
                    //$depDateExp = $line['DEPARTURE_DATE'] . ' ' . substr_replace($line['DEPARTURE_TIME'], ':', 2, 0);
                    //$arrDateExp = $line['ARRIVAL_DATE'] . ' ' . substr_replace($line['ARRIVAL_TIME'], ':', 2, 0);
                    //$depDate = Carbon::createFromFormat('m/d/Y H:i', $depDateExp)->format('Y-m-d H:i');
                    //$arrDate = Carbon::createFromFormat('m/d/Y H:i', $arrDateExp)->format('Y-m-d H:i');
                    return Programme::where('flight_no', '=', trim($line['FN_NUMBER']))
                        ->where('day_of_origin', $line['DAY_OF_ORIGIN'])
                        ->orWhere('departure_date', $line['DEP_SCHED_DT'])
                        ->update(
                            [
                                'fn_carrier' => $line['FN_CARRIER'],
                                'fn_number' => $line['FN_NUMBER'],
                                'fn_suffix' => $line['FN_SUFFIX'],
                                'day_of_origin' => $line['DAY_OF_ORIGIN'],
                                'ac_owner' => $line['AC_OWNER'],
                                'ac_subtype' => $line['AC_SUBTYPE'],
                                'ac_logical_no' => $line['AC_LOGICAL_NO'],
                                'ac_version' => $line['AC_VERSION'],
                                'ac_registration' => $line['AC_REGISTRATION'],
                                'dep_ap_actual' => $line['DEP_AP_ACTUAL'],
                                'dep_ap_sched' => $line['DEP_AP_SCHED'],
                                'next_info_dt' => $line['NEXT_INFO_DT'],
                                'dep_dt_est' => $line['DEP_DT_EST'],
                                'dep_sched_dt' => $line['DEP_SCHED_DT'],
                                'arr_ap_actual' => $line['ARR_AP_ACTUAL'],
                                'arr_ap_sched' => $line['ARR_AP_SCHED'],
                                'arr_dt_est' => $line['ARR_DT_EST'],
                                'arr_sched_dt' => $line['ARR_SCHED_DT'],
                                'slot_time_actual' => $line['SLOT_TIME_ACTUAL'],
                                'leg_state' => $line['LEG_STATE'],
                                'leg_type' => $line['LEG_TYPE'],
                                'employer_cockpit' => $line['EMPLOYER_COCKPIT'],
                                'employer_cabin' => $line['EMPLOYER_CABIN'],
                                'flight_hours' => $line['FLIGHT_HOURS'],
                                'flight_minutes' => $line['FLIGHT_MINUTES'],
                                'cycles' => $line['CYCLES'],
                                'delay_code_01' => $line['DELAY_CODE_01'],
                                'delay_code_02' => $line['DELAY_CODE_02'],
                                'delay_code_03' => $line['DELAY_CODE_03'],
                                'delay_code_04' => $line['DELAY_CODE_04'],
                                'delay_time_01' => $line['DELAY_TIME_01'],
                                'delay_time_02' => $line['DELAY_TIME_02'],
                                'delay_time_03' => $line['DELAY_TIME_03'],
                                'delay_time_04' => $line['DELAY_TIME_04'],
                                'subdelay_code_01' => $line['SUBDELAY_CODE_01'],
                                'subdelay_code_02' => $line['SUBDELAY_CODE_02'],
                                'subdelay_code_03' => $line['SUBDELAY_CODE_03'],
                                'subdelay_code_04' => $line['SUBDELAY_CODE_04'],
                                'pax_booked_f' => $line['PAX_BOOKED_F'],
                                'pax_booked_c' => $line['PAX_BOOKED_C'],
                                'pax_booked_y' => $line['PAX_BOOKED_Y'],
                                'pax_booked_trs_f' => $line['PAX_BOOKED_TRS_F'],
                                'pax_booked_trs_c' => $line['PAX_BOOKED_TRS_C'],
                                'pax_booked_trs_y' => $line['PAX_BOOKED_TRS_Y'],
                                'pad_booked_f' => $line['PAD_BOOKED_F'],
                                'pad_booked_c' => $line['PAD_BOOKED_C'],
                                'pad_booked_y' => $line['PAD_BOOKED_Y'],
                                'pad_booked_trs_f' => $line['PAD_BOOKED_TRS_F'],
                                'pad_booked_trs_c' => $line['PAD_BOOKED_TRS_C'],
                                'pad_booked_trs_y' => $line['PAD_BOOKED_TRS_Y'],
                                'pax_flown_male' => $line['PAX_FLOWN_MALE'],
                                'pax_flown_female' => $line['PAX_FLOWN_FEMALE'],
                                'pax_flown_adult' => $line['PAX_FLOWN_ADULT'],
                                'pax_flown_children' => $line['PAX_FLOWN_CHILDREN'],
                                'pax_infant' => $line['PAX_INFANT'],
                                'pax_flown_f' => $line['PAX_FLOWN_F'],
                                'pax_flown_c' => $line['PAX_FLOWN_C'],
                                'pax_flown_y' => $line['PAX_FLOWN_Y'],
                            ]
                        );
                });
                return back();
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        //
    }
}
