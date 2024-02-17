@extends('layout.theme')
@section('title', 'Série | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-application"></i>
                </span>
                Séries Enregistrées
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.series.create') }}">Ajouter une Série</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des séries</h4>
                        <p class="card-description">
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Série
                                    </th>
                                    <th>
                                        Date Enregistrement
                                    </th>
                                    <th>
                                        <span>
                                            Outils
                                        </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($series as $serie)
                                    <tr>
                                        <td class="py-1">
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.series.show', $serie->id) }}">
                                                <label class="ml-3">{{ $serie->serie }}</label>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $serie->created_at }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.series.show', $serie->id) }}"
                                                    class="mdi mdi-eye" style="color: green">
                                                </a>
                                                <a title="Mettre à jour"
                                                    href="{{ route('admin.series.edit', $serie->id) }}"
                                                    class="offset-3 mdi mdi-grease-pencil" style="color: blue"></a>
                                                <form action="{{ route('admin.series.destroy', $serie->id) }} "
                                                    method="post" class="offset-3">
                                                    @method('delete')
                                                    @csrf
                                                    <button title="Supprimer" type="submit"
                                                        style="color: red; border: none">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
                                            </div>
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
@endsection
