@extends('layout.theme')
@section('title', 'Matiere | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-arrow-down-bold-hexagon-outline"></i>
                </span>
                Matières Enregistrées
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.matieres.create') }}">Ajouter une Matière</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des matières</h4>
                        <p class="card-description">
                            Toutes les <code>.Matières</code>
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Matières
                                    </th>
                                    <th>
                                        Date de Création
                                    </th>
                                    <th>
                                        Outils
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matieres as $matiere)
                                    <tr>
                                        <td class="py-1">
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.matieres.show', $matiere->id) }}">
                                                {{ $matiere->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $matiere->created_at }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.matieres.show', $matiere->id) }}"
                                                    class="mdi mdi-eye" style="color: green">
                                                </a>
                                                <a title="Mettre à jour"
                                                    href="{{ route('admin.matieres.edit', $matiere->id) }}"
                                                    class="offset-3 mdi mdi-grease-pencil" style="color: blue"></a>
                                                <form action="{{ route('admin.matieres.destroy', $matiere->id) }} "
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
