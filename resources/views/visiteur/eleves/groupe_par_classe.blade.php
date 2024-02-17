@extends('layout.theme')
@section('title', 'Visiteur | Elèves | Détails')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-checkbox-multiple-marked-circle-outline"></i>
                </span>
                Détails sur la {{ $classe->classe }}
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
                            <span class="ml-4">Nous</span> vous indiquons ici le nombre de
                            <span class="font-weight-bold">groupes pédagogiques</span>
                            que possède la <span class="font-weight-bold">{{ $classe->classe }}</span>. La <span
                                class="font-weight-bold">{{ $classe->classe }}</span>
                            possède
                            <span class="font-weight-bold">{{ sizeof($data) }} </span> groupe(s)
                            pédagogique(s)
                        </p>
                        @foreach ($data as $datum)
                            <a title="Plus de détails" class="btn btn-gradient-dark"
                                href="{{ route('visiteur.eleves.all', [$datum->classe_id, $datum->serie_id, $datum->groupe_id]) }}">
                                {{ $datum->classe . ' ' . $datum->serie . ' ' . $datum->groupe }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
