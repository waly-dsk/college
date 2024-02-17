@extends('layout.theme')
@section('title', 'Classe | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-cake-layered"></i>
                </span>
                Classes Enregistrées
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.classes.create') }}">Ajouter une Classe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des classes</h4>
                        <p class="card-description">
                            Toutes les <code>.Classes</code>
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Classe
                                    </th>
                                    <th>
                                        Date Enregistrement
                                    </th>
                                    <th>
                                        Outils
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($classes as $classe)
                                    <tr>
                                        <td>
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.classes.show', $classe->id) }}">
                                                {{ $classe->classe }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ DATE_FORMAT($classe->created_at, 'd M Y à H:i') }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.classes.show', $classe->id) }}"
                                                    class="mdi mdi-eye" style="color: green">
                                                </a>
                                                <a href="{{ route('admin.classes.edit', $classe->id) }}"
                                                    title="Mettre à jour" class="offset-3 mdi mdi-grease-pencil"
                                                    style="color: blue"></a>
                                                <form action="{{ route('admin.classes.destroy', $classe->id) }}"
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
