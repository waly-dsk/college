@extends('layout.theme')
@section('title', 'Enseignant | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-blackberry"></i>
                </span>
                Voir un Enseignant
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.enseignants.index') }}">Tous les Enseignants</a>
                    </li>
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
                        <img src="{{ Storage::url($enseignant->avatar) }}" alt="profile"
                            class="img-fluid rounded-circle mb-2">
                        <br>
                        <br>
                        <h4 class="card-title text-center text-muted">
                            @if ($enseignant->genre == 'F')
                                Mme / Mlle. {{ $enseignant->name }}
                            @else
                                M. {{ $enseignant->name }}
                            @endif
                        </h4>
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
                                        {{ $enseignant->email }}
                                    </p>
                                </address>
                            </div>
                            <div class="col-md-6">
                                <address class="text-info">
                                    <p class="font-weight-bold">
                                        Téléphone
                                    </p>
                                    <p>
                                        {{ $enseignant->telephone }}
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
                            Informations relatives à <code>.enregistrment</code> et <code>.état civil</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.enseignants.index') }}" method="get">
                            <div class="template-demo">
                                <h6 class="display-4">Enregistrment</h6>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="nom">Date d'Enregistrement</label>
                                <input id="nom" disabled
                                    value="{{ DATE_FORMAT($enseignant->created_at, 'd M Y à H:i') }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="matiere">Matière Enseignée</label>
                                <input id="matiere" disabled value="{{ $enseignant->matiere->name }}" type="text"
                                    class="form-control">
                            </div>


                            <div class="template-demo">
                                <h6 class="display-4">Etat Civil</h6>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="name">Nom Prénoms</label>
                                <input disabled type="text" class="form-control" value="{{ $enseignant->name }}">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input id="telephone" disabled value="{{ $enseignant->telephone }}" type="text"
                                    class="form-control">
                            </div>

                            <hr>
                            <button type="button" class="btn btn-gradient-primary mr-2" title="Aucune action">
                                <i class="mdi mdi-jira "></i>
                            </button>
                            <button type="submit" class="btn btn-gradient-danger offset-7" title="Retour en arrière">
                                <i class="mdi mdi-keyboard-backspace"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-muted">
                            Emplois du temps de
                            <code>
                                @if ($enseignant->genre == 'F')
                                    Mlle / Mme
                                @else
                                    M.
                                @endif
                                {{ $enseignant->name }}
                            </code>
                            ({{ $enseignant->matiere->name }})
                        </h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jour</th>
                                        <th>Horaire</th>
                                        <th>Classe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emplois_du_temps as $emplois_du_temp)
                                        <tr>
                                            <td>
                                                <label class="badge badge-gradient-danger">
                                                    {{ $emplois_du_temp->jour }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-success">
                                                    {{ $emplois_du_temp->horaire }}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="">
                                                    {{ $emplois_du_temp->classe . ' ' . $emplois_du_temp->serie . ' ' . $emplois_du_temp->groupe }}
                                                </label>
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
