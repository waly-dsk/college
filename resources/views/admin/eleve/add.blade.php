@extends('layout.theme')
@section('title', 'Elève | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-brightness-4"></i>
                </span>
                Ajouter un Elève
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.eleves.index') }}">Tous les Elèves</a></li>
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
                            Remplissez le formulaire pour ajouter un(e) <code>.Elève</code>
                        </p>
                        @include('layout.partials.messages')
                        <form class="forms-sample" action="{{ route('admin.eleves.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Matricule</label>
                                <input autofocus type="text" class="form-control" name="matricule"
                                    placeholder="Matricule">
                                @if ($errors->has('matricule'))
                                    <span class="text-danger text-left">{{ $errors->first('matricule') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Firstname  Lastname">
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
                                    placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" name="telephone" class="form-control form-control-lg"
                                    placeholder="Téléphone">
                                @if ($errors->has('telephone'))
                                    <span class="text-danger text-left">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Classe</label>
                                <select name="classe_id" class="form-control">
                                    @foreach ($classes as $classe)
                                        <option value="{{ $classe->id }}">{{ $classe->classe }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('classe_id'))
                                    <span class="text-danger text-left">{{ $errors->first('classe_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Série</label>
                                <select name="serie_id" class="form-control">
                                    @foreach ($series as $serie)
                                        <option value="{{ $serie->id }}">{{ $serie->serie }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('serie_id'))
                                    <span class="text-danger text-left">{{ $errors->first('serie_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Groupe </label>
                                <select name="groupe_id" class="form-control">
                                    @foreach ($groupes as $groupe)
                                        <option value="{{ $groupe->id }}">
                                            {{ $groupe->groupe }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('groupe_id'))
                                    <span class="text-danger text-left">{{ $errors->first('groupe_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Date de Naissance</label>
                                <input type="date" class="form-control" name="date_naissance"
                                    placeholder="Date de Naissance">
                                @if ($errors->has('date_naissance'))
                                    <span class="text-danger text-left">{{ $errors->first('date_naissance') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Lieu de Naissance</label>
                                <input type="text" class="form-control" name="lieu_naissance"
                                    placeholder="Lieu de Naissance">
                                @if ($errors->has('lieu_naissance'))
                                    <span class="text-danger text-left">{{ $errors->first('lieu_naissance') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Paswword">
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="avatar" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger text-left">{{ $errors->first('avatar') }}</span>
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
