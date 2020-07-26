@extends('layouts.master')
@section('titulo')
API
@endsection
@section('contenido')
  <br>
  <br>
  <br>
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
     <a href="{{url('api')}}" style="margin:15px;">
         API
    </a>
  </span>
  <div class="position-relative overflow-hidden p-3 p-md-0 m-md-0 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-0">
          <img src="{{ asset('assets/imagenes/api.svg') }}" width="80" height="80"
           style="float:right;margin:10px">
          <h1 class="display-4 font-weight-normal">
              API
          </h1>
          <p class="lead font-weight-normal">
              En esta seccion te ofrecemos los medios para usar nuestra API.
          </p>
      </div>
    </div>
    <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
        <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
          <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
              <div class="my-3 py-3">
                  <img src="{{ asset('assets/imagenes/rest.png') }}" width="50" height="50"
                   style="float:right;margin:10px">
                  <h2 class="display-5">
                      <a href="{{ url('api/rest') }}">
                          REST
                      </a>
                  </h2>
                  <p class="lead">
                      API usando REST.
                  </p>
              </div>
          </div>
    </div>
@endsection
<br>
