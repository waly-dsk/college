@extends('layout.theme')
@section('title', 'Emplois du Temps | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-blur-radial"></i>
                </span>
                Nouvel Emplois du Temps
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.emplois_du_temps.index') }}">Tous les
                            Programmes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulaire</h4>
                        <p class="card-description">
                            Sélectionnez chaque item pour ajouter un nouvel <code>emplois du temps.</code>
                        </p>
                        @include('layout.partials.messages')
                        <form class="forms-sample" action="{{ route('admin.emplois_du_temps.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="classe">Classe</label>
                                <select name="classe" class="form-control">
                                    @foreach ($classes as $classe)
                                        <option
                                            value="{{ $classe->classe_id . '/' . $classe->serie_id . '/' . $classe->groupe_id }}">
                                            {{ $classe->classe . ' ' . $classe->serie . ' ' . $classe->groupe }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('classe'))
                                    <span class="text-danger text-left">{{ $errors->first('classe') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jour">Jours</label>
                                <select name="jour_id" id="jour" class="form-control">
                                    @foreach ($jours as $jour)
                                        <option value="{{ $jour->id }}">{{ $jour->jour }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('jour_id'))
                                    <span class="text-danger text-left">{{ $errors->first('jour_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="horaires">Horaires</label>
                                <select name="horaires[]" id="horaires" class="form-control" multiple>
                                    @foreach ($horaires as $horaire)
                                        <option value="{{ $horaire->id }}">{{ $horaire->horaire }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('horaires'))
                                    <span class="text-danger text-left">{{ $errors->first('horaires') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="matiere">Matière</label>
                                <select name="matiere_id" id="matiere" class="form-control">
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">
                                            {{ $matiere->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('matiere_id'))
                                    <span class="text-danger text-left">{{ $errors->first('matiere_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="enseignant">Enseignant</label>
                                <select autofocus name="enseignant_id" id="enseignant" class="form-control">
                                    @foreach ($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}">
                                            {{ $enseignant->name }}
                                            ({{ $enseignant->matiere_name }})
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('enseignant_id'))
                                    <span class="text-danger text-left">{{ $errors->first('enseignant_id') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
