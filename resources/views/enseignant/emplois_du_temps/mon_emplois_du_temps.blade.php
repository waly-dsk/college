@extends('layout.theme')
@section('title', 'Enseignant | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-blackberry"></i>
                </span>
                Mon Emplois du Temps
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-muted">
                        </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Horaire</th>
                                        <th>Classe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emplois_du_temps as $emplois_du_temp)
                                        <tr>
                                            <td>
                                                <label class="badge badge-gradient-danger">
                                                    {{ $emplois_du_temp->jour }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-success">
                                                    {{ $emplois_du_temp->horaire }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="">
                                                    {{ $emplois_du_temp->classe . ' ' . $emplois_du_temp->serie . ' ' . $emplois_du_temp->groupe }}
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
