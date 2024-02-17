@extends('layout.theme')
@section('title', 'Enseignant| Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-beer"></i>
                </span>
                Ajouter un Enseignant
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.enseignants.index') }}">
                            Tous les Enseignants
                        </a>
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
                            Ajoutez un <code>.Enseignant</code>
                        </p>
                        @include('layout.partials.messages')
                        <form class="forms-sample" action="{{ route('admin.enseignants.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input autofocus type="text" class="form-control" name="name" placeholder="Name">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" class="form-control" name="telephone" placeholder="Téléphone">
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
                                <label>Matière</label>
                                <select name="matiere_id" class="form-control">
                                    @foreach ($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('matiere_id'))
                                    <span class="text-danger text-left">{{ $errors->first('matiere_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Paswword">
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="avatar" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled
                                        placeholder="Upload Image">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-gradient-primary"
                                            type="button">Upload</button>
                                    </span>
                                </div>
                                @if ($errors->has('avatar'))
                                    <span class="text-danger text-left">{{ $errors->first('avatar') }}</span>
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
