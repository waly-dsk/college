@extends('layout.theme')
@section('title', 'Infos')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-home"></i>
                </span>
                Renseignements
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if ($user->role == 'admin')
                        <li class="breadcrumb-item"><a href="{{ route('admin.infos_generales.index') }}">Information
                                générales</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="#">Soyez les Bienvenus</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            @if ($user->role == 'admin')
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Mise à jour </h4>
                            <p class="card-description">
                                Mise à jour <code> des Renseignements de votre école</code>
                            </p>
                            <form class="forms-sample"
                                action="{{ route('admin.infos_generales.update', $infoGenerales->id) }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label>Nom de l'école</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $infoGenerales->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Année de création</label>
                                    <input type="text" name="annee" class="form-control"
                                        value="{{ $infoGenerales->annee }}">
                                </div>
                                <div class="form-group">
                                    <label>Périodicité des devoirs</label>
                                    <select class="form-control" name="periodicite_devoirs">
                                        <option value="trimestre">Trimestre</option>
                                        <option value="semestre">Semestre</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
