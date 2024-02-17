<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }} ">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }} ">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }} " />
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">

    <title>My College | @yield('title')</title>
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="#"><img src="{{ asset('assets/images/logo.svg') }} "
                        alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="#"><img
                        src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{ Storage::url($user->avatar) }}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black">{{ $user->name }}</p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="mdi mdi-cached mr-2 text-success"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i>
                                    Déconnecter
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{ Storage::url($user->avatar) }}" alt="profile">
                                <span class="login-status online"></span>
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2">{{ $user->name }}</span>
                                <span class="text-secondary text-small">{{ Str::ucfirst($user->role) }} </span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <span class="menu-title">Menu Principal</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    @if ($user->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <span class="menu-title">Utilisateurs</span>
                                <i class="mdi mdi-account-multiple-plus menu-icon"></i>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.classes.index') }}">
                                <span class="menu-title">Classes</span>
                                <i class="mdi mdi-anchor  menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.series.index') }}">
                                <span class="menu-title">Séries</span>
                                <i class="mdi mdi-arrange-bring-forward  menu-icon"></i>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.groupes.index') }}">
                                <span class="menu-title">Groupes</span>
                                <i class="mdi mdi-auto-fix   menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.eleves.index') }}">
                                <span class="menu-title">Élèves</span>
                                <i class="mdi mdi-account-plus  menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.eleves.index') }}">
                                <span class="menu-title">Elèves Par Classes</span>
                                <i class="mdi mdi-apple-keyboard-command menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.matieres.index') }}">
                                <span class="menu-title">Matières</span>
                                <i class="mdi mdi-airballoon  menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.coefficients.index') }}">
                                <span class="menu-title">Coefficients</span>
                                <i class="mdi mdi-android-studio   menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    @if ($user->role == 'enseignant')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.coefficients.index') }}">
                                <span class="menu-title">Coefficients</span>
                                <i class="mdi mdi-android-studio   menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    @if ($user->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.enseignants.index') }}">
                                <span class="menu-title">Enseignants</span>
                                <i class="mdi mdi-arrange-send-to-back  menu-icon"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.emplois_du_temps.index') }}">
                                <span class="menu-title">Emplois du Temps</span>
                                <i class="mdi mdi-biohazard   menu-icon"></i>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.notes.show_note_start') }}">
                                <span class="menu-title">Voir les Notes</span>
                                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    @if ($user->role == 'enseignant')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('enseignant.mon_emplois_du_temps', $user->name) }}">
                                <span class="menu-title">Mon emplois du temps</span>
                                <i class="mdi mdi-calendar-clock  menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.eleves.index') }}">
                                <span class="menu-title">Elèves par classes</span>
                                <i class="mdi mdi-apple-keyboard-command menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.coefficients.index') }}">
                                <span class="menu-title">Voir les Coefficients</span>
                                <i class="mdi mdi-beats menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('enseignant.notes.index') }}">
                                <span class="menu-title">Ajouter une Note</span>
                                <i class="mdi mdi-air-conditioner menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.notes.show_note_start') }}">
                                <span class="menu-title">Voir les Notes</span>
                                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    @if ($user->role != 'admin' && $user->role != 'enseignant')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.eleves.index') }}">
                                <span class="menu-title">Elèves par classes</span>
                                <i class="mdi mdi-apple-keyboard-command menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.emplois_du_temps.index') }}">
                                <span class="menu-title">Emplois du Temps</span>
                                <i class="mdi mdi-arrow-right-bold-circle-outline menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.coefficients.index') }}">
                                <span class="menu-title">Voir les Coefficients</span>
                                <i class="mdi mdi-beats menu-icon"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('visiteur.notes.show_note_start') }}">
                                <span class="menu-title">Voir les Notes</span>
                                <i class="mdi mdi-chart-areaspline menu-icon"></i>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('visiteur.resultats.index') }}">
                            <span class="menu-title">Voir les Résultats</span>
                            <i class="mdi mdi-airballoon menu-icon"></i>
                        </a>
                    </li>

                </ul>
            </nav>
            <div class="main-panel">

                @yield('content')

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a
                                href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights
                            reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }} "></script>
    <script src="{{ asset('assets/js/misc.js') }} "></script>
    <script src="{{ asset('assets/js/dashboard.js') }} "></script>
    <script src="{{ asset('assets/js/file-upload.js') }} "></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.full.min.js') }}"></script>

    @yield('script')

</body>

</html>
