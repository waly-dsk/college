<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eleve;
use App\Models\Serie;
use App\Models\Classe;
use App\Models\Groupe;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eleves = DB::table('eleves')
            ->join('classes', 'eleves.classe_id', '=', 'classes.id')
            ->join('series', 'eleves.serie_id', '=', 'series.id')
            ->join('groupes', 'eleves.groupe_id', '=', 'groupes.id')
            ->select(
                'eleves.id',
                'eleves.name',
                'eleves.avatar',
                'eleves.matricule',
                'eleves.date_naissance',
                'eleves.lieu_naissance',
                'eleves.created_at',
                'series.serie',
                'classes.classe',
                'groupes.groupe',
            )
            ->orderBy('eleves.classe_id',  'asc')
            ->orderBy('eleves.serie_id',  'asc')
            ->orderBy('eleves.groupe_id',  'asc')
            ->orderBy('eleves.name',  'asc')
            ->get();

        // dd($eleves);
        $user = Auth::user();
        return view('admin.eleve.index', compact(['user', 'eleves']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $classes = Classe::all();
        $series = Serie::all();
        $groupes = Groupe::all();
        return view('admin.eleve.add', compact(['user', 'groupes', 'series', 'classes']));
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
            'matricule' => ['required', 'unique:eleves'],
            'name' => ['required', 'unique:eleves'],
            'email' => ['required', 'unique:eleves'],
            'telephone' => ['required', 'unique:eleves'],
            'genre' => ['required'],
            'date_naissance' => ['required'],
            'lieu_naissance' => ['required'],
            'classe_id' => ['required'],
            'groupe_id' => ['required'],
            'serie_id' => ['required'],
            'password' => ['required'],
            'avatar' => ['required'],
        ]);

        $firstname = Str::before($request->name, ' ');
        $lastname = Str::afterLast($request->name, ' ');
        $name = $request->matricule . $firstname . $lastname;
        $filename =  Str::lower($name) . '.' . $request->avatar->extension();

        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'role' => 'eleve',
            'password' => bcrypt($validateData['password']),
            'avatar' => 'avatars/' . $filename,
        ]);

        Eleve::create([
            'matricule' => $validateData['matricule'],
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'telephone' => $validateData['telephone'],
            'genre' => $validateData['genre'],
            'date_naissance' => $validateData['date_naissance'],
            'lieu_naissance' => $validateData['lieu_naissance'],
            'classe_id' => $validateData['classe_id'],
            'groupe_id' => $validateData['groupe_id'],
            'serie_id' => $validateData['serie_id'],
            'avatar' => 'avatars/' . $filename,
        ]);

        $request->file('avatar')->storeAs(
            'avatars',
            $filename,
            'public',
        );


        return redirect()->back()->with('success', 'Enregistré avec succès.
                                        Peut désormais se connecter en tant qu\'élève sur le Site.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $eleve = Eleve::findOrFail($id);
        return view('admin.eleve.show', compact(['user', 'eleve']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $eleve = Eleve::findOrFail($id);
        $classes = Classe::all();
        $series = Serie::all();
        $groupes = Groupe::all();

        return view('admin.eleve.edit', compact(['user', 'eleve', 'classes', 'series', 'groupes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eleve = Eleve::findOrFail($id);

        $user = DB::table('users')
            ->where('email', $eleve->email)
            ->select('id')
            ->get();

        $user = User::findOrFail($user[0]->id);

        $validateData = $request->validate([
            'matricule' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
            'telephone' => ['required'],
            'genre' => ['required'],
            'date_naissance' => ['required'],
            'lieu_naissance' => ['required'],
            'classe_id' => ['required'],
            'groupe_id' => ['required'],
            'serie_id' => ['required'],
        ]);

        $user->update([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
        ]);

        DB::table('eleves')
            ->where('id', $id)
            ->update($validateData);
        return redirect('admin/eleves');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('eleves')->where('id', '=', $id)->delete();
        return redirect('admin/eleves');
    }
}
