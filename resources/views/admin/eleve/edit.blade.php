@extends('layout.theme')
@section('title', 'Elève | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-brightness-5"></i>
                </span>
                Apportez des Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Editez un(e) Elève</a></li>
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
                            Remplissez <code>le formulaire</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.eleves.update', $eleve->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label>Matricule</label>
                                <input type="text" autofocus class="form-control" name="matricule"
                                    value="{{ $eleve->matricule }}">
                                @if ($errors->has('matricule'))
                                    <span class="text-danger text-left">{{ $errors->first('matricule') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nom Prénoms</label>
                                <input type="text" class="form-control" name="name" value="{{ $eleve->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Genre</label>
                                <select name="genre" class="form-control">
                                    <option value="F">Féminin</option>
                                    <option value="M">Masculin</option>
                                </select>
                                @if ($errors->has('genre'))
                                    <span class="text-danger text-left">{{ $errors->first('genre') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control form-control-lg"
                                    value="{{ $eleve->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" name="telephone" class="form-control form-control-lg"
                                    value="{{ $eleve->telephone }}">
                                @if ($errors->has('telephone'))
                                    <span class="text-danger text-left">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="date_naissance">Date de Naissance</label>
                                <input type="date" class="form-control" name="date_naissance"
                                    value="{{ $eleve->date_naissance }}" id="date_naissance">
                                @if ($errors->has('date_naissance'))
                                    <span class="text-danger text-left">{{ $errors->first('date_naissance') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="lieu_naissance">Lieu de Naissance</label>
                                <input type="text" class="form-control" name="lieu_naissance"
                                    value="{{ $eleve->lieu_naissance }}" id="lieu_naissance">
                                @if ($errors->has('lieu_naissance'))
                                    <span class="text-danger text-left">{{ $errors->first('lieu_naissance') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="classe">Classe</label>
                                <select name="classe_id" class="form-control" id="classe">
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->classe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="groupe">Groupe</label>
                                <select name="groupe_id" class="form-control" id="groupe">
                                    @foreach ($groupes as $groupe)
                                        <option value="{{ $groupe->id }}">
                                            {{ $groupe->groupe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="serie">Série</label>
                                <select name="serie_id" class="form-control" id="serie">
                                    @foreach ($series as $serie)
                                        <option value="{{ $serie->id }}">{{ $serie->serie }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
