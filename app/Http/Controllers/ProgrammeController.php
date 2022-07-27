<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programme', [
            'data' => Programme::all(),
        ]);
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
        $data = Programme::where('DEP_SCHED_DT', '>=', $start)->where('ARR_SCHED_DT', '<=', $end)->get();
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
