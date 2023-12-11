<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- favicon --}}
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    {{-- plugins --}}
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    {{-- Bootstrap CSS --}}
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    {{-- Theme Style CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
    <title>{{ $title ?? 'Panel de Control' }}</title>
    @livewireStyles
    @stack('styles')
</head>
<body>
    @if (Route::has('login'))
        @auth
            <div class="wrapper">

                @livewire('base.header')
                
                @livewire('base.side-bar')

                {{ $slot }}
                
                <div class="overlay toggle-icon"></div>
                <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
                <footer class="page-footer">
                    <p class="mb-0">Copyright © 2021. Todos los derechos reservados.</p>
                </footer>
            </div>
        @else
            <div class="row" style="padding:50px;">
                <a class="btn btn-warning" href="{{ route('login') }}" style="width: 20%;text-align:center;">Inicie
                    Sesión</a>
            </div>
        @endauth
    @endif
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    {{-- plugins --}}
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- app JS --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>
</html>
