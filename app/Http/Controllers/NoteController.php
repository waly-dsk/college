<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Serie;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Enseignant;
use App\Models\Groupe;
use App\Models\Matiere;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user = Auth::user();
        $enseignant = DB::table('enseignants')
            ->join('matieres', 'matieres.id', 'enseignants.matiere_id')
            ->where('enseignants.name', '=', $user->name)
            ->select(
                'enseignants.id as enseignant_id',
                'matieres.name as matiere_name',
                'matieres.id as matiere_id',
            )
            ->get();

        $classe_tenues = DB::table('emplois_du_temps')
            ->join('classes', 'classes.id', '=', 'emplois_du_temps.classe_id')
            ->join('series', 'series.id', '=', 'emplois_du_temps.serie_id')
            ->join('groupes', 'groupes.id', '=', 'emplois_du_temps.groupe_id')
            ->where(
                'emplois_du_temps.enseignant_id',
                '=',
                $enseignant[0]->enseignant_id
            )
            ->select(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
                'classes.id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
            )
            ->groupBy(
                'emplois_du_temps.classe_id',
                'emplois_du_temps.serie_id',
                'emplois_du_temps.groupe_id',
                'classes.id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
            )
            ->orderBy(
                'classes.id',
                'asc'
            )
            ->get();

        return view('enseignant.note.classes_tenues', compact(['user', 'enseignant', 'classe_tenues']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $classe_id = $request->classe_id;
        $serie_id = $request->serie_id;
        $groupe_id = $request->groupe_id;
        $matiere_id = $request->matiere_id;

        $user = Auth::user();
        $classe = Classe::findOrFail($classe_id);
        $serie = Serie::findOrFail($serie_id);
        $groupe = Groupe::findOrFail($groupe_id);

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periodes = DB::table('periodicite_devoirs')
            ->get();

        $matiere = Matiere::findOrFail($matiere_id);

        $eleves = DB::table('eleves')
            ->where('eleves.classe_id', '=', $classe_id)
            ->where('eleves.serie_id', '=', $serie_id)
            ->where('eleves.groupe_id', '=', $groupe_id)
            ->select(
                'eleves.id',
                'eleves.name',
                'eleves.matricule',
                'eleves.avatar',
                'eleves.genre',
                'eleves.telephone',
                'eleves.email',
            )
            ->orderBy('eleves.name')
            ->get();

        $compositions = DB::table('compositions')
            ->get();

        $numeros = DB::table('numeros')
            ->orderBy('numero', 'asc')
            ->get();

        return view('enseignant.note.add_note', compact([
            'user', 'eleves', 'compositions', 'numeros',
            'matiere', 'periodes', 'periodicite',
            'classe', 'serie', 'groupe',
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
        for ($i = 0; $i < sizeof($request->eleve_id); $i++) {
            Note::create([
                'eleve_id' => $request->eleve_id[$i],
                'periodicite_devoir_id' => $request->periodicite_devoir_id,
                'matiere_id' => $request->matiere_id,
                'composition_id' => $request->composition_id,
                'numero_id' => $request->numero_id,
                'note' => $request->note[$i],
            ]);
        }
        return to_route('enseignant.notes.index')->with('success', 'Notes bien enregistrées !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_note_start()
    {
        $user = Auth::user();

        $matieres = DB::table('matieres')
            ->orderBy('name')
            ->get();

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periodes = DB::table('periodicite_devoirs')
            ->get();

        $niveaux = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->join('groupes', 'groupes.id', '=', 'eleves.groupe_id')
            ->select(
                'eleves.classe_id',
                'eleves.serie_id',
                'eleves.groupe_id',
                'classes.id as order',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
            )
            ->groupBy(
                'eleves.classe_id',
                'eleves.serie_id',
                'eleves.groupe_id',
                'classes.classe',
                'series.serie',
                'groupes.groupe',
            )
            ->orderBy(
                'order',
            )
            ->get();

        $composition_types = DB::table('compositions')
            ->get();

        $composition_numeros = DB::table('numeros')
            ->get();

        return view('visiteur.note.classes_et_matieres_par_periodes', compact([
            'user', 'niveaux', 'matieres',
            'periodes', 'periodicite',
            'composition_types', 'composition_numeros',
        ]));
    }

    public function show_note_post(Request $request)
    {
        $request->validate([
            'niveau' => 'required',
            'matiere_id' => 'required',
        ]);

        $user = Auth::user();

        $classe_id = Str::before($request->niveau, ' ');
        $serie_id = Str::between($request->niveau, ' ', ' ');
        $groupe_id = Str::afterLast($request->niveau, ' ');

        $matiere_id = $request->matiere_id;
        $periode_id = $request->periodicite_devoir_id;

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periodicite_numero = DB::table('periodicite_devoirs')
            ->where('id', $periode_id)
            ->select('id', 'numero')
            ->get();

        $classe = Classe::findOrFail($classe_id);
        $serie = Serie::findOrFail($serie_id);
        $groupe = Groupe::findOrFail($groupe_id);
        $matiere = Matiere::findOrFail($matiere_id);

        $eleves = DB::table('eleves')
            ->where('classe_id', '=', $classe_id)
            ->where('serie_id', '=', $serie_id)
            ->where('groupe_id', '=', $groupe_id)
            ->select('id', 'name', 'avatar')
            ->orderBy('name', 'asc')
            ->get();

        $eleves_notes = [];

        foreach ($eleves as $eleve) {
            $un_eleve = [];
            $un_eleve['identifiant'] = $eleve->id;
            $un_eleve['name'] = $eleve->name;
            $un_eleve['avatar'] = $eleve->avatar;

            $interrogations = DB::select('select note from notes  where periodicite_devoir_id = ' . $periode_id . ' and composition_id = 1 and matiere_id = ' . $matiere_id . ' and eleve_id =  ' . $eleve->id);
            $devoirs = DB::select('select note from notes  where periodicite_devoir_id =' . $periode_id . ' and composition_id = 2 and matiere_id = ' . $matiere_id . ' and eleve_id = ' . $eleve->id);
            $examen_blanc = DB::select('select note from  notes where periodicite_devoir_id =' . $periode_id . ' and composition_id = 3 and matiere_id = ' . $matiere_id . ' and eleve_id = ' . $eleve->id);

            $un_eleve['interrogations'] = $interrogations;
            $un_eleve['devoirs'] = $devoirs;
            $un_eleve['examen_blanc'] = $examen_blanc;

            $eleves_notes[] = $un_eleve;
        }
        return view('visiteur.note.notes_par_classe_matiere_composition', compact([
            'user', 'classe', 'serie', 'groupe', 'matiere', 'eleves_notes',
            'periodicite', 'periodicite_numero',
        ]));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $eleve_id = $request->eleve_id;
        $periode_id = $request->periode_id;
        $matiere_id = $request->matiere_id;
        $classe = $request->classe;

        $user = Auth::user();
        $niveau = Eleve::findOrFail($eleve_id);

        $periodicite = DB::table('infos_generales')
            ->select('periodicite_devoirs')
            ->get();

        $periodicite_numero = DB::table('periodicite_devoirs')
            ->where('id', $periode_id)
            ->select('id', 'numero')
            ->get();

        $enseignant_id = DB::table('emplois_du_temps')
            ->where('classe_id', $niveau->classe_id)
            ->where('serie_id', $niveau->serie_id)
            ->where('groupe_id', $niveau->groupe_id)
            ->where('matiere_id', $matiere_id)
            ->select('enseignant_id')
            ->groupBy('enseignant_id')
            ->get();

        $enseignant = Enseignant::findOrFail($enseignant_id[0]->enseignant_id);

        $eleve = Eleve::findOrFail($eleve_id);
        $matiere = Matiere::findOrFail($matiere_id);

        $interros = DB::table('notes')
            ->where('eleve_id', $eleve_id)
            ->where('matiere_id', $matiere_id)
            ->where('periodicite_devoir_id', $periode_id)
            ->where('composition_id', 1)
            ->select('notes.note')
            ->get();

        $devoirs = DB::table('notes')
            ->where('eleve_id', $eleve_id)
            ->where('matiere_id', $matiere_id)
            ->where('periodicite_devoir_id', $periode_id)
            ->where('composition_id', 2)
            ->select('notes.note')
            ->get();

        $examen_blancs = DB::table('notes')
            ->where('eleve_id', $eleve_id)
            ->where('matiere_id', $matiere_id)
            ->where('periodicite_devoir_id', $periode_id)
            ->where('composition_id', 3)
            ->select('notes.note')
            ->get();

        if ($user->name == $enseignant->name)
            return view('enseignant.note.edit', compact([
                'user', 'eleve', 'matiere', 'classe', 'interros',
                'devoirs', 'examen_blancs',
                'periodicite', 'periodicite_numero',
            ]));
        else
            abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $periodicite_id, $eleve_id, $matiere_id)
    {
        function mise_a_jour($note_array, $periodicite, $eleve, $matiere, $composition)
        {
            if ($note_array)
                for ($i = 0; $i < sizeof($note_array); $i++) {
                    DB::table('notes')
                        ->where('periodicite_devoir_id', $periodicite)
                        ->where('eleve_id', $eleve)
                        ->where('matiere_id', $matiere)
                        ->where('composition_id', $composition)
                        ->where('numero_id', ($i + 1))
                        ->update([
                            'note' => $note_array[$i],
                        ]);
                }
        }

        mise_a_jour($request->interros, $periodicite_id, $eleve_id, $matiere_id, 1);
        mise_a_jour($request->devoirs, $periodicite_id, $eleve_id, $matiere_id, 2);
        mise_a_jour($request->examen_blancs, $periodicite_id, $eleve_id, $matiere_id, 3);

        return redirect('visiteur/notes/show_note_start');
    }
}
