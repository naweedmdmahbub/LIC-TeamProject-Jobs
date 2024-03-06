<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>AdminLTE 3 | Dashboard</title>
        @include('layouts.styles')
        @include('layouts.scripts')
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
          </div>
          @include('layouts.navbar')

          @include('layouts.sidebar')
          
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                @yield('content')
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
          </div>
          @include('layouts.footer')

        </div>
        <!-- ./wrapper -->

    </body>
</html>
