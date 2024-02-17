@extends('layout.theme')
@section('title', 'Note | Show')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-dice-d20"></i>
                </span>
                Notes du {{ Str::ucfirst($periodicite[0]->periodicite_devoirs) . ' ' . $periodicite_numero[0]->numero }}
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Notes par Matière et Evaluations
                        </h4>
                        <p class="card-description">
                            <code>Notes</code> en <code>{{ $matiere->name }}</code> de la
                            <code>{{ $classe->classe . ' ' . $serie->serie . ' ' . $groupe->groupe }}</code>
                        </p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Nom Prénoms</th>
                                        <th>Interrogations</th>
                                        <th>Devoirs</th>
                                        @if ($classe->classe == '3ème' || $classe->classe == 'Tle')
                                            <th>Examen-Blanc</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eleves_notes as $eleve)
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($eleve['avatar']) }}" alt="profile">
                                            </td>
                                            <td>
                                                <form action="{{ route('enseignant.notes.edit') }}" style="display: none"
                                                    method="post" id="details-form-{{ $loop->index }}">
                                                    @csrf
                                                    <input type="text" hidden name="eleve_id"
                                                        value="{{ $eleve['identifiant'] }}">
                                                    <input type="text" hidden name="periode_id"
                                                        value="{{ $periodicite_numero[0]->id }}">
                                                    <input type="text" hidden name="matiere_id"
                                                        value="{{ $matiere->id }}">
                                                    <input type="text" hidden name="classe"
                                                        value="{{ $classe->classe . ' ' . $serie->serie . ' ' . $groupe->groupe }}">
                                                </form>
                                                <a title="Modifiez une note" href="#"
                                                    onclick="event.preventDefault(); document.getElementById('details-form-{{ $loop->index }}').submit();">
                                                    {{ $eleve['name'] }}
                                                </a>
                                            </td>
                                            <td>
                                                @foreach ($eleve['interrogations'] as $note_interro)
                                                    {{ $note_interro->note . ' ' }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($eleve['devoirs'] as $note_devoir)
                                                    {{ $note_devoir->note . ' ' }}
                                                @endforeach
                                            </td>
                                            @if ($classe->classe == '3ème' || $classe->classe == 'Tle')
                                                <td>
                                                    @foreach ($eleve['examen_blanc'] as $note_examen_blanc)
                                                        {{ $note_examen_blanc->note . ' ' }}
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
