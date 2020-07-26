@extends('layouts.master')
@section('titulo')
Retos / {{ $reto->categoria->categoria }} / {{{$reto->nombre}}}
@endsection
@section('contenido')

@inject('categoria','App\Category')
  <br><br><br><br><br>
  @if(session('mensaje'))
      <div class="">
              {{ session('mensaje') }}
      </div>
@endif
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
      <a href="{{url('/retos')}}"
          style="margin:15px;">
          Retos
      </a>
      <a href="{{url('retos')}}/{{ $reto->categoria->categoria }}"
          style="margin:15px;">
          {{ $reto->categoria->categoria }}
      </a>
      <a href="{{url('retos')}}/{{$reto->categoria->categoria}}/{{$reto->nombre}}"
          style="margin:15px;">
          {{$reto->nombre}}
      </a>
  </span>
  <div class="row">
  	<div class="col-sm-3">
  	</div>
  	<div class="col-sm-9">
  		<h1>{{ $reto->nombre }}</h1>
      <strong class="d-inline-block mb-2 text-primary">{{ $reto->reto->puntos }} Puntos</strong>
      <br>
  		<strong class="d-inline-block mb-2 text-primary">{{ $reto->descripcion }}</strong>
      <h1>Autor</h1>
      <a href="{{ url('users/'.$reto->user->slug) }}">
        {{ $reto->user->name }}
      </a><br><br>
      <a href="{{url('retos/validations')}}/{{$reto->nombre}}">
          {{$reto->usuariosCompleted2($reto)->count()}}
          usuarios han completado este reto
      </a>
      <br><br><br>
      <a class="btn btn-secondary my-2"
      href="{{ url($reto->getRutaCategoria($reto->idCategoria).$reto->reto->rutaReto) }}">
      Empezar reto
      </a>
      <br><br><br><br>
      <h1>Validacion</h1>
      <!--FORMULARIO-->
      <form method="POST" action="{{ url('retos/validar') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Escribe la clave del reto</label>
          <input type="text" name="flag" class="form-control">
        </div>
        <input type="hidden" name="idReto" value="{{ $reto->id }}">
        <div class="form-group text-center">
          <button type="submit" class="btn btn-success" style="padding:8px 100px;margin-top:25px;">
            Resolver Reto
          </button>
        </div>
      </form>
  	</div>
  </div><br>
  <a href="{{ url('/retos') }}" class="btn btn-primary">Volver al listado</a>
@endsection
