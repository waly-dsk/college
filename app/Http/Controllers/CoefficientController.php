<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use App\Models\Coefficient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Eleve;

class CoefficientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $niveaux = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->select(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.id as order',
                'classes.classe',
                'series.serie',
            )
            ->groupBy(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.classe',
                'series.serie',
            )
            ->orderBy(
                'order',
            )
            ->get();

        return view('visiteur.coefficient.index', compact(['user', 'niveaux']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $matieres = DB::table('matieres')
            ->orderBy('name')
            ->get();

        $niveaux = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->select(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.id as order',
                'classes.classe',
                'series.serie',
            )
            ->groupBy(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.classe',
                'series.serie',
            )
            ->orderBy(
                'order',
            )
            ->get();

        return view('admin.coefficient.add', compact(['user', 'niveaux', 'matieres']));
    }

    public function show($niveau)
    {
        $classe_id = Str::before($niveau, ' ');
        $serie_id = Str::after($niveau, ' ');
        $user = Auth::user();
        $coefficients = DB::table('coefficients')
            ->join('classes', 'classes.id', '=', 'coefficients.classe_id')
            ->join('series', 'series.id', '=', 'coefficients.serie_id')
            ->join('matieres', 'matieres.id', '=', 'coefficients.matiere_id')
            ->where('coefficients.classe_id', $classe_id)
            ->where('coefficients.serie_id', $serie_id)
            ->select(
                'coefficients.id',
                'coefficients.coefficient',
                'classes.id as order',
                'classes.classe',
                'series.serie',
                'matieres.name as matiere',
            )
            ->orderBy('order')
            ->orderBy('series.serie')
            ->orderBy('matiere')
            ->get();

        return view('visiteur.coefficient.details', compact(['user', 'coefficients']));
        dd($niveau);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * on va utiliser un bloc try/catch. Try pour la démarche escomptée et catch pour capturer
         * les erreurs.
         */
        try {
            // Code qui exécute l'opération d'insertion
            /**
             * on traite d'abord les données du formulaire
             */
            $validateData = $request->validate([
                'matiere_id' => ['required'],
                'classe' => ['required'],
                'coefficient' => ['required'],
            ]);
            /**
             * Quand les données sont valides
             */
            $classe_id = Str::before($validateData['classe'], '/');
            $serie_id = Str::after($validateData['classe'], '/');

            /**
             * on crée la donnée coefficient sachant qu'une classe ne peut qu'avoir un seul
             * coefficient par matiere
             */
            Coefficient::create([
                'matiere_id' => $validateData['matiere_id'],
                'classe_id' => $classe_id,
                'serie_id' => $serie_id,
                'coefficient' => $validateData['coefficient'],
            ]);
            return redirect()->back()->with('success', 'Coefficient bien ajouté !');
        } catch (\Illuminate\Database\QueryException $e) {
            // Gérer l'erreur de contrainte ici
            if ($e->getCode() == '23000') {
                // La violation de contrainte unique s'est produite
                return back()->with('error', "Une erreur de contrainte unique s'est produite. Veuillez vérifier les données saisies.");
            } else {
                // Autre type d'erreur de base de données
                // Gérez-le en conséquence
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coefficient  $coefficient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $coefficient = Coefficient::findOrFail($id);

        $matieres = DB::table('matieres')
            ->orderBy('name')
            ->get();

        $niveaux = DB::table('eleves')
            ->join('classes', 'classes.id', '=', 'eleves.classe_id')
            ->join('series', 'series.id', '=', 'eleves.serie_id')
            ->select(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.id as order',
                'classes.classe',
                'series.serie',
            )
            ->groupBy(
                'eleves.classe_id',
                'eleves.serie_id',
                'classes.classe',
                'series.serie',
            )
            ->orderBy(
                'order',
            )
            ->get();

        return view('admin.coefficient.edit', compact(['user', 'coefficient', 'matieres', 'niveaux']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coefficient  $coefficient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'matiere_id' => ['required'],
            'classe' => ['required'],
            'coefficient' => ['required'],
        ]);

        $classe_id = Str::before($validateData['classe'], '/');
        $serie_id = Str::after($validateData['classe'], '/');

        $coefficient = Coefficient::findOrFail($id);
        $coefficient->update([
            'matiere_id' => $validateData['matiere_id'],
            'classe_id' => $classe_id,
            'serie_id' => $serie_id,
            'coefficient' => $validateData['coefficient'],
        ]);
        return redirect('admin/coefficients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coefficient  $coefficient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coefficient = Coefficient::findOrFail($id);
        $coefficient->delete();
        return redirect('admin/coefficients');
    }
}
