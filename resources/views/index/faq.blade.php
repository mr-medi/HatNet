@extends('layouts.master')
@section('titulo')
Index / FAQ
@endsection
@section('contenido')
<br><br><br><br>
@inject('s','App\Status')
<div class="container">
    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
        <a href="{{url('/faq')}}" style="margin:15px;">
            F.A.Q
        </a>
    </span><br><br><br><br>

    <div class="row">
        <img src="{{asset('assets/imagenes/faq.svg')}}"
        width="50"
        height="50">
        <h2 style="margin-left:50px">Frequently Asked Questions</h2><br>
    </div><br>

    <div class="row">
        <h2 style="color:#2ba6d4">
            ¿Qué es una flag?
        </h2><br>
        <p>
            Es una palabra que debemos encontrar en cada reto.
            Serás capaz de validar que has completado el reto una vez
             la hayas introducido.
        </p>
    </div>

    <div class="row">
        <h2 style="color:#2ba6d4">
            ¿Qué status hay?
        </h2><br><br>
        <p><br><br><br>
            @foreach ($s::all() as $st)
                <img src="{{asset('assets/imagenes/')}}/{{$st->logo}}"
                width="50" height="50">{{$st->nombre}}<br>
            @endforeach
        </p>
    </div>
</div>
@endsection
