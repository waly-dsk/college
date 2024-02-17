@extends('layout.theme')
@section('title', 'Mon Profile')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-account-circle"></i>
                </span>
                Mon Profile
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Soyez les Bienvenus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Détails</h4>
                        <div class="d-flex">
                            <div class="d-flex align-items-center mr-4 text-muted font-weight-light">
                                <i class="mdi mdi-account-outline icon-sm mr-2"></i>
                                <span>{{ Str::ucfirst($user->role) }}</span>
                            </div>
                            <div class="d-flex align-items-center text-muted font-weight-light">
                                <i class="mdi mdi-clock icon-sm mr-2"></i>
                                <span>{{ DATE_FORMAT($user->created_at, 'd M Y') }}</span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h4 class="card-title">Informations Générales</h4>
                                <p class="card-description">
                                    Enregistré le <code>{{ DATE_FORMAT($user->created_at, 'd M Y') }}</code>
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address class="text-primary">
                                            <p class="font-weight-bold">
                                                Nom
                                            </p>
                                            <p>
                                                {{ Str::ucfirst($user->name) }}
                                            </p>
                                            <br>
                                            <p class="font-weight-bold">
                                                E-mail
                                            </p>
                                            <p class="mb-2">
                                                {{ $user->email }}
                                            </p>
                                            <br>
                                            <p class="font-weight-bold">
                                                Rôle
                                            </p>
                                            <p class="mb-2">
                                                {{ Str::ucfirst($user->role) }}
                                            </p>
                                            <br>
                                            @if ($user->role == 'enseignant')
                                                <p class="font-weight-bold">
                                                    Matière
                                                </p>
                                                <p class="mb-2">
                                                    {{ Str::ucfirst($matiere[0]->matiere_name) }}
                                                </p>
                                                <br>
                                            @endif
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 pr-1">
                                <img src="{{ Storage::url($user->avatar) }}" class="mb-2 mw-100 w-100 rounded"
                                    alt="image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
