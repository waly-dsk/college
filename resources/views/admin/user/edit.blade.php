@extends('layout.theme')
@section('title', 'User | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-android-studio"></i>
                </span>
                Appottez des modifications
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
                        <h4 class="card-title">Formulaire</h4>
                        <p class="card-description">
                            Apportez des modifications à un Utilisateur. Remplissez les <code>champs</code> suivants.
                        </p>
                        @include('layout.partials.messages')
                        <form class="pt-3" action="{{ route('admin.users.update', $unknown_user->id) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input autofocus id="name" type="text" name="name"
                                    class="form-control form-control-lg" value="{{ $unknown_user->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="form-control form-control-lg"
                                    value="{{ $unknown_user->email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" name="role" class="form-control form-control-lg">
                                    <option value="visiteur">Visiteur</option>
                                    <option value="eleve">Elève</option>
                                    <option value="enseignant">Enseignant</option>
                                    <option value="admin">Administratif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password" class="form-control form-control-lg"
                                    placeholder="Password">
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control form-control-lg" placeholder="Password Confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span
                                        class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
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
