@extends('layout.theme')
@section('title', 'Groupe | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-beats"></i>
                </span>
                Voir un Groupe
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
                        <form class="forms-sample" action="{{ route('admin.groupes.index') }}">
                            <div class="form-group">
                                <label>Groupe</label>
                                <input disabled value="{{ $groupe->groupe }}" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date de Création</label>
                                <input disabled value="{{ DATE_FORMAT($groupe->created_at, 'd M Y à H : i') }}"
                                    type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Dernières Modifications</label>
                                <input disabled value="{{ DATE_FORMAT($groupe->updated_at, 'd M Y à H : i') }}"
                                    type="text" class="form-control">
                            </div>
                            <button type="button" class="btn btn-gradient-primary mr-2">Submit</button>
                            <button type="submit" class="offset-8  btn btn-gradient-danger">Come Back</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
