<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin_assets/assets/img/favicon.png') }}">
    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="{{ asset('admin_assets/assets/img/apple-icon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/bootstrap.min.css') }}">
    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/plugins/tabler-icons/tabler-icons.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/style.css') }}" id="app-style">
    <link rel="stylesheet" href="{{ asset('admin_assets/assets/css/custom.css') }}">
</head>

<body class="account-page bg-white">

    <div id="toastContainer" class="position-fixed bottom-0 end-0 p-3" style="z-index: 99999;"></div>


    {{ $slot }}

    <!-- jQuery -->
    <script src="{{ asset('admin_assets/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/assets/js/script.js') }}"></script>
    <script src="{{ asset('admin_assets/js/helper.js') }}"></script>
    {{-- other --}}
    @stack('scripts')
    {{-- Vite JS --}}
    {{-- {{ module_vite('build-auth', 'resources/assets/js/app.js') }} --}}
</body>
</html>
