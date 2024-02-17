@extends('layout.theme')
@section('title', 'Série | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-apple-safari"></i>
                </span>
                Apportez des Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Editez une Série</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Formulaire </h4>
                        <p class="card-description">
                            Ici le formulaire pour modifier une <code>Série.</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.series.update', $serie->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="serie">Série</label>
                                <input type="text" class="form-control" name="serie"
                                    placeholder="{{ $serie->serie }}" id="serie">
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
