<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $enseignants = DB::table('enseignants')
            ->join('matieres', 'matieres.id', '=', 'enseignants.matiere_id')
            ->select(
                'matieres.name as matiere_name',
                'enseignants.name as enseignant_name',
                'enseignants.id',
                'enseignants.avatar',
            )
            ->orderBy('matieres.name')
            ->orderBy('enseignants.name')
            ->get();
        return view('admin.enseignant.index', compact(['user', 'enseignants']));
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
            ->select('matieres.id', 'matieres.name')
            ->orderBy('matieres.name', 'asc')
            ->get();

        return view('admin.enseignant.add', compact(['user', 'matieres']));
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
            'email' => ['required', 'unique:enseignants'],
            'telephone' => ['required', 'unique:enseignants'],
            'genre' => ['required'],
            'matiere_id' => ['required'],
            'password' => ['required'],
            'avatar' => ['required'],
        ]);

        $firstname = Str::before($request->name, ' ');
        $lastname = Str::afterLast($request->name, ' ');
        $name = $firstname . $lastname . $request->telephone;
        $filename =  Str::lower($name) . '.' . $request->avatar->extension();


        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'role' => 'enseignant',
            'password' => bcrypt($validateData['password']),
            'avatar' => 'avatars/' . $filename,
        ]);

        Enseignant::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'telephone' => $validateData['telephone'],
            'genre' => $validateData['genre'],
            'matiere_id' => $validateData['matiere_id'],
            'avatar' => 'avatars/' . $filename,
        ]);

        $request->file('avatar')->storeAs(
            'avatars',
            $filename,
            'public',
        );

        return redirect()->back()->with('success', 'Enregistrement en tant qu\'Utilisateur et Enseignant.
        Peut désormais se connecter en tant qu\'enseignant sur le Site.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        $enseignant = Enseignant::findOrFail($id);

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
                $id
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

        return view('admin.enseignant.show', compact(['user', 'enseignant', 'emplois_du_temps']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $enseignant = Enseignant::findOrFail($id);

        $matieres = DB::table('matieres')
            ->select('matieres.id', 'matieres.name')
            ->orderBy('matieres.name', 'asc')
            ->get();

        return view('admin.enseignant.edit', compact(['user', 'matieres', 'enseignant']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enseignant = Enseignant::findOrFail($id);

        $user = DB::table('users')
            ->where('email', $enseignant->email)
            ->select('id')
            ->get();

        $user = User::findOrFail($user[0]->id);

        $validateData = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'telephone' => ['required'],
            'genre' => ['required'],
            'matiere_id' => ['required'],
        ]);

        $user->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
        ]);

        $enseignant->update($validateData);
        return redirect('admin/enseignants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enseignant  $enseignant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enseignant = Enseignant::findOrFail($id);
        $enseignant->delete();
    }
}
