<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\InfosGenerales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::getProvider()->retrieveByCredentials($credentials);
            $nombre_eleves = sizeof(Eleve::all());
            $infos = sizeof(InfosGenerales::all());
            return view('layout.welcome', compact(['user', 'nombre_eleves', 'infos']));
        }

        return redirect()->back()->with('error', 'Identifiants incorrects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $user = Auth::user();
        $nombre_eleves = 12;
        return view('layout.welcome', compact(['user', 'nombre_eleves']));
    }

    public function profile()
    {
        $user = Auth::user();

        $matiere = DB::table('enseignants')
            ->join('matieres', 'enseignants.matiere_id', 'matieres.id')
            ->where('enseignants.name', $user->name)
            ->select('matieres.name as matiere_name')
            ->get();

        return view('layout.profile', compact(['user', 'matiere']));
    }
}
