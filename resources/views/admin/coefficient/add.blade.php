@extends('layout.theme')
@section('title', 'Coefficient| Add')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-houzz"></i>
                </span>
                Ajouter un Coefficient
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.coefficients.index') }}">
                            Liste des Coefficients
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
                            Ici le formulaire pour ajouter un <code> Coefficient </code> à une <code>Matière</code> selon la
                            <code>Classe</code>
                        </p>
                        @include('layout.partials.messages')
                        <form class="forms-sample" action="{{ route('admin.coefficients.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Classe</label>
                                <select name="classe" class="form-control">
                                    @foreach ($niveaux as $niveau)
                                        <option value="{{ $niveau->classe_id . '/' . $niveau->serie_id }}">
                                            {{ $niveau->classe . ' ' . $niveau->serie }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('classe'))
                                    <span class="text-danger text-left">{{ $errors->first('classe') }}</span>
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
                                <label>Coefficient</label>
                                <input type="text" class="form-control" id="coefficient" name="coefficient"
                                    placeholder="Coefficient" value="{{ old('coefficient') }}">
                                @if ($errors->has('coefficient'))
                                    <span class="text-danger text-left">{{ $errors->first('coefficient') }}</span>
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
@section('script')
    <script>
        $(function() {
            $('#coefficient').on('input', function() {
                let value = $(this).val().trim();
                if (/\D/g.test(value) || value > 6) {
                    value = value.substr(0, value.length - 1);
                }
                $('#coefficient').val(value);
            });
        });
    </script>
@endsection
