@extends('layouts.master')
@section('titulo')
Comunity / Foro
@endsection
@section('contenido')
  <br>
  <br>
  <br>
  @if(session('mensaje'))
      <div style="color:black">
              {{ session('mensaje') }}
      </div>
  @endif
  <span>
      <a href="/">
          Inicio
      </a>
     <a href="{{url('comunidad')}}" style="margin:15px;">
         Comunity
    </a>
    <a href="{{url('comunidad/foro')}}" style="margin:15px;">
        Foro
   </a>
  </span><br>
  <strong>Danos tu opinion!</strong><br>
  <form method="POST" action="{{url('comunidad/foro/crear')}}">
      {{ csrf_field() }}
      Sugerencia:<input type="text" name="titulo"><br>
      <input type="submit" name="enviar">
  </form><br>
  @inject('p', 'App\Post')
  <strong>Pagina: </strong>
  @for($i = 0 ; $i < $p::count() / 5 ; $i++)
    <a name="page" href="?page={{ $i+1 }}">
      {{ $i+1 }}
    </a>
  @endfor
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
  <div class="my-3 p-3 bg-white rounded shadow-sm">
      <h6 class="border-bottom border-gray pb-2 mb-0">Sugerencias:</h6>
      @foreach ($posts as $post)
          @if($contador>=(5*$page-5) && $contador<($page*5))
          <div class="media text-muted pt-3">
              <img class="bd-placeholder-img mr-2 rounded"
               src="{{asset('assets/imagenes/'.$post->autor->rutaImagen)}}"
                width='50' height='50'>
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <a href="{{url('users')}}/{{$post->autor->slug}}"
                       class="d-block text-gray-dark">
                      {{$post->autor->name}}
                  </a>

                  {{$post->titulo}}
              </p>
              <p>{{$post->created_at}}</p>
        </div>
        @endif
        @php
          $contador++;
          $pos++;
        @endphp
      @endforeach
  </div>
