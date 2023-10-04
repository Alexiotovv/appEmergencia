<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../../../assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	{{-- <link href="../../../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../../../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../../../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" /> --}}
	
	<!-- loader-->
	{{-- <link href="../../../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../../../assets/js/pace.min.js"></script> --}}
	<!-- Bootstrap CSS -->
	<link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../../../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="../../../assets/css/app.css" rel="stylesheet">
	<link href="../../../assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	{{-- <link rel="stylesheet" href="../../../assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../../../assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../../../assets/css/header-colors.css" /> --}}

    @yield('extra_css')
    <title>Emergency</title>
</head>
<body>
    <!--wrapper-->
    <div class="wrapper">
        @yield('content')
        <footer class="page-footer">
            <p class="mb-0">Copyright © 2021. All right reserved.</p>
        </footer>
    </div>

<!-- Bootstrap JS -->
<script src="../../../assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="../../../assets/js/jquery.min.js"></script>
{{-- <script src="../../../assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="../../../assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="../../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script> --}}

{{-- <script src="../../../assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script> --}}


{{-- <script src="../../../assets/js/index.js"></script> --}}
<!--app JS-->
<script src="../../../assets/js/app.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

@yield('extra_js')

</body>

</html>
