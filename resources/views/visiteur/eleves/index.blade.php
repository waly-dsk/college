@extends('layout.theme')
@section('title', 'Visiteur | Elèves')
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
                            Une classe peut avoir plusieurs <code>groupes pédagogiques.</code>
                            Cliquez sur une classe pour plus d'informations.
                        </p>
                        <form class="forms-sample">
                            <div class="form-group" id="divcontent"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#divcontent').append($(`
                @foreach ($classes as $classe)
                    <a class="btn + ${btn_class()+ ' mr-2'}"
                        href=" {{ route('visiteur.eleves.show', $classe->id) }} " title="Plus de détails">
                        {{ $classe->classe }}
                    </a>
                @endforeach
            `));
            function btn_class() {
                let colors = ['btn-gradient-info', 'btn-gradient-warning', 'btn-gradient-danger',
                    'btn-gradient-success', 'btn-gradient-secondary', 'btn-gradient-primary',
                    'btn-gradient-dark', 'btn-gradient-light',
                ];
                let index = Math.floor(colors.length * Math.random());
                return colors[index];
            }
        });
    </script>
@endsection
