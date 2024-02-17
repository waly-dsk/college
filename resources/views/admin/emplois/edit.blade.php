@extends('layout.theme')
@section('title', 'Emplois du temps | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-bowling"></i>
                </span>
                Apportez des Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Editez un Programme</a></li>
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
                            La
                            <code>
                                {{ $line[0]->classe . ' ' . $line[0]->serie . ' ' . $line[0]->groupe . ', ' }}
                            </code>
                            le
                            <code>
                                {{ $line[0]->jour . ' : ' . $line[0]->horaire . '' . ' (' . $line[0]->matiere_name . ') ' }}
                            </code>
                            avec
                            <a class="mr-2" title="Plus de détails"
                                href="{{ route('admin.enseignants.show', $line[0]->enseignant_id) }}">{{ $line[0]->enseignant_name . '.' }}
                            </a>
                            Modifier l'emplois du temps.
                        </p>
                        <form class="forms-sample"
                            action="{{ route('admin.emplois_du_temps.update', $line[0]->emplois_du_temps_id) }}"
                            method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="matiere">Nouvelle Matière</label>
                                <select name="matiere_id" id="matiere" class="form-control">
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">
                                            {{ $matiere->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="enseignant">Nom Enseignant</label>
                                <select autofocus name="enseignant_id" id="enseignant" class="form-control">
                                    @foreach ($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}">
                                            {{ $enseignant->name }}
                                            ({{ $enseignant->matiere_name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
