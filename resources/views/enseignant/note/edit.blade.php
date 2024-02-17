@extends('layout.theme')
@section('title', 'Enseignant | Note | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-basket-fill"></i>
                </span>
                Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Modofiez des Notes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            {{ Str::ucfirst($periodicite[0]->periodicite_devoirs) . ' ' . $periodicite_numero[0]->numero }}
                        </h4>
                        <p class="card-description">
                            Notes de <code> {{ $eleve->name }} </code>
                            en <code> {{ $matiere->name }} </code>
                            ( <code> {{ $classe }} </code> )
                        </p>
                        <form
                            action="{{ route('enseignant.notes.update', [$periodicite_numero[0]->id, $eleve->id, $matiere->id]) }}"
                            method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Interrogations</th>
                                            <th>Devoirs</th>
                                            @if (Str::before($classe, ' ') == '3ème' || Str::before($classe, ' ') == 'Tle')
                                                <th>Examen-Blanc</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                @foreach ($interros as $interro)
                                                    <input class="form-control" type="text" name="interros[]"
                                                        value="{{ $interro->note }}">
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($devoirs as $devoir)
                                                    <input type="text" class="form-control" name="devoirs[]"
                                                        value="{{ $devoir->note }}">
                                                @endforeach
                                            </td>
                                            @if (Str::before($classe, ' ') == '3ème' || Str::before($classe, ' ') == 'Tle')
                                                <td>
                                                    @foreach ($examen_blancs as $examen_blanc)
                                                        <input type="text" class="form-control" name="examen_blancs[]"
                                                            value="{{ $examen_blanc->note }}">
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
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
            $('input').on('input', function() {
                let value = $(this).val().trim();
                if (value > 20) {
                    value = value.substr(0, value.length - 1);
                }
                $(this).val(value);
            });
        });
    </script>
@endsection
