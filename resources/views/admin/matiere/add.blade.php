@extends('layout.theme')
@section('title', 'Matière| Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-archive"></i>
                </span>
                Ajouter une Matière
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.matieres.index') }}">Toutes les Matières</a></li>
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
                            Ici le formulaire pour ajouter une <code>.Matière</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.matieres.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom matière</label>
                                <input autofocus type="text" class="form-control" name="name"
                                    placeholder="Nom matière" id="name">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
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
