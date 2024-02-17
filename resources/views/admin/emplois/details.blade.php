@extends('layout.theme')
@section('title', 'Emplois du Temps | Suite')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-bowl"></i>
                </span>
                Emplois Du Temps
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.emplois_du_temps.create') }}">Ajouter</a></li>
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
                                        <th>Chargé de la Matière</th>
                                        <th>Supprimer ?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emplois_du_temps as $emplois_du_temp)
                                        <tr>
                                            <td>
                                                <a title="Modifer le Programme"
                                                    href="{{ route('admin.emplois_du_temps.edit', $emplois_du_temp->emplois_du_temps_id) }}">
                                                    <label>
                                                        {{ $emplois_du_temp->jour }}
                                                    </label>

                                                </a>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-success">
                                                    {{ $emplois_du_temp->horaire }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-danger">
                                                    {{ $emplois_du_temp->matiere_name }}
                                                </label>
                                            </td>
                                            <td>
                                                <img src="{{ Storage::url($emplois_du_temp->avatar) }} " class="mr-2"
                                                    alt="image" />
                                                <label class="ml-1">{{ $emplois_du_temp->enseignant_name }}</label>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.emplois_du_temps.destroy', $emplois_du_temp->emplois_du_temps_id) }} "
                                                    method="post" class="offset-3">
                                                    @method('delete')
                                                    @csrf
                                                    <button title="Supprimer" type="submit"
                                                        style="color: red; border: none">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </form>
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
