@extends('layout.theme')
@section('title', 'Série | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-animation"></i>
                </span>
                Ajouter une Série
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.series.index') }}">Toutes les Séries</a></li>
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
                            Ici le formulaire pour ajouter une <code>Série.</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.series.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="serie">Série</label>
                                <input autofocus type="text" class="form-control" name="serie" placeholder="Série"
                                    id="serie">
                                @if ($errors->has('serie'))
                                    <span class="text-danger text-left">{{ $errors->first('serie') }}</span>
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
