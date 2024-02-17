@extends('layout.theme')
@section('title', 'Visiteur | Coefficients')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class=" mdi mdi-account-box-outline"></i>
                </span>
                Toutes les Classes Enregistrées
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Formulaire</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informations</h4>
                        <p class="card-description">
                            Cliquez sur une classe pour voir les <code>Coefficients</code> par <code>Matières</code>.
                        </p>
                        <form class="forms-sample">
                            @foreach ($niveaux as $classe)
                                <a class="btn + btn-gradient-primary mr-4 mb-4"
                                    href=" {{ route('visiteur.coefficients.show', $classe->classe_id . ' ' . $classe->serie_id) }} "
                                    title="Voir les coefficients par Matières">
                                    {{ $classe->classe . $classe->serie }}
                                </a>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
