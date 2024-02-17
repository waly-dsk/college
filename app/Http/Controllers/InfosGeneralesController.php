<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfosGenerales;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InfosGeneralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $infos = InfosGenerales::all();
        return view('admin.infos.index', compact(['user', 'infos']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required'],
            'annee' => ['required'],
            'periodicite_devoirs' => ['required'],
        ]);

        InfosGenerales::create($validateData);

        if ($validateData['periodicite_devoirs'] == 'trimestre') {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('periodicite_devoirs')->insert([
                    'numero' => $i,
                ]);
            }
        } elseif ($validateData['periodicite_devoirs'] == 'semestre') {
            for ($i = 1; $i <= 2; $i++) {
                DB::table('periodicite_devoirs')->insert([
                    'numero' => $i,
                ]);
            }
        }

        return redirect('admin/infos_generales');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoGenerales  $infoGenerales
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $infoGenerales = InfosGenerales::findOrFail($id);

        return view('admin.infos.edit', compact(['user', 'infoGenerales']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoGenerales  $infoGenerales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        DB::table('periodicite_devoirs')->delete();

        $validateData = $request->validate([
            'name' => ['required'],
            'annee' => ['required'],
            'periodicite_devoirs' => ['required'],
        ]);

        $infoGenerales = InfosGenerales::findOrFail($id);

        $infoGenerales->update($validateData);

        if ($validateData['periodicite_devoirs'] == 'trimestre') {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('periodicite_devoirs')->insert([
                    'numero' => $i,
                ]);
            }
        } elseif ($validateData['periodicite_devoirs'] == 'semestre') {
            for ($i = 1; $i <= 2; $i++) {
                DB::table('periodicite_devoirs')->insert([
                    'numero' => $i,
                ]);
            }
        }

        return redirect('admin/infos_generales');
    }
}
