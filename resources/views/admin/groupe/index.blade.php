@extends('layout.theme')
@section('title', 'Groupe | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-beach"></i>
                </span>
                Groupes Enregistrés
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.groupes.create') }}">Ajouter un Groupe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Liste des groupes</h4>
                        <p class="card-description">
                            Tous les <code>.Groupes Pédagogiques</code>
                        </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Groupes
                                    </th>
                                    <th>
                                        Date de Création
                                    </th>
                                    <th>
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groupes as $groupe)
                                    <tr>
                                        <td class="py-1">
                                            <a title="Voir plus de détails"
                                                href="{{ route('admin.groupes.show', $groupe) }}">
                                                Groupe {{ $groupe->groupe }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ DATE_FORMAT($groupe->created_at, 'd M Y à H:i') }}
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a title="Voir plus de détails"
                                                    href="{{ route('admin.groupes.show', $groupe) }}" class="mdi mdi-eye"
                                                    style="color: green">
                                                </a>
                                                <a title="Mettre à jour" href="{{ route('admin.groupes.edit', $groupe) }}"
                                                    class="offset-3 mdi mdi-grease-pencil" style="color: blue">
                                                </a>
                                                <form action="{{ route('admin.groupes.destroy', $groupe) }} "
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
