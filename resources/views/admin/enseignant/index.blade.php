@extends('layout.theme')
@section('title', 'Enseignant | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-blender"></i>
                </span>
                Enseignants Enregistrés
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.enseignants.create') }}">
                            Ajouter un Enseignant
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des enseignants</h4>
                        <p class="card-description">
                            Tous les enseignants <code>.enseignants</code>
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Profile
                                    </th>
                                    <th>
                                        Nom Prénoms
                                    </th>
                                    <th>
                                        Matière
                                    </th>
                                    <th>
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enseignants as $enseignant)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ Storage::url($enseignant->avatar) }}" alt="profile">
                                        </td>
                                        <td>
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.enseignants.show', $enseignant->id) }}">
                                                {{ $enseignant->enseignant_name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $enseignant->matiere_name }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.enseignants.show', $enseignant->id) }}">
                                                    <i class="mdi mdi-eye" style="color: green"></i>
                                                </a>
                                                <a title="Mettre à jour"
                                                    href="{{ route('admin.enseignants.edit', $enseignant->id) }}"
                                                    class="offset-3 mdi mdi-grease-pencil" style="color: blue">
                                                </a>
                                                <form action="{{ route('admin.enseignants.destroy', $enseignant->id) }} "
                                                    method="post" class="offset-3">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" title="Supprimer"
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
