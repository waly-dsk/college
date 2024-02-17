<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Coefficient;
use App\Models\Eleve;
use App\Models\Groupe;
use App\Models\Serie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Decimal;

class ResultatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periodes = DB::table('periodicite_devoirs')
            ->select('id', 'numero')
            ->get();

        $niveaux = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->join('groupes', 'groupes.id', '=', 'eleves.groupe_id')
            ->select(
                'eleves.classe_id',
                'eleves.serie_id',
                'eleves.groupe_id',
                'classes.id',
                'classes.classe',
                'series.serie',
                'groupes.groupe'
            )
            ->groupBy(
                'eleves.classe_id',
                'classes.id',
                'eleves.serie_id',
                'eleves.groupe_id',
            )
            ->orderBy('classes.id')
            ->orderBy('series.serie')
            ->get();

        return view('visiteur.resultats.index', compact([
            'user', 'periodicite',
            'periodes', 'niveaux'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post(Request $request)
    {
        $user = Auth::user();

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periode = DB::table('periodicite_devoirs')
            ->where('id', $request->periodicite_devoir_id)
            ->select('id', 'numero')
            ->get();

        $classe_id = Str::before($request->niveau, ' ');
        $serie_id = Str::between($request->niveau, ' ', ' ');
        $groupe_id = Str::afterLast($request->niveau, ' ');

        $classe  = Classe::findOrFail($classe_id);
        $serie = Serie::findOrFail($serie_id);
        $groupe = Groupe::findOrFail($groupe_id);

        $niveau = $classe->classe . ' ' . $serie->serie . ' ' . $groupe->groupe;

        $eleves = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->join('groupes', 'groupes.id', '=', 'eleves.groupe_id')
            ->where('eleves.classe_id', $classe_id)
            ->where('eleves.serie_id', $serie_id)
            ->where('eleves.groupe_id', $groupe_id)
            ->select('eleves.id', 'eleves.matricule', 'eleves.name', 'eleves.avatar')
            ->orderBy('eleves.name')
            ->get();

        return view('visiteur.resultats.eleves_par_classe', compact([
            'user', 'periodicite', 'periode', 'niveau', 'eleves',
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($periode_id, $eleve_id)
    {
        $user = Auth::user();

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs', 'name')
            ->get();

        $periode = DB::table('periodicite_devoirs')
            ->where('id', $periode_id)
            ->select('id', 'numero')
            ->get();

        $eleve = Eleve::findOrFail($eleve_id);

        $matieres = DB::table('emplois_du_temps')
            ->join('matieres', 'matieres.id', 'emplois_du_temps.matiere_id')
            ->where('emplois_du_temps.classe_id', $eleve->classe_id)
            ->where('emplois_du_temps.serie_id', $eleve->serie_id)
            ->where('emplois_du_temps.groupe_id', $eleve->groupe_id)
            ->select('matieres.id', 'matieres.name')
            ->groupBy('matieres.id', 'matieres.name')
            ->orderBy('matieres.name')
            ->get();

        $toutes_les_notes_par_matieres = [];
        $coefficients = 0;
        $total_des_points = 0;
        $moyenne_totale = 0;
        foreach ($matieres as $matiere) {
            $une_matiere = [];
            $une_matiere['matiere_name'] = $matiere->name;

            $coefficient = DB::table('coefficients')
                ->where('classe_id', $eleve->classe_id)
                ->where('serie_id', $eleve->serie_id)
                ->where('matiere_id', $matiere->id)
                ->select('coefficient')
                ->get();
            $une_matiere['coefficient'] = $coefficient[0]->coefficient;

            $moyenne_interro = DB::select('select avg(note) as moyenne_interro from notes where eleve_id = ' . $eleve_id . ' and periodicite_devoir_id = ' . $periode_id . ' and matiere_id = ' . $matiere->id . ' and composition_id = 1');
            $une_matiere['moyenne_interro'] = $moyenne_interro[0]->moyenne_interro;
            $devoirs = DB::select('select note from notes where periodicite_devoir_id = ' . $periode_id . ' and composition_id = 2 and matiere_id = ' . $matiere->id . ' and notes.eleve_id = ' . $eleve_id);
            $une_matiere['notes_devoirs'] = $devoirs;
            $somme = DB::select('select sum(note) + (select avg(note) from notes where eleve_id = ' . $eleve_id . ' and periodicite_devoir_id = ' . $periode_id . ' and matiere_id = ' . $matiere->id . ' and composition_id = 1 ) as totale from notes where eleve_id = ' . $eleve_id . ' and periodicite_devoir_id = ' . $periode_id . ' and matiere_id = ' . $matiere->id . ' and composition_id = 2 ;');
            $une_matiere['moyenne_finale'] = $somme[0]->totale / 3;

            $toutes_les_notes_par_matieres[] = $une_matiere;

            $coefficients += $coefficient[0]->coefficient;
            $total_des_points += $une_matiere['coefficient'] * $une_matiere['moyenne_finale'];
            $moyenne_totale = $total_des_points / $coefficients;
        }
        return view('visiteur.resultats.show', compact([
            'user', 'periodicite', 'periode', 'eleve', 'coefficients', 'total_des_points',
            'toutes_les_notes_par_matieres', 'moyenne_totale',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
