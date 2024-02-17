@extends('layout.theme')
@section('title', 'Matière | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-auto-fix"></i>
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
                        <h4 class="card-title">Formulairre</h4>
                        <p class="card-description">
                            Quelques <code>.détails</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.matieres.index') }}">
                            <div class="form-group">
                                <label for="groupe">Groupe</label>
                                <input id="groupe" disabled value="{{ $matiere->name }}" type="text"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Date de Création</label>
                                <input disabled type="text" class="form-control"
                                    value="{{ DATE_FORMAT($matiere->created_at, 'd M Y à H : i') }}">
                            </div>
                            <div class="form-group">
                                <label>Dernières Modifications</label>
                                <input disabled type="text" class="form-control"
                                    value="{{ DATE_FORMAT($matiere->updated_at, 'd M Y à H : i') }}">
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
