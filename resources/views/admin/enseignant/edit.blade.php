@extends('layout.theme')
@section('title', 'Enseignant | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-biohazard"></i>
                </span>
                Apportez des Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Editez un Enseignant</a></li>
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
                            Apportez des modifications. <code>(Remplissez le formulaire)</code>
                        </p>
                        <form class="forms-sample" action="{{ route('admin.enseignants.update', $enseignant) }}"
                            method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input autofocus type="text" class="form-control" name="name"
                                    value="{{ $enseignant->name }}" id="name">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $enseignant->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" class="form-control" name="telephone"
                                    value="{{ $enseignant->telephone }}">
                                @if ($errors->has('telephone'))
                                    <span class="text-danger text-left">{{ $errors->first('telephone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Genre</label>
                                <select name="genre" class="form-control">
                                    <option value="F">Féminin</option>
                                    <option value="M">Masculin</option>
                                </select>
                                @if ($errors->has('genre'))
                                    <span class="text-danger text-left">{{ $errors->first('genre') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="matiere">Matière</label>
                                <select name="matiere_id" id="" class="form-control">
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('matiere'))
                                    <span class="text-danger text-left">{{ $errors->first('matiere') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
