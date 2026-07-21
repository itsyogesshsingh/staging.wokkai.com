<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Default Title')</title>
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
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/fontawesome/css/all.min.css') }}">
    {{--  --}}

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('styles')
</head>
<body>
    <!-- Begin Wrapper -->
    <div class="main-wrapper">

        <div id="table-loader">
            <div class="table-spinner"></div>
        </div>

        {{-- <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastContainer"></div> --}}

        <div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 99999;"></div>

        <div id="appToast" class="toast align-items-center text-bg-info border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true"
            style="z-index: 9999;">

            <div class="d-flex">

                <div class="toast-body">
                    {{ session('info') }}
                </div>

                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>

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
                @section('container')
                    @yield('content')
                @show
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
    <!-- End Wrapper -->

    <!-- jQuery -->
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
    {{--  --}}
    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let toastEl = document.getElementById('appToast');

            if (toastEl && toastEl.querySelector('.toast-body').innerText.trim() !== '') {

                let toast = new bootstrap.Toast(toastEl, {
                    delay: 3000,
                    autohide: true
                });

                toast.show();
            }

        });
    </script>
    <script>
        
        const APP_LOGO = "{{ asset('admin_assets/assets/img/logo-small.svg') }}";

        let logoutUrl = "{{ route('logout') }}";
        let loginUrl = "{{ route('login') }}";

        function logout() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: logoutUrl,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        success: function () {
                            Swal.fire(
                                'Logged Out!', 'You have been successfully logged out.', 'success'
                            ).then(() => {
                                window.location.href = loginUrl;
                            });
                        },
                        error: function () {
                            Swal.fire( 'Error!', 'Logout failed.', 'error' );
                        }
                    });
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const activeItem = document.querySelector(".sidebar li.active");

            if (activeItem) {
                activeItem.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            }
        });
    </script>
</body>
</html>
