@extends('layout.theme')
@section('title', 'Visiteur | Elèves | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-checkbox-multiple-marked"></i>
                </span>
                Elèves Enregistrés

            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">(Effectif : {{ sizeof($eleves) }})</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ $classe[0]->classe . ' ' . $serie[0]->serie . ' ' . $groupe[0]->groupe }}
                        </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Profile
                                        </th>
                                        <th>
                                            Nom Prénoms
                                        </th>
                                        <th>
                                            Genre
                                        </th>
                                        <th>
                                            Date d'inscription
                                        </th>
                                        <th>
                                            Lieu de Naissance
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eleves as $eleve)
                                        <tr class=" ">
                                            <td class="py-1">
                                                <img src="{{ asset('assets/images/faces-clipart/pic-1.png') }}"
                                                    alt="logo">
                                                {{-- <img src="{{ Storage::url($eleve->avatar) }}" alt="profile"> --}}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.eleves.show', $eleve->id) }}"
                                                    title="Voir plus de Détails">

                                                    {{ $eleve->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if ($eleve->genre == 'F')
                                                    <label class="badge badge-gradient-danger">
                                                        Féminin
                                                    </label>
                                                @else
                                                    <label class="badge badge-gradient-info">
                                                        Masculin
                                                    </label>
                                                @endif
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-success">
                                                    {{ $eleve->created_at }}
                                                </label>
                                            </td>
                                            <td>
                                                {{ $eleve->lieu_naissance }}
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
