@extends('layout.theme')
@section('title', 'Users | All')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-android-debug-bridge"></i>
                </span>
                Utilisateurs Enregistrés
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.create') }}">Ajouter Utilisateur</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Utilisateurs</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Profile
                                        </th>
                                        <th>
                                            Nom Prénoms
                                        </th>
                                        <th>
                                            Adresse Email
                                        </th>
                                        <th>
                                            Rôle
                                        </th>
                                        <th>
                                            Outils
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $unknown_user)
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($unknown_user->avatar) }}" class="mr-2"
                                                    alt="image" />
                                            </td>
                                            <td>
                                                <a title="Mettre à jour"
                                                    href="{{ route('admin.users.edit', $unknown_user->id) }}">
                                                    {{ $unknown_user->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <label class="badge badge-gradient-success">
                                                    {{ $unknown_user->email }}
                                                </label>
                                            </td>
                                            <td>

                                                {{ Str::ucfirst($unknown_user->role) }}
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <a title="Mettre à jour"
                                                        href="{{ route('admin.users.edit', $unknown_user->id) }}"
                                                        class="mdi mdi-grease-pencil" style="color: blue">
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $unknown_user->id) }} "
                                                        method="post" class="offset-4">
                                                        @method('delete')
                                                        @csrf
                                                        <button title="Supprimer" type="submit"
                                                            style="color: red; border: none">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
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
