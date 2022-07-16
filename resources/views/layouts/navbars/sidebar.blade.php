<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home', app()->getLocale())}}">
            <h2>The Future</h2>
            <h2>of</h2>
            <h2>Training</h2>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit', app()->getLocale()) }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout', app()->getLocale()) }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home', app()->getLocale()) }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home', app()->getLocale()) }}">
                        <i class="ni ni-tv-2 text-primary"></i>{{ __('messages.Dashboard') }}
                    </a>
                </li>
            </ul>

            <!-- Athletes --- Athletes --- Athletes-->
            <div>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">{{ __('messages.MyAthletes') }}</h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('athleteList', app()->getLocale())}}">
                            <i class="ni ni-bullet-list-67"></i>{{ __('messages.MyAthletesList') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('athleteAdd', app()->getLocale())}}">
                            <i class="ni ni-palette"></i>{{ __('messages.MyAthletesAdd') }}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ENDE Athletes --- ENDE Athletes --- ENDE Athletes-->

            <!-- ZUTATEN --- ZUTATEN --- ZUTATEN-->
            <div>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Meine Zutaten</h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ingredientList', app()->getLocale())}}">
                            <i class="ni ni-bullet-list-67"></i> Zutaten Liste
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ingredientAdd', app()->getLocale())}}">
                            <i class="ni ni-palette"></i> Zutaten hinzufügen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ingredientUpload', app()->getLocale())}}">
                            <i class="ni ni-cloud-upload-96"></i> Zutaten hochladen
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ENDE ZUTATEN --- ENDE ZUTATEN --- ENDE ZUTATEN-->

            <!-- GERICHTE --- GERICHTE --- GERICHTE-->
            <div>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Essen</h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mealList', app()->getLocale())}}">
                            <i class="ni ni-bullet-list-67"></i> Essen Liste
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mealAdd', app()->getLocale())}}">
                            <i class="ni ni-palette"></i> Essen hinzufügen
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">
                            <i class="ni ni-ui-04"></i> Essen upload
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ENDE GERICHTE --- ENDE GERICHTE --- ENDE GERICHTE-->

            <!-- ERNÄHRUNGSPLAN --- ERNÄHRUNGSPLAN --- ERNÄHRUNGSPLAN-->
            <div>
            <hr class="my-3">
            <h6 class="navbar-heading text-muted">Ernährungspläne</h6>
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('planList', app()->getLocale())}}">
                        <i class="ni ni-bullet-list-67"></i> Ernährungsplan Liste
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('planAdd', app()->getLocale())}}">
                        <i class="ni ni-palette"></i> Ernährungsplan erstellen
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="ni ni-ui-04"></i> Soon...
                    </a>
                </li>
            </ul>
            </div>
            <!-- ENDE ERNÄHRUNGSPLAN --- ENDE ERNÄHRUNGSPLAN --- ENDE ERNÄHRUNGSPLAN-->

            <!-- DOKU --- DOKU --- DOKU-->
            <div>
                <hr class="my-3">
                <h6 class="navbar-heading text-muted">Documentation</h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/getting-started/overview.html">
                            <i class="ni ni-spaceship"></i> Getting started
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/foundation/colors.html">
                            <i class="ni ni-palette"></i> Foundation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://argon-dashboard-laravel.creative-tim.com/docs/components/alerts.html">
                            <i class="ni ni-ui-04"></i> Components
                        </a>
                    </li>
                </ul>
            </div>
            <!-- ENDE DOKU --- ENDE DOKU --- ENDE DOKU-->
        </div>
    </div>
</nav>
