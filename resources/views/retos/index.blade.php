@extends('layouts.master')
@section('titulo')
Mostrando categorias de retos
@endsection
@section('contenido')
  <br>
  <br>
  <br>
  <br>
  @if(session('mensaje'))
      <div style="color:black">
              {{ session('mensaje') }}
      </div>
  @endif<br>
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
      <a href="{{url('/retos')}}"
          style="margin:15px;">
          Retos
      </a>
  </span>
  <div class="album py-5 bg-light">
  <div class="container">
  <div class="row">

  @foreach( $categorias as $c )
    <div class="col-md4">
      <div class="card mb-4 shadow-sm">
      <div class="col-xs-12col-sm-6col-md-4">
        <a href="{{ url('retos/'.$c->categoria) }}">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
          xmlns="http://www.w3.org/2000/svg"
          preserveAspectRatio="xMidYMid slice" focusable="false"
          role="img" aria-label="Placeholder">
            <title>{{ $c->categoria }}</title>
            <rect width="100%" height="100%" fill="#55595c"/>
            <text x="50%" y="50%" fill="#eceeef" dy=".3em">
              {{ $c->categoria }}
            </text>
        </svg>
        Total retos: {{ $c->getCountRetos($c->categoria) }}
        </a>
        <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <p class="card-text">{{ $c->descripcion }}</p>
        </div>
      </div>
    </div>
    </div>
  </div>

  @endforeach
</div>
</div>
</div>
@endsection
