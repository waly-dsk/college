<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupes = Groupe::all();
        $user = Auth::user();

        return view('admin.groupe.index', compact(['groupes', 'user']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.groupe.add', compact('user'));
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
            'groupe' => ['required', 'unique:groupes,groupe'],
        ]);

        Groupe::create($validateData);

        return redirect('admin/groupes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Groupe  $groupePedagogique
     * @return \Illuminate\Http\Response
     */
    public function show(Groupe $groupe)
    {
        $user = Auth::user();
        return view('admin.groupe.show', compact(['user', 'groupe']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function edit(Groupe $groupe)
    {
        $user = Auth::user();
        return view('admin.groupe.edit', compact(['user', 'groupe']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupePedagogique  $groupePedagogique
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Groupe $groupe)
    {
        $validateData = $request->validate([
            'groupe' => ['required'],
        ]);
        $groupe->update($validateData);

        return redirect('admin/groupes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Groupe  $groupe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Groupe $groupe)
    {
        $groupe->delete();
        return redirect('admin/groupes');
    }
}
