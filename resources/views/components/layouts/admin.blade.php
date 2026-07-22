<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('admin_assets/assets/img/favicon.png')}}">
        <!-- Apple Icon -->
        <link rel="apple-touch-icon" href="{{ asset('admin_assets/assets/img/apple-icon.png')}}">
        <!-- Theme Config Js -->
        {{-- <script src="{{ asset('admin_assets/assets/js/theme-script.js')}}"></script> --}}
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
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome/css/all.min.css') }}">
        {{--  --}}

        {{-- Vite CSS --}}
        {{-- {{ module_vite('build-permission', 'resources/assets/sass/app.scss') }} --}}
    </head>

    <body>
        <!-- Begin Wrapper -->
        <div class="main-wrapper">
            <div id="table-loader">
                <div class="table-spinner"></div>
            </div>

            <div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 99999;"></div>

            <div id="appToast" class="toast align-items-center text-bg-info border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true"
                style="z-index: 9999;">
                <div class="d-flex">

                    <div class="toast-body">
                        {{ session('info') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
            <!-- Topbar Start -->
            @include('admin.include.header')
            <!-- Topbar Start -->

            <!-- Sidenav Menu Start -->
            @include('admin.include.sidebar')
            <!-- Sidenav Menu End -->

            <!-- ========================
                Start Page Content
            ========================= -->
            <div class="page-wrapper">

                <!-- Start Content -->
                <div>
                   {{ $slot }}
                </div>
                <!-- End Content -->

                <!-- Start Footer -->
                <footer class="footer d-block d-md-flex justify-content-between text-md-start text-center">
                    <p class="mb-md-0 mb-1">Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="javascript:void(0);" class="link-primary text-decoration-underline">CRMS</a>
                    </p>
                    <div class="d-flex align-items-center gap-2 footer-links justify-content-center justify-content-md-end">
                        <a href="javascript:void(0);">About</a>
                        <a href="javascript:void(0);">Terms</a>
                        <a href="javascript:void(0);">Contact Us</a>
                    </div>
                </footer>
                <!-- End Footer -->
            </div>
            <!-- ========================
                End Page Content
            ========================= -->
        </div>

        {{-- Vite JS --}}
        {{-- {{ module_vite('build-permission', 'resources/assets/js/app.js') }} --}}
        <script src="{{ asset('admin_assets/assets/js/jquery-3.7.1.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/datatables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/datatables/js/dataTables.bootstrap5.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/js/moment.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/apexchart/chart-data.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/json/dashboard.js')}}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('admin_assets/assets/js/sweetalerts.js') }}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/choices.js/public/assets/scripts/choices.min.js') }}"></script>
        <script src="{{ asset('admin_assets/assets/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('admin_assets/assets/js/script.js')}}"></script>
        <script src="{{ asset('admin_assets/js/helper.js')}}"></script>
        {{-- Page Specific JS --}}
        @stack('scripts')
    </body>
</html>
