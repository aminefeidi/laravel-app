<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reserves');
    }

    public function findAll()
    {
        $data = DB::table('reserves')
            ->orderBy('SENIORITY', 'asc')
            ->orderBy('CREDIT', 'desc')
            ->get();
        return response()->json($data);
    }

    public function import(Request $request)
    {
        if ($request->hasFile('spreadsheet')) {
            $file = $request->file('spreadsheet');
            $extension = $file->getClientOriginalExtension();
            if ($extension == 'csv') {
                Reserve::truncate();
                $path = $file->getRealPath();
                $data = array_map('str_getcsv', file($path));
                $header = array_shift($data);
                $csv = [];
                foreach ($data as $key => $value) {
                    $csv[$key] = array_combine($header, $value);
                }
                foreach ($csv as $row) {
                    // $depDateExp = $row['DEPARTURE_DATE'] . ' ' . substr_replace($row['DEPARTURE_TIME'], ':', 2, 0);
                    // $arrDateExp = $row['ARRIVAL_DATE'] . ' ' . substr_replace($row['ARRIVAL_TIME'], ':', 2, 0);
                    // $depDate = Carbon::createFromFormat('m/d/Y H:i', $depDateExp)->format('Y-m-d H:i');
                    // $arrDate = Carbon::createFromFormat('m/d/Y H:i', $arrDateExp)->format('Y-m-d H:i');
                    $reserve = new Reserve();
                    $reserve->Matricule = $row['Matricule'];
                    $reserve->DEPARTURE_TIME = substr_replace($row['DEPARTURE_TIME'], ':', 2, 0);
                    $reserve->ARRIVAL_TIME = substr_replace($row['ARRIVAL_TIME'], ':', 2, 0);
                    $reserve->AIRPORT_C_IS_DEP = $row['AIRPORT_C_IS_DEP'];
                    $reserve->CREDIT = $row['CREDIT'];
                    $reserve->CORPS = $row['CORPS'];
                    $reserve->SENIORITY = $row['SENIORITY'];
                    if (strlen($row['ISSENIOR']) == 0) {
                        $reserve->ISSENIOR = 0;
                    } else {
                        $reserve->ISSENIOR = 1;
                    }
                    $reserve->Date = Carbon::createFromFormat('d/m/Y', $row['Date'])->format('Y-m-d');
                    $reserve->save();
                }
                return back();
            }
        } else {
            return back()->withErrors(['spreadsheet' => 'Please select a csv file']);
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
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function show(Reserve $reserve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserve  $reserve
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserve $reserve)
    {
        //
    }
}
