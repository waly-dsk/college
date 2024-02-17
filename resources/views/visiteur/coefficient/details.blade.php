@extends('layout.theme')
@section('title', 'Coefficient | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-beach"></i>
                </span>
                Liste des Coefficients
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.coefficients.create') }}">Ajouter un
                            Coefficient
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Par classes et matières</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Classe
                                        </th>
                                        <th>
                                            Matière
                                        </th>
                                        <th>
                                            Coefficient
                                        </th>
                                        <th>
                                            Outils
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coefficients as $coefficient)
                                        <tr>
                                            <td>
                                                <label class="badge badge-gradient-info">
                                                    {{ $coefficient->classe . ' ' . $coefficient->serie }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-primary">
                                                    {{ $coefficient->matiere }}
                                                </label>

                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-danger ml-4">
                                                    {{ $coefficient->coefficient }}
                                                </label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <a title="Mettre à jour"
                                                        href="{{ route('admin.coefficients.edit', $coefficient->id) }}"
                                                        class="mdi mdi-grease-pencil" style="color: blue">
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.coefficients.destroy', $coefficient->id) }} "
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
    </div>
@endsection
