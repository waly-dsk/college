@extends('layout.theme')
@section('title', 'Enseignant | Note')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-codepen"></i>
                </span>
                Voir Notes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('enseignant.notes.index') }}">Ajouter une Note</a>
                    </li>
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
                            Choisissez le <code>{{ Str::ucfirst($periodicite[0]->periodicite_devoirs) }}</code>la
                            <code>Classe</code> et la <code>Matière</code> pour voir les <code>Notes</code>
                            des élèves.
                        </p>
                        <form class="forms-sample" action="{{ route('visiteur.notes.show_note_post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>{{ Str::ucfirst($periodicite[0]->periodicite_devoirs) }}</label>
                                <select name="periodicite_devoir_id" class="form-control">
                                    @foreach ($periodes as $periode)
                                        <option value="{{ $periode->id }}">{{ $periode->numero }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('composition_id'))
                                    <span class="text-danger text-left">{{ $errors->first('composition_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Classes</label>
                                <select name="niveau" class="form-control">
                                    @foreach ($niveaux as $niveau)
                                        <option
                                            value="{{ $niveau->classe_id . ' ' . $niveau->serie_id . ' ' . $niveau->groupe_id }}">
                                            {{ $niveau->classe . ' ' . $niveau->serie . ' ' . $niveau->groupe }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('niveau'))
                                    <span class="text-danger text-left">{{ $errors->first('niveau') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Matières</label>
                                <select name="matiere_id" class="form-control">
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
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
