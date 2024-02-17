<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Enseignant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $users = DB::table('users')
            // ->where('role', 'admin')
            ->orderBy('role')
            ->orderBy('name')
            ->get();
        return view('admin.user.index', compact(['user', 'users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $matieres = Matiere::all();
        return view('admin.user.add', compact(['user', 'matieres']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users'],
            'role' => ['required'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'avatar' => ['required'],
        ]);

        $firstname = Str::beforeLast($request->name, ' ');
        $lastname = Str::after($request->name, ' ');
        $name = $firstname . $lastname;
        $filename =  Str::lower($name) . '.' . $request->avatar->extension();

        User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'role' => $credentials['role'],
            'password' => bcrypt($credentials['password']),
            'avatar' => 'avatars/' . $filename,
        ]);

        $request->file('avatar')->storeAs(
            'avatars',
            $filename,
            'public',
        );
        return redirect('admin/users');
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
        $unknown_user = User::findOrFail($id);

        return view('admin.user.edit', compact(['user', 'unknown_user']));
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
        $unknown_user = User::findOrFail($id);

        $validateDate = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'role' => ['required'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        if ($validateDate['role'] == 'eleve') {

            $user = DB::table('eleves')
                ->where('email', $validateDate['email'])
                ->select('id')
                ->get();

            $eleve = Eleve::findOrFail($user[0]->id);

            $eleve->update([
                'name' => $validateDate['name'],
                'email' => $validateDate['email'],
            ]);
        } elseif ($validateDate['role'] == 'enseignant') {

            $user = DB::table('enseignants')
                ->where('email', $validateDate['email'])
                ->select('id')
                ->get();

            $enseignant = Enseignant::findOrFail($user[0]->id);

            $enseignant->update([
                'name' => $validateDate['name'],
                'email' => $validateDate['email'],
            ]);
        }

        $unknown_user->update($validateDate);

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unknown_user = User::findOrFail($id);
        $unknown_user->delete();
        return redirect()->back();
    }
}
