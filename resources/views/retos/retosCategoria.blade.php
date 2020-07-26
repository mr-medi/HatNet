@extends('layouts.master')
@section('titulo')
Retos / {{ $cat }}
@endsection
@section('contenido')
  <br>
  <br><br>
  <br>
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
      <a href="{{url('/retos')}}"
          style="margin:15px;">
          Retos
      </a>

      @if(isset($retos[0]))
          <a href="{{url('retos')}}/{{$retos[0]->categoria->categoria}}"
              style="margin:15px;">
              {{$retos[0]->categoria->categoria}}
          </a>
      @else
          <br>
          <h1>
              No hay retos creados para la categoría
              <span style="color:#2ba6d4">
                  {{ $cat }}
              </span>
                  ...Crealos tú mismo!
          </h1>
          <a href="{{ url('/retos/crear') }}">
              Pulse aquí para empezar a crear un reto!
          </a>
      @endif
  </span>
  @if(isset($retos[0]))
      <div class='table-responsive'>
        <table class='table table-striped table-sm'>
        <thead>
          <td></td>
          <td>Nombre</td>
          <td>Descripcion</td>
          <td>Autor</td>
        </thead>
        <tbody>
            @foreach( $retos as $r )
                @if($r->reto instanceof App\Challenge)
                    <tr>
                      <td>
                        @if($r->isRetoCompleted($r->reto->id))
                          <img src="{{asset('assets/imagenes/good.svg')}}" width='50' height='50'>
                        @else
                          <img src="{{asset('assets/imagenes/wrong.svg')}}" width='50' height='50'>
                        @endif
                      </td>
                      <td>
                        <a href="{{ url('retos/'.$r->categoria->categoria.
                            '/'.$r->slug) }}">
                          {{ $r->nombre }}
                        </a>
                      </td>
                      <td>
                        {{ $r->descripcion }}
                      </td>
                      <td>
                        <a href="{{ url('users')}}/{{$r->user->slug}}">
                          {{ $r->user->name }}
                        </a>
                      </td>
                    </tr>
                @endif
            @endforeach
          @foreach( $retos as $r )
             <!--
             <tr>
               <td>
                 @if($r->isRetoCompleted($r->id))
                   <img src="{{asset('assets/imagenes/good.svg')}}" width='50' height='50'>
                 @else
                   <img src="{{asset('assets/imagenes/wrong.svg')}}" width='50' height='50'>
                 @endif
               </td>
               <td>
                 <a href="{{ url('retos/'.$r->categoria->categoria.'/'.$r->nombre) }}">
                   {{ $r->nombre }}
                 </a>
               </td>
               <td>
                 {{ $r->descripcion }}
               </td>
               <td>
                 <a href="{{ url('users')}}/{{$r->user->name}}">
                   {{ $r->user->name }}
                 </a>
               </td>
             </tr>
             -->
          @endforeach
        </tbody>
        </table>
      </div>
  @endif
@endsection
