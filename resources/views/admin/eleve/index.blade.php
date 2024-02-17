@extends('layout.theme')
@section('title', 'Elèves | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-broom"></i>
                </span>
                Elèves Enregistrés
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.eleves.create') }}">Ajouter un Elève</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des Elèves</h4>
                        <p class="card-description">
                            Tous les <code>.Elèves</code>
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
                                        Classe
                                    </th>
                                    <th>
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eleves as $eleve)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }}" alt="logo">
                                        </td>
                                        <td>
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.eleves.show', $eleve->id) }}">
                                                {{ $eleve->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $eleve->classe . ' ' . $eleve->serie . ' ' . $eleve->groupe }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.eleves.show', $eleve->id) }}" class="mdi mdi-eye"
                                                    style="color: green">
                                                </a>
                                                <a title="Mettre à jour" href="{{ route('admin.eleves.edit', $eleve->id) }}"
                                                    class="offset-3 mdi mdi-grease-pencil" style="color: blue"></a>
                                                <form action="{{ route('admin.eleves.destroy', $eleve->id) }} "
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
