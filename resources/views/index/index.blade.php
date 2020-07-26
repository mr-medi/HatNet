@extends('layouts.master')
@section('titulo')
Index
@endsection
@section('contenido')
@inject('r','App\Challenge')
@inject('t','App\Tool')
@inject('c','App\Category')
    <br><br><br>
    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
    </span>
    <div class="text-center cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <main class="inner cover" style="background-color:#edecec">
            <!--#df2525-->
            <img
            src="{{asset('assets/imagenes/logo.png')}}"
            width="150"
            height="150">
            <h1 class="cover-heading">
                HATNET
            </h1>
            <p class="lead">
                Una plataforma accesible para aprender
                sobre hacking.
            </p>

            <div class="row">
                <div class="col-md-4" style="background-color:white;margin:2%">
                    <h2><span style="color:#2ba6d4">{{ $r::all()->count() }}</span> Retos</h2>
                    <p class="lead">
                        @if ( $r::all()->count() == 0)
                            En este momento no hay retos a tu disposición.
                        @elseif($r::all()->count() == 1)
                            1 reto está a tu disposición para practicar en entornos, no simulados y así podras dominar varias tecnicas de hacking!
                        @else
                            Más de
                            {{ $r::all()->count() -1 }}
                             retos estan a tu disposición para practicar en varios entornos, no simulados y así podras dominar varias tecnicas de hacking!
                        @endif

                    </p>
                    @foreach ($c::all() as $p)
                        <a
                        href="{{ url('retos') }}/{{$p->categoria}}">
                            <img
                            src="{{asset('assets/imagenes/')}}/{{$p->logo}}"
                            width='40'
                            height='40'>
                        </a>
                    @endforeach
                </div>

                <div class="col-md-4" style="background-color:white;margin:2%">
                    <h2><span style="color:#2ba6d4">{{ $t::all()->count() }}</span> Herramientas</h2>
                    <p class="lead">
                        @if ( $t::all()->count() == 0)
                            En este momento no hay herramientas a tu disposición.
                        @elseif($t::all()->count() == 1)
                            1 herramienta estan a tu disposición para aprender a programar
                        @else
                            {{ $t::all()->count() }} herramientas estan a tu disposición para aprender a programar
                        @endif

                    </p>
                </div>
            </div>
        </main>
    </div>

@endsection
