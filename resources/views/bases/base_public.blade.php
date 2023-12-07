<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
	<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    @yield('extra_css')
    <title>Emergencia</title>
</head>
<body>

    <div class="wrapper">
        @yield('content')
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. Derechos Reservados.</p>
        </footer>
    </div>
<script src="{{asset('assets/js/bootstrap.bundle.min.js') }}"></script>
{{-- plugins--}}
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
@yield('extra_js')
</body>
</html>