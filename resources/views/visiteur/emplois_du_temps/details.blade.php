@extends('layout.theme')
@section('title', 'Emplois du Temps | Suite')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-chemical-weapon"></i>
                </span>
                Emplois Du Temps
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Formulaire</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $classe->classe . ' ' . $serie->serie . ' ' . $groupe->groupe }}
                        </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Horaire</th>
                                        <th>Matière</th>
                                        <th>Chargé</th>
                                        <th>Profile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < sizeof($emplois_du_temps); $i++)
                                        <tr>
                                            <td>
                                                <label>
                                                    {{ $emplois_du_temps[$i]->jour }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-info">
                                                    {{ $emplois_du_temps[$i]->horaire }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-danger">
                                                    {{ $emplois_du_temps[$i]->matiere_name }}
                                                </label>
                                            </td>
                                            <td>
                                                {{ $emplois_du_temps[$i]->enseignant_name }}
                                            </td>
                                            <td>
                                                <img src="{{ Storage::url($emplois_du_temps[$i]->avatar) }} "
                                                    class="mr-2" alt="image" />
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
