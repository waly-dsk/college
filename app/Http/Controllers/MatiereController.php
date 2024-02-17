<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $matieres = DB::table('matieres')
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.matiere.index', compact(['user', 'matieres']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.matiere.add', compact(['user']));
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
            'name' => ['required', 'unique:matieres,name'],
        ]);
        Matiere::create($validateData);
        return redirect('admin/matieres');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $matiere = Matiere::findOrFail($id);
        return view('admin.matiere.show', compact(['user', 'matiere']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $matiere = Matiere::findOrFail($id);

        return view('admin.matiere.edit', compact(['user', 'matiere']));
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
        $matiere = Matiere::findOrFail($id);
        $validateData = $request->validate([
            'name' => ['required', 'unique:matieres,name'],
        ]);
        $matiere->update($validateData);
        return redirect('admin/matieres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $matiere = Matiere::findOrFail($id);
        $matiere->delete();
        return redirect('admin/matieres');
    }
}
