@extends('layout.theme')
@section('title', 'Emplois du Temps | Début')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-duck"></i>
                </span>
                Emplois du temps
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
                        <h4 class="card-title">Classes</h4>
                        <p class="card-description">
                            Ciquez sur une <code>classe</code> pour voir son <code>emplois du temps.</code>
                        </p>
                        @foreach ($classes as $classe)
                            <a title="Plus de détails" class="btn btn-gradient-dark"
                                href="{{ route('visiteur.emplois_du_temps.show', [$classe->classe_id, $classe->serie_id, $classe->groupe_id]) }}">
                                {{ $classe->classe . ' ' . $classe->serie . ' ' . $classe->groupe }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
