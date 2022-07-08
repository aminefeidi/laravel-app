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
        $data = Programme::where('departure_date', '>=', $start)->where('departure_date', '<=', $end)->get();
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
                    if (strlen($row['DEPARTURE_TIME']) < 4 || strlen($row['ARRIVAL_TIME']) < 4 || $row['TLC'] == '') {
                        continue;
                    }
                    $depDateExp = $row['DEPARTURE_DATE'] . ' ' . substr_replace($row['DEPARTURE_TIME'], ':', 2, 0);
                    $arrDateExp = $row['ARRIVAL_DATE'] . ' ' . substr_replace($row['ARRIVAL_TIME'], ':', 2, 0);
                    $depDate = Carbon::createFromFormat('m/d/Y H:i', $depDateExp)->format('Y-m-d H:i');
                    $arrDate = Carbon::createFromFormat('m/d/Y H:i', $arrDateExp)->format('Y-m-d H:i');
                    $programme = new Programme();
                    $programme->tlc = $row['TLC'];
                    $programme->departure_date = $depDate;
                    $programme->arrival_date = $arrDate;
                    $programme->airport_c_is_dep = $row['AIRPORT_C_IS_DEP'];
                    $programme->airport_c_is_dest = $row['AIRPORT_C_IS_DEST'];
                    $programme->airline = $row['AIRLINE'];
                    $programme->flight_no = $row['FLIGHT_NO'];
                    $programme->ac_type_code = $row['AC_TYPE_CODE'];
                    $programme->code = $row['CODE'];
                    $programme->type = $row['TYPE'];
                    $programme->save();
                }
                return back();
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
