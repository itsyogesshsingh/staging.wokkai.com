<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>403 - Access Denied!</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/img/favicon.png')}}">
    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="{{ asset('admin_assets/assets/img/apple-icon.png')}}">
    <!-- Theme Config Js -->
    <script src="{{ asset('admin_assets/assets/js/theme-script.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/bootstrap.min.css')}}">
    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/tabler-icons/tabler-icons.min.css')}}">
    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/simplebar/simplebar.min.css')}}">
    <!-- Sweetalert2 CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/datatables/css/dataTables.bootstrap5.min.css')}}">
    <!-- Daterangepicker CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/select2/css/select2.min.css') }}">
	<!-- Choices CSS -->
	<link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/choices.js/public/assets/styles/choices.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/style.css')}}" id="app-style">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/custom.css')}}">
    {{--  --}}

</head>

<body class="error-page">
    <!-- Begin Wrapper -->
    <div class="main-wrapper">
        <div class="container">
            <!-- start row -->
            <div class="row justify-content-center align-items-center vh-100">

                <div class="col-md-8 d-flex align-items-center justify-content-center mx-auto">
                    <div>
                        <div class="error-img p-4">
                            <img src="{{ asset('admin_assets/assets/img/authentication/403.png') }}" class="img-fluid" alt="Img">
                        </div>
                        <div class="text-center">
                            <h2 class="mb-3">Oops, something went wrong</h2>
                            <p class="mb-3"><b>Access Denied / Forbidden you have no access</b>
                            <div class="pb-4">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary d-inline-flex align-items-center">
                                    <i class="ti ti-chevron-left me-1"></i>Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{asset('admin_assets/assets/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_assets/assets/js/script.js')}}"></script>
    {{-- other --}}
</body>
</html>
