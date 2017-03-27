<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ラムラムツアーズ　赤いシャトルバス</title>   

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('js/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
 <!--    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}"> -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

    <!-- Fonts -->
    <link href="{{ asset('css/fonts/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('css/fonts/font.css') }}" rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- LamLam CSS/JS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/lamlam.js') }}"></script>

    <style>
        body {font-family: 'Lato';}
        .fa-btn {margin-right: 6px;}
    </style>
  </head>
  <body>
    <div class="container">
        @include('admin.menu')
        @yield('admin.content')
        <section>
            <footer>
                <div class="row">LAMLAM TOURS & TRANSPORTATION &copy; Copyright</div>
            </footer>
        </section>
    </div>
  </body>
  {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}  
</html>
