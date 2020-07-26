<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <script src="{{asset('js/jquery.js')}}"></script>
    <link href="{{asset('js/jquery-ui.js')}}" rel="Stylesheet"></link>
    <script src="{{asset('js/jquery2.js')}}" ></script>
    <script type="text/javascript" src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">


    <title>@yield("titulo")</title>
  </head>
  <body>
    @include("partials.navbar")
    <!--START CONTENIDO-->
     <div class="container" style="height: auto;position:relative">
         @yield("contenido")
    </div>
    <!--FIN CONTENIDO-->
    <br><br><br>
    @include('partials.footer')
  </body>
</html>
