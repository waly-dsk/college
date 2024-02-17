@extends('layout.theme')
@section('title', 'Classe | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-checkbox-multiple-marked-circle"></i>
                </span>
                Voir une Classe
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Formlaire</a></li>
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
                            Quelques <code>détails.</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.classes.index') }} ">
                            <div class="form-group">
                                <label>Classe</label>
                                <input disabled type="text" class="form-control" value="{{ $classe->classe }}">
                            </div>
                            <div class="form-group">
                                <label>Date de création</label>
                                <input disabled type="text" class="form-control"
                                    value="{{ DATE_FORMAT($classe->created_at, 'd M Y à H : i') }}" id="created_at">
                            </div>
                            <div class="form-group">
                                <label>Dernières Modifications</label>
                                <input disabled type="text" class="form-control"
                                    value="{{ DATE_FORMAT($classe->updated_at, 'd M Y à H : i') }}" id="created_at">
                            </div>
                            <button type="button" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="submit" class="btn btn-gradient-danger offset-8">Come Back</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
