@extends('layout.theme')
@section('title', 'Note | Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-dice-d20"></i>
                </span>
                Ajouter une Note
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
                        <h4 class="card-title">Formulaire</h4>
                        <p class="card-description">
                            Ici le formulaire pour ajouter <code>une Note</code> aux élèves de la
                            <code> {{ $classe->classe . ' ' . $serie->serie . ' ' . $groupe->groupe }}</code> en <code>
                                {{ $matiere->name }}
                            </code>
                        </p>
                        @include('layout.partials.messages')
                        <form class="forms-sample" action="{{ route('enseignant.notes.store') }}" method="POST">
                            @csrf @method('post')
                            <div class="form-group">
                                <input hidden name="matiere_id" type="text" class="form-control"
                                    value="{{ $matiere->id }}">
                            </div>
                            <div class="form-group">
                                <label>{{ Str::ucfirst($periodicite[0]->periodicite_devoirs) }}</label>
                                <select name="periodicite_devoir_id" class="form-control">
                                    @foreach ($periodes as $periode)
                                        <option value="{{ $periode->id }}">{{ $periode->numero }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('composition_id'))
                                    <span class="text-danger text-left">{{ $errors->first('composition_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Type d'évaluation</label>
                                <select name="composition_id" class="form-control">
                                    @foreach ($compositions as $composition)
                                        <option value="{{ $composition->id }}">{{ $composition->type }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('composition_id'))
                                    <span class="text-danger text-left">{{ $errors->first('composition_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Numéro de l'évaluation</label>
                                <select name="numero_id" class="form-control">
                                    @foreach ($numeros as $numero)
                                        <option value="{{ $numero->id }}">{{ $numero->numero }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('matiere_id'))
                                    <span class="text-danger text-left">{{ $errors->first('matiere_id') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>Matricule</th>
                                            <th>Nom Prénoms</th>
                                            <th>Téléphone</th>
                                            <th>Genre</th>
                                            <th>Note / 20 </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eleves as $eleve)
                                            <tr>
                                                <td>
                                                    <img src="{{ Storage::url($eleve->avatar) }}" alt="profile">
                                                </td>
                                                <td>
                                                    {{ $eleve->matricule }}
                                                </td>
                                                <td>
                                                    {{ $eleve->name }}
                                                </td>
                                                <td>
                                                    {{ $eleve->telephone }}
                                                </td>
                                                <td>
                                                    @if ($eleve->genre == 'F')
                                                        <label class="badge badge-gradient-danger">
                                                            Féminin
                                                        </label>
                                                    @else
                                                        <label class="badge badge-gradient-info">
                                                            Masculin
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input hidden type="text" name="eleve_id[]"
                                                        value="{{ $eleve->id }}">
                                                    <input autofocus class="form-control col-5" name="note[]">
                                                </td>
                                            </tr>
                                        @endforeach
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
            $('input[name="note[]"]').on('input', function() {
                let value = $(this).val().trim();
                if (value > 20) {
                    value = value.substr(0, value.length - 1);
                }
                $(this).val(value);
            });
        });
    </script>
@endsection
