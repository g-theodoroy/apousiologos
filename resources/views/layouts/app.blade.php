<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
    </head>
    <body>
        <div id="app">
            <nav class="navbar has-shadow">
                <div class="container">
                    <div class="navbar-brand">
                        <a href="{{ url('/') }}" class="navbar-item">{{ config('app.name', 'Laravel') }}</a>

                        <div class="navbar-burger burger" data-target="navMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="navbar-menu" id="navMenu">
                        <div class="navbar-start"></div>
                        <span class="navbar-item ">{{App\Config::getConfigValueOf('schoolName')}}</span>
                        <div class="navbar-end">
                            @if (Auth::guest())
                              <a class="navbar-item " href="{{ route('about') }}">Περί...</a>
                                <a class="navbar-item " href="{{ route('login') }}">Είσοδος</a>
                                @if($allowRegister)
                                  <a class="navbar-item " href="{{ route('register') }}">Εγγραφή</a>
                                @endif
                            @else
                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                                    <div class="navbar-dropdown">
                                    @if( Auth::user()->role_description() == "Διαχειριστής")
                                    <a class="navbar-item" href="{{ route('home') }}">
                                        Αρχική
                                    </a>
                                    <a class="navbar-item" href="{{ route('admin') }}">
                                        Διαχείριση
                                    </a>
                                    <a class="navbar-item" href="{{ route('teachers') }}">
                                        Καθηγητές
                                    </a>
                                    <a class="navbar-item" href="{{ route('students') }}">
                                        Μαθητές
                                    </a>
                                      <a class="navbar-item" href="{{ route('export') }}">
                                          Εξαγωγή xls
                                      </a>
                                      @endif
                                      <a class="navbar-item" href="{{ route('about') }}">
                                          Περί...
                                      </a>
                                        <a class="navbar-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            Έξοδος
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
