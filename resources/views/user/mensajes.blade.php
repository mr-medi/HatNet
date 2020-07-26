@extends('layouts.master')
@section('titulo')
Mostrando seccion de mensajes
@endsection
@section('contenido')
@inject('m', 'App\Mensaje')
    <br><br><br><br>
    <div class="container">
        <span>
            <a href="{{url('/')}}">
                Inicio
            </a>
           <a href="{{url('/mensajes')}}" style="margin:15px;">
               Mensajes
           </a>
       </span><br><br>
        <dl class="tabs col-md-4">
            <dd class="col-sm-5">
                <a href="?ver=entrada">Bandeja de entrada</a>
            </dd>
            <dd class="col-sm-5">
                <a href="?ver=salida">Bandeja de salida</a>
            </dd>
        </dl>
        <div class="position-relative overflow-hidden p-3 p-md-0 m-md-0 text-center bg-light">
            <div class="col-md-5 p-lg-5 mx-auto my-0">
                <img src="{{ asset('assets/imagenes/mensaje.svg') }}" width="80" height="80"
                 style="float:right;margin:10px">
                <h1 class="display-4 font-weight-normal">
                    Mensajes
                </h1>
                <p class="lead font-weight-normal">
                    En esta seccion encontraras todos los mensajes
                </p>
            </div>
          </div>
          <div class="d-md-flex flex-md-equal w-100 my-md-3 pl-md-3">
            <div class="bg-light mr-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
                @php
                  $page = "entrada";
                  if(isset($_GET["ver"]))
                  {
                      $page = htmlspecialchars($_GET["ver"]);
                  }

                  $contador = 0;
                  $pos = 1;
                @endphp
                @foreach ($m::all() as $mensaje)
                    @php
                        $idEmisor = $mensaje->idEmisor;
                        $idReceptor = $mensaje->idReceptor;
                    @endphp
                    @if ($page == "entrada")
                        @if (Auth::user()->id == $idEmisor)
                            <div class="my-3 py-3">
                            <h2 class="display-5">
                                para
                                <a href="{{ url('users')}}/{{$mensaje->user->slug}}">
                                  {{$mensaje->user->name}}
                                </a>
                                , {{$mensaje->created_at}}
                            </h2>
                            <p class="lead">
                                {{$mensaje->mensaje}}
                            </p></div>
                            <br>
                        @endif
                    @else
                        @if (Auth::user()->id == $idReceptor)
                            @php
                                $emisor = App\User::getReceptorMensaje($idEmisor);
                            @endphp
                            <div class="my-3 py-3">
                            <h2 class="display-5">
                                de
                                <a href="{{ url('users')}}/{{$emisor->slug}}">
                                    {{$emisor->name}}
                                </a>
                                , {{$mensaje->created_at}}
                            </h2>
                            <p class="lead">
                                {{$mensaje->mensaje}}
                            </p></div>
                            <br>
                        @endif
                    @endif
                @endforeach
            </div>
          </div>


    </div>
@endsection
