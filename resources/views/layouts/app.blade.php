<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{-- {{ config('app.name', 'Laravel') }} --}}
        MYCL Japan
    </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        @import url("https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css");
    </style>
    
</head>
<body>
    <div id="app" >
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" > 
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravell') }} --}}
                    <img src="{{ asset('images/tesjapan.png') }}" style="width:50%; height:50%">
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                            
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="baglogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__('monitoring.Baglog')}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="baglogDropdown">
                                    <li><a class="dropdown-item" href="{{route('BaglogInputForm')}}">{{__('form.BaglogInputForm')}}</a></li>
                                    <li><a class="dropdown-item" href="{{route('BaglogMonitoring')}}">{{__('monitoring.BaglogTitle')}}</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="myleaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{__('monitoring.Mylea')}}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="myleaDropdown">
                                    <li><a class="dropdown-item" href="{{route('MyleaProductionForm')}}">{{__('form.MyleaProductionForm')}}</a></li>
                                    <li><a class="dropdown-item" href="{{route('MyleaMonitoring')}}">{{__('monitoring.MyleaTitle')}}</a></li>
                                </ul>
                            </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(session()->get('lang_code')=='jp')
                                         JP 
                                    @else 
                                        EN
                                    @endif 
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="langDropdown">
                                    <a class="nav-link" href="#" onclick="changeLanguage('en')"><span class="flag-icon flag-icon-us flag-icon-squared"></span> EN </a>
                                    <a class="nav-link" href="#" onclick="changeLanguage('jp')"><span class="flag-icon flag-icon-jp flag-icon-squared"></span> JP </a>
                                </ul>
                            </li>
                            {{-- <li class="nav-item dropdown">
                                <select onchange="changeLanguage(this.value)" class="form-select col-2">
                                    <option {{session()->has('lang_code')?(session()->get('lang_code')=='en'?'selected':''):''}} value="en">English</option>
                                    <option {{session()->has('lang_code')?(session()->get('lang_code')=='jp'?'selected':''):''}} value="jp">Japanese</option>
                                </select>
                            </li> --}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <script>
            function changeLanguage(lang){
                window.location='{{url("change-language")}}/'+lang;
            }
        </script>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
