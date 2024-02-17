<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $series = DB::table('series')
            ->where('serie', '!=', ' ')
            ->orderBy('serie', 'asc')
            ->get();
        return view('admin.serie.index', compact(['user', 'series']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.serie.add', compact('user'));
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
            'serie' => ['unique:series,serie'],
        ]);
        Serie::create($validateData);
        return redirect('admin/series');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serie = Serie::findOrFail($id);
        $user = Auth::user();
        return view('admin.serie.show', compact(['user', 'serie']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serie = Serie::findOrFail($id);

        $user = Auth::user();
        return view('admin.serie.edit', compact(['user', 'serie']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'serie' => ['required', 'unique:series,serie'],
        ]);

        DB::table('series')
            ->where('id', $id)
            ->update(['serie' => $validateData['serie']]);
        return redirect('admin/series');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('series')->where('id', '=', $id)->delete();
        return redirect('admin/series');
    }
}
