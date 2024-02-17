@extends('layout.theme')
@section('title', 'Classe | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-arrange-send-backward"></i>
                </span>
                Ajouter une Classe
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.classes.index') }}">Toutes les Classes</a></li>
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
                            Remplissez le <code>formulaire</code> pour enregistrer une classe.
                        </p>
                        <form class="forms-sample" action="{{ route('admin.classes.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="classe">Classe</label>
                                <input autofocus type="text" class="form-control" name="classe"
                                    placeholder="Nom de Classe" id="classe">
                                @if ($errors->has('classe'))
                                    <span class="text-danger text-left">{{ $errors->first('classe') }}</span>
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
