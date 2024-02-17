@extends('layout.theme')
@section('title', 'Elève | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-bullseye"></i>
                </span>
                Voir un Elève
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.eleves.index') }}">Tous les élèves</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h4 class="card-title">Profile</h4>
                        <p class="card-description">
                            Voyez ici <code>.profile et .classe</code>
                        </p>
                        <hr>
                        <img src="{{ asset('assets/images/faces-clipart/pic-2.png') }}" alt="">
                        {{-- <img src="{{ Storage::url($eleve->avatar) }}" alt="profile" class="img-fluid rounded-circle mb-2"> --}}
                        <br>
                        <br>
                        <h4 class="card-title text-center text-muted">
                            @if ($eleve->genre == 'F')
                                Mlle. {{ $eleve->name }}
                            @else
                                M. {{ $eleve->name }}
                            @endif
                        </h4>
                        <div class="text-center text-muted">
                            {{ $eleve->classe->classe . '  ' . $eleve->serie->serie . ' ' . $eleve->groupe->groupe }}
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title text-center">Contacts</h4>
                        <p class="card-description">
                            Voyez ici <code>.email et .téléphone</code>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address class="text-primary">
                                    <p class="font-weight-bold">
                                        E-mail
                                    </p>
                                    <p class="mb-2">
                                        {{ $eleve->email }}
                                    </p>
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address class="text-info">
                                    <p class="font-weight-bold">
                                        Téléphone
                                    </p>
                                    <p>
                                        {{ $eleve->telephone }}
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body h-100">
                        <h4 class="card-title">Informations</h4>
                        <p class="card-description">
                            Informations relatives à <code>.inscrpition</code> et <code>.état civil</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.eleves.index') }}" method="get">
                            <div class="template-demo">
                                <h6 class="display-4">Inscription</h6>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="date_inscription">Date d'inscription</label>
                                <input disabled type="text" class="form-control"
                                    value="{{ DATE_FORMAT($eleve->created_at, 'd M Y à H:i') }}">
                            </div>

                            <div class="form-group">
                                <label for="matricule">Matricule</label>
                                <input disabled type="text" class="form-control" value="{{ $eleve->matricule }}">
                            </div>


                            <div class="template-demo">
                                <h6 class="display-4">Etat Civil</h6>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="name">Nom Prénoms</label>
                                <input disabled type="text" class="form-control" value="{{ $eleve->name }}">
                            </div>

                            <div class="form-group">
                                <label for="genre">Genre</label>
                                @if ($eleve->genre == 'F')
                                    <input disabled type="text" class="form-control" id="genre" value="Féminin">
                                @elseif ($eleve->genre == 'M')
                                    <input disabled type="text" class="form-control" id="genre" value="Masculin">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Date de Naissance</label>
                                <input disabled type="text" class="form-control" value="{{ $eleve->date_naissance }}">
                            </div>

                            <div class="form-group">
                                <label>Lieu de Naissance</label>
                                <input disabled type="text" class="form-control" value="{{ $eleve->lieu_naissance }}">
                            </div>
                            <hr>

                            <button type="button" title="Aucune action" class="btn btn-gradient-primary mr-2">
                                <i class="mdi mdi-jira "></i>
                            </button>
                            <button type="submit" title="Retour en arrière" class="btn btn-gradient-danger offset-7">
                                <i class="mdi mdi-keyboard-backspace"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
