@extends('layouts.master')
@section('titulo')
Comunity / Ranking
@endsection
@section('contenido')
    <style>
        .pic
        {
            float: left;
            border-width: 5px;
            border-style: solid;
        }
    </style>
  <br>
  <br>
  <br>
  <span>
      <a href="/">
          Inicio
      </a>
     <a href="{{url('comunidad')}}" style="margin:15px;">
         Comunity
    </a>
    <a href="{{url('comunidad/ranking')}}" style="margin:15px;">
        Ranking
   </a>
  </span>
  <br>
  @inject('u', 'App\User')
  <strong>Pagina: </strong>
  @for($i = 0 ; $i < $u::count() / 10 ; $i++)
    <a name="page" href="?page={{ $i+1 }}">
      {{ $i+1 }}
    </a>
  @endfor

  <div class='table-responsive'>
    <table class="table table-striped table-sm">
      <thead>
        <td>Posicion</td>
        <td>Avatar</td>
        <td>Usuario</td>
        <td>Status</td>
        <td>Puntos</td>
      </thead>
      <tbody>
        @php
          $page = 1;
          if(isset($_GET["page"]))
          {
            if(is_numeric($_GET["page"]))
              $page = $_GET["page"];
          }
          $contador = 0;
          $pos = 1;
        @endphp
        @foreach($users as $user)
          @if($contador >= (10*$page-10) && $contador<($page*10))
              <tr>
                <td>
                  <strong># {{ $pos }}</strong>
                </td>
                <td>
                  <img src="{{ asset('assets/imagenes/'.$user->rutaImagen) }}"
                  width='50' height='50'
                  style="border-color: <?php echo $user->status->color ?>;"
                  class="pic">
                </td>
                <td>
                  <a href="{{ url('users/'.$user->slug) }} ">
                    {{ $user->name }}
                  </a>
                </td>
                <td>
                    <img src="{{ asset('assets/imagenes/'.$user->status->logo) }}"
                    width='50' height='50'>
                </td>
                <td>
                  {{ $user->puntos }}
                </td>
              </tr>
          @endif
          @php
            $contador++;
            $pos++;
          @endphp
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
