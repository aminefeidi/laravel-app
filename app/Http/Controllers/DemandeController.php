<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search') && $request->get('search') != '') {
            $demandes = Demande::where('id', $request->get('search'))->get();
        } else if ($request->has('search') && $request->has('type')) {
            $demandes = Demande::where('id', $request->get('search'))->where('type', $request->get('type'))->get();
        } else if ($request->has('type') && $request->get('type') != '') {
            $demandes = Demande::where('type', $request->get('type'))->get();
        } else {
            $demandes = Demande::all();
        }

        return view('demandes', [
            'demandes' => $demandes,
            'term' => $request->search ?? '',
        ]);
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
        if ($request->has('id') && $request->get('id') != '') {
            $demande = Demande::find($request->id);
            $demande->update($request->all());
        } else {
            Demande::create($request->all());
        }
        return redirect()->route('demandes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Demande $demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demande $demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demande $demande)
    {
        error_log('Some message here.');
        if ($demande->delete()) {
            return redirect()->route('demandes');
        }
    }
}
