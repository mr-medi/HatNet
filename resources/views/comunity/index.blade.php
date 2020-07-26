@extends('layouts.master')
@section('titulo')
Comunity
@endsection
@section('contenido')
  <br>
  <br>
  <br>
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
     <a href="{{url('comunidad')}}" style="margin:15px;">
         Comunity
    </a>
  </span>
  <div class="position-relative overflow-hidden p-3 p-md-0 m-md-0 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-0">
          <img src="{{ asset('assets/imagenes/comunidad.svg') }}" width="80" height="80"
           style="float:right;margin:10px">
          <h1 class="display-4 font-weight-normal">
              Comunidad
          </h1>
          <p class="lead font-weight-normal">
              En esta seccion te ofrecemos los medios para compartir
               tus ideas y ver informacion relaccionada con los usuarios
          </p>
      </div>
    </div>
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
      <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
          <div class="my-3 py-3">
              <img src="{{ asset('assets/imagenes/ranking.svg') }}" width="50" height="50"
               style="float:right;margin:10px">
              <h2 class="display-5">
                  <a href="{{ url('comunidad/ranking') }}">
                      Ranking
                  </a>
              </h2>
              <p class="lead">
                  Clasificacion de los usuarios
              </p>
          </div>
      </div>
          <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
              <div class="my-3 py-3">
                  <img src="{{ asset('assets/imagenes/foro.svg') }}" width="50" height="50"
                   style="float:right;margin:10px">
                  <h2 class="display-5">
                      <a href="{{ url('comunidad/foro') }}">
                        Foro
                      </a>
                  </h2>
                  <p class="lead">
                      Comparte tus ideas o sugerencias en nuestro foro
                  </p>
              </div>
    </div>
    </div>
@endsection
