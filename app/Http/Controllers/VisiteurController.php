<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Classe;
use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eleves_index()
    {
        $user = Auth::user();
        $classes = Classe::all();
        return view('visiteur.eleves.index', compact(['user', 'classes']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eleves_show($id)
    {
        $classe = Classe::findOrFail($id);

        $user = Auth::user();

        $data = DB::table('eleves')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('groupes', 'groupes.id', '=', 'eleves.groupe_id')
            ->select(
                'eleves.classe_id',
                'eleves.groupe_id',
                'eleves.serie_id',
                'series.serie',
                'classes.classe',
                'groupes.groupe',
            )
            ->groupBy('groupe_id', 'classe_id', 'serie_id')
            ->having('classe_id', '=', $id)
            ->get();
        return view('visiteur.eleves.groupe_par_classe', compact(['user', 'data', 'classe']));
    }

    /**
     *
     *
     */
    public function eleves_all($classe_id, $serie_id, $groupe_id)
    {
        $user = Auth::user();
        $classe = DB::table('classes')
            ->where('id', '=', $classe_id)
            ->get();

        $serie = DB::table('series')
            ->where('id', '=', $serie_id)
            ->get();

        $groupe = DB::table('groupes')
            ->where('id', '=', $groupe_id)
            ->get();

        $eleves = DB::table('eleves')
            ->where('classe_id', '=', $classe_id)
            ->where('serie_id', '=', $serie_id)
            ->where('groupe_id', '=', $groupe_id)
            ->orderBy('name')
            ->get();
        return view('visiteur.eleves.all_students', compact(['user', 'eleves', 'classe', 'serie', 'groupe']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emplois_du_temps_index()
    {
        $user = Auth::user();
        $classes = DB::table('emplois_du_temps')
            ->join('classes', 'classes.id', '=', 'emplois_du_temps.classe_id')
            ->join('series', 'series.id', '=', 'emplois_du_temps.serie_id')
            ->join('groupes', 'groupes.id', '=', 'emplois_du_temps.groupe_id')
            ->select(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
                'classes.classe',
                'series.serie',
                'groupes.groupe'
            )
            ->groupBy(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
            )
            ->orderBy('classes.classe', 'desc')
            ->get();
        return view('visiteur.emplois_du_temps.index', compact(['user', 'classes']));
    }


    public function emplois_du_temps_show($classe_id, $serie_id, $groupe_id)
    {
        $user = Auth::user();

        $classe = Classe::findOrFail($classe_id);
        $serie = Serie::findOrFail($serie_id);
        $groupe = Groupe::findOrFail($groupe_id);

        $emplois_du_temps = DB::table('emplois_du_temps')
            ->join('classes', 'classes.id', '=', 'emplois_du_temps.classe_id')
            ->join('series', 'series.id', '=', 'emplois_du_temps.serie_id')
            ->join('groupes', 'groupes.id', '=', 'emplois_du_temps.groupe_id')
            ->join('enseignants', 'enseignants.id', '=', 'emplois_du_temps.enseignant_id')
            ->join('matieres', 'matieres.id', '=', 'emplois_du_temps.matiere_id')
            ->join('jours', 'jours.id', '=', 'emplois_du_temps.jour_id')
            ->join('horaires', 'horaires.id', '=', 'emplois_du_temps.horaire_id')

            ->where('emplois_du_temps.classe_id', '=', $classe_id)
            ->where('emplois_du_temps.serie_id', '=', $serie_id)
            ->where('emplois_du_temps.groupe_id', '=', $groupe_id)

            ->select(
                'emplois_du_temps.matiere_id',
                'matieres.name as matiere_name',
                'enseignants.name as enseignant_name',
                'enseignants.avatar',
                'jours.id as order',
                'jours.jour',
                'horaires.horaire',
                'horaires.id',
            )
            ->groupBy(
                'emplois_du_temps.matiere_id',
                'matiere_name',
                'enseignant_name',
                'enseignants.avatar',
                'jours.jour',
                'horaires.horaire',
                'horaires.id',
            )
            ->orderBy(
                'order',
                'asc'
            )
            ->orderBy(
                'horaires.id',
            )
            ->get();
        return view('visiteur.emplois_du_temps.details', compact(['user', 'classe', 'serie', 'groupe', 'emplois_du_temps']));
    }
}
