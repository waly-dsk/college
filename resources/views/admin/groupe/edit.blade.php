@extends('layout.theme')
@section('title', 'Groupe | Edit')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-basket-fill"></i>
                </span>
                Apportez des Modifications
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Editez un Groupe</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic informations</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Default form </h4>
                        <p class="card-description">
                            Basic form
                        </p>
                        <form class="forms-sample" action="{{ route('admin.groupes.update', $groupe) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="groupe">Groupe</label>
                                <input type="text" class="form-control" name="groupe" value="{{ $groupe->groupe }}"
                                    id="groupe">
                                @if ($errors->has('groupe'))
                                    <span class="text-danger text-left">{{ $errors->first('groupe') }}</span>
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
