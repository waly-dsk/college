@extends('layout.theme')
@section('title', 'Visiteur | Résultats')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-brush"></i>
                </span>
                Résultats de la {{ $niveau }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Résultats du
                            {{ Str::ucfirst($periodicite[0]->periodicite_devoirs) . ' ' . $periode[0]->numero }}</h4>
                        <p class="card-description">
                            Tous les <code>.Elèves</code> de la <code>{{ $niveau }} </code>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eleves as $eleve)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ Storage::url($eleve->avatar) }}" alt="profile">
                                        </td>
                                        <td>
                                            <a title="Voir les Notes"
                                                href="{{ route('visiteur.resultats.show', [$periode[0]->id, $eleve->id]) }}">
                                                {{ $eleve->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $niveau }}
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
