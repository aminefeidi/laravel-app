<?php

namespace App\Http\Controllers;


use App\Models\Note;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('notes');
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $request->validate([
      'fichier' => 'required',
      'libelle' => 'required',
      'pn' => 'required',
      'base' => 'required',
      'secteur' => 'required',
      'note' => 'required',
    ]);
    $note = $request->all();
    Note::create($note);
    return redirect()->route('notes');
  }
}
