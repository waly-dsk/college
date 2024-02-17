@extends('layout.theme')
@section('title', 'Visiteur | Résultats')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-codepen"></i>
                </span>
                Relevé de Notes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{ $periodicite[0]->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body text-center">
                        <p class="card-description">
                            Voyez ici <code>Profile</code>, <code>Classe</code> et <code>Contacts</code>
                        </p>
                        <hr>
                        <img src="{{ Storage::url($eleve->avatar) }}" alt="profile"
                            class="img-fluid rounded-circle mb-2">
                        <br>
                        <br>
                        <h4 class="card-title text-center text-muted">
                            @if ($eleve->genre == 'F')
                                Mlle. {{ $eleve->name }}
                            @else
                                M. {{ $eleve->name }}
                            @endif
                        </h4>
                        <label class="text-muted">
                            {{ $eleve->classe->classe . '  ' . $eleve->serie->serie . ' ' . $eleve->groupe->groupe }}
                        </label>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-md-6">
                                <address class="text-primary">
                                    <p class="font-weight-bold">
                                        E-mail
                                    </p>
                                    <p class="mb-2">
                                        {{ $eleve->email }}
                                    </p>
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address class="text-info">
                                    <p class="font-weight-bold">
                                        Téléphone
                                    </p>
                                    <p>
                                        {{ $eleve->telephone }}
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-muted">
                            {{ Str::ucfirst($periodicite[0]->periodicite_devoirs) . ' ' . $periode[0]->numero }}
                        </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Matière
                                        </th>
                                        <th>
                                            Coeff
                                        </th>
                                        <th>
                                            Moy_Interro
                                        </th>
                                        <th>
                                            <span class="ml-4">
                                                Devoirs
                                            </span>
                                        </th>
                                        <th>
                                            Moy / 20
                                        </th>
                                        <th>
                                            Moy Coeff
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($toutes_les_notes_par_matieres as $toutes_les_notes_par_matiere)
                                        <tr>
                                            <td>
                                                <label class="ml-1">
                                                    {{ Str::upper($toutes_les_notes_par_matiere['matiere_name']) }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ml-1 badge badge-gradient-info">
                                                    {{ $toutes_les_notes_par_matiere['coefficient'] }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ml-3 badge badge-gradient-danger">
                                                    {{ Str::limit($toutes_les_notes_par_matiere['moyenne_interro'], 5, ' ') }}
                                                </label>
                                            </td>
                                            <td>
                                                @foreach ($toutes_les_notes_par_matiere['notes_devoirs'] as $devoir_note)
                                                    <label class="badge badge-gradient-dark">
                                                        {{ $devoir_note->note }}
                                                    </label>
                                                @endforeach
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-secondary">
                                                    {{ Str::limit($toutes_les_notes_par_matiere['moyenne_finale'], 5, ' ') }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-danger">
                                                    {{ Str::limit($toutes_les_notes_par_matiere['coefficient'] * $toutes_les_notes_par_matiere['moyenne_finale'], 5, ' ') }}
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>
                                            TOTAL
                                        </td>
                                        <td>
                                            <label class="ml-1 badge badge-gradient-info">
                                                {{ $coefficients }}
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label class="badge badge-gradient-danger">
                                                {{ Str::limit($total_des_points, 5, '') }}
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <br>
                            @if ($moyenne_totale)
                                <button type="button" class="offset-9 btn btn-primary">
                                    Moyenne :
                                    {{ Str::limit($moyenne_totale, 5, ' ') }}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
