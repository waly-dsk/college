@extends('layout.theme')
@section('title', 'Infos | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-beach"></i>
                </span>
                Renseignements
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }} ">Retour</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            @if ($infos)
                @foreach ($infos as $info)
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"> {{ $info->name }}</h4>
                                <p class="card-description">
                                    Informations <code>.Générales</code>
                                </p>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Année de Création
                                            </th>
                                            <th>
                                                Périodicité des Devoirs
                                            </th>
                                            <th>
                                                Mettre à jour
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label class="ml-3 badge badge-gradient-primary">
                                                    {{ $info->annee }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="ml-3 badge badge-gradient-danger">
                                                    {{ Str::ucfirst($info->periodicite_devoirs) }}
                                                </label>
                                            </td>
                                            <td>
                                                <a title="Mettre à jour"
                                                    href="{{ route('admin.infos_generales.edit', $info->id) }}"
                                                    class="offset-2 mdi mdi-grease-pencil" style="color: blue">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
