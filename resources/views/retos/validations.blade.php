@extends('layouts.master')
@section('titulo')
Validaciones de {{$reto->nombre}}
@endsection
@section('contenido')
    <br><br><br>

    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
        <a href="{{url('/retos')}}"
            style="margin:15px;">
            Retos
        </a>
        <a href="{{url('/retos/validations')}}/{{$reto->slug}}" style="margin:15px;">
            Validaciones de {{$reto->slug}}
        </a>

    </span>

    <h2>Mostrando usuarios que han completado el reto '{{$reto->nombre}}'</h2>
    <div class='table-responsive'>
      <table class='table table-striped table-sm'>
          <thead>
            <td>Usuario</td>
          </thead>
          <tbody>
          @foreach ($users as $user)
              <tr>
                  <td>
                      <a href="{{ url('users/'.$user->slug) }} ">
                        {{ $user->name }}
                      </a>
                  </td>
            </tr>
          @endforeach
        </tbody>
    </table>
@endsection
