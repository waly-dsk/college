@extends('layout.theme')
@section('title', 'Enseignant | Notes | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-dice-3"></i>
                </span>
                Vos Classes
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('visiteur.notes.show_note_start') }}">Voir les Notes</a>
                    </li>
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
                            Cliquez sur une classe pour remplir <code>le cahier de Notes</code> en
                            <code> {{ $enseignant[0]->matiere_name }} </code>
                        </p>
                        @foreach ($classe_tenues as $classe_tenue)
                            <a title="Ajouter une note" class="btn btn-gradient-dark mr-2" href="#"
                                onclick="event.preventDefault(); document.getElementById('detail-forms').submit();">
                                {{ $classe_tenue->classe . ' ' . $classe_tenue->serie . ' ' . $classe_tenue->groupe }}
                            </a>
                            <form id="detail-forms" action="{{ route('enseignant.notes.add') }}" method="post"
                                style="display:none">
                                @csrf
                                <input type="text" value="{{ $classe_tenue->classe_id }}" name="classe_id">
                                <input type="text" value="{{ $classe_tenue->serie_id }}" name="serie_id">
                                <input type="text" value="{{ $classe_tenue->groupe_id }}" name="groupe_id">
                                <input type="text" value="{{ $enseignant[0]->matiere_id }}" name="matiere_id">
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
