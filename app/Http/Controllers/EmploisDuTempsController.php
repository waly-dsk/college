<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Classe;
use App\Models\Groupe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmploisDuTemps;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class EmploisDuTempsController extends Controller
{
    public function mon_emplois_du_temps($enseignant_name)
    {
        $user = Auth::user();
        $enseignant = DB::table('enseignants')
            ->where('name', '=', $enseignant_name)
            ->get();

        $emplois_du_temps = DB::table('emplois_du_temps')
            ->join('classes', 'classes.id', '=', 'emplois_du_temps.classe_id')
            ->join('series', 'series.id', '=', 'emplois_du_temps.serie_id')
            ->join('groupes', 'groupes.id', '=', 'emplois_du_temps.groupe_id')
            ->join('enseignants', 'enseignants.id', '=', 'emplois_du_temps.enseignant_id')
            ->join('jours', 'jours.id', '=', 'emplois_du_temps.jour_id')
            ->join('horaires', 'horaires.id', '=', 'emplois_du_temps.horaire_id')
            ->where(
                'emplois_du_temps.enseignant_id',
                '=',
                $enseignant[0]->id
            )
            ->select(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
                'jours.id',
                'jours.jour',
                'horaires.id',
                'horaires.horaire',
            )
            ->groupBy(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
                'jours.id',
                'jours.jour',
                'horaires.id',
                'horaires.horaire',
            )
            ->orderBy(
                'jours.id',
                'asc',
            )
            ->orderBy(
                'horaires.id',
                'asc',
            )
            ->get();

        return view('enseignant.emplois_du_temps.mon_emplois_du_temps', compact(['user', 'emplois_du_temps']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
                'classes.id as classe_identifiant',
                'classes.classe',
                'series.serie',
                'groupes.groupe'
            )
            ->groupBy(
                'classe_identifiant',
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
            )
            ->orderBy('classe_identifiant')
            ->get();

        return view('admin.emplois.index', compact(['user', 'classes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $enseignants = DB::table('enseignants')
            ->join('matieres', 'matieres.id', '=', 'enseignants.matiere_id')
            ->select('enseignants.id', 'enseignants.name', 'matieres.name as matiere_name')
            ->orderBy('matieres.name', 'asc')
            ->orderBy('enseignants.name', 'asc')
            ->get();

        $matieres = DB::table('matieres')
            ->select('matieres.id', 'matieres.name')
            ->orderBy('matieres.name', 'asc')
            ->get();

        $classes = DB::table('eleves')
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
                'eleves.serie_id',
                'eleves.groupe_id',
            )
            ->orderBy('classes.id')
            ->get();

        $jours = DB::table('jours')
            ->get();

        $horaires = DB::table('horaires')
            ->get();

        return view('admin.emplois.add', compact([
            'user', 'enseignants', 'classes', 'jours',
            'horaires', 'matieres',
        ]));
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
            'enseignant_id' => 'required',
            'matiere_id' => 'required',
            'classe' => 'required',
            'enseignant_id' => 'required',
            'jour_id' => 'required',
            'horaires' => 'required',

        ]);

        $enseignant_matiere = DB::table('enseignants')
            ->join('matieres', 'matieres.id', 'enseignants.matiere_id')
            ->where('enseignants.id', $request->enseignant_id)
            ->select('enseignants.matiere_id')
            ->get();

        $programme = $request->except('_token');
        $enseignant_id = $programme['enseignant_id'];
        $matiere_id = $programme['matiere_id'];
        $classe_id = Str::before($programme['classe'], '/');
        $serie_id = Str::between($programme['classe'], '/', '/');
        $groupe_id = Str::afterLast($programme['classe'], '/');
        $jour_id = $programme['jour_id'];

        if ($enseignant_matiere[0]->matiere_id == $matiere_id) {

            for ($i = 0; $i < sizeof($programme['horaires']); $i++) {

                EmploisDuTemps::create([
                    'enseignant_id' => $enseignant_id,
                    'matiere_id' => $matiere_id,
                    'classe_id' => $classe_id,
                    'serie_id' => $serie_id,
                    'groupe_id' => $groupe_id,
                    'jour_id' => $jour_id,
                    'horaire_id' => $programme['horaires'][$i],
                ]);
            }
            return redirect()->back()->with('success', 'Enregistrement réussit !');
        } else
            return redirect()->back()->with('success', 'Enregistrement non valide! L\'Enseignant
            choisit n\'enseigne pas cette Matière ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($niveau)
    {
        $classe_id = Str::before($niveau, ' ');

        $serie_id = Str::between($niveau, ' ', ' ');

        $groupe_id = Str::afterLast($niveau, ' ');

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
                'emplois_du_temps.id as emplois_du_temps_id',
                'emplois_du_temps.matiere_id',
                'matieres.name as matiere_name',
                'enseignants.name as enseignant_name',
                'enseignants.avatar',
                'jours.id',
                'jours.jour',
                'horaires.horaire',
                'horaires.id',
            )
            ->groupBy(
                'emplois_du_temps_id',
                'emplois_du_temps.matiere_id',
                'matiere_name',
                'enseignant_name',
                'enseignants.avatar',
                'jours.id',
                'jours.jour',
                'horaires.horaire',
                'horaires.id',
            )
            ->orderBy(
                'jours.id',
                'asc'
            )
            ->orderBy(
                'horaires.id',
            )
            ->get();

        return view('admin.emplois.details', compact(['user', 'classe', 'serie', 'groupe', 'emplois_du_temps']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         *  $line = une ligne dans la table emplois du temps
         */
        $user = Auth::user();

        $line = DB::table('emplois_du_temps')
            ->join('classes', 'classes.id', '=', 'emplois_du_temps.classe_id')
            ->join('series', 'series.id', '=', 'emplois_du_temps.serie_id')
            ->join('groupes', 'groupes.id', '=', 'emplois_du_temps.groupe_id')
            ->join('enseignants', 'enseignants.id', '=', 'emplois_du_temps.enseignant_id')
            ->join('matieres', 'matieres.id', '=', 'emplois_du_temps.matiere_id')
            ->join('jours', 'jours.id', '=', 'emplois_du_temps.jour_id')
            ->join('horaires', 'horaires.id', '=', 'emplois_du_temps.horaire_id')
            ->select(
                'emplois_du_temps.id as emplois_du_temps_id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
                'matieres.name as matiere_name',
                'enseignants.name as enseignant_name',
                'enseignants.id as enseignant_id',
                'jours.jour',
                'horaires.horaire',
            )
            ->where('emplois_du_temps.id', '=', $id)
            ->get();

        $enseignants = DB::table('enseignants')
            ->join('matieres', 'matieres.id', '=', 'enseignants.matiere_id')
            ->select(
                'enseignants.id',
                'enseignants.name',
                'matieres.name as matiere_name'
            )
            ->orderBy('matieres.name', 'asc')
            ->orderBy('enseignants.name', 'asc')
            ->get();

        $matieres = DB::table('matieres')
            ->select('matieres.id', 'matieres.name')
            ->orderBy('matieres.name', 'asc')
            ->get();

        return view('admin.emplois.edit', compact(['user', 'enseignants', 'matieres', 'line']));
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
        $validateData = $request->validate([
            'matiere_id' => 'required',
            'enseignant_id' => 'required',
        ]);

        DB::table('emplois_du_temps')
            ->where('id', '=', $id)
            ->update($validateData);

        return redirect('admin/emplois_du_temps');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('emplois_du_temps')
            ->where('id', '=', $id)
            ->delete();

        return redirect()->back();
    }
}
