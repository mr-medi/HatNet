@extends('layouts.master')
@section('titulo')
Index / SiteMap
@endsection
@section('contenido')
@inject('c','App\Category')

<br><br><br><br>

<div class="container">
    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
        <a href="{{url('/sitemap')}}" style="margin:15px;">
            SiteMap
        </a>
    </span><br><br><br><br>
    <div class="row">
        <img src="{{asset('assets/imagenes/sitemap.svg')}}"
        width="50"
        height="50">
        <h2 style="margin-left:50px">SiteMap</h2><br>
    </div>
    <div class="row" style="margin-top:50px">
      <div class="col-md-3">
        <ul>
            <li>
                <h3><a href="{{url('retos')}}">Retos</a></h3>
                <ul>
                    @foreach ($c::all() as $p)
                        <li>
                            <a href="{{url('retos')}}/{{$p->categoria}}">
                                {{$p->categoria}}
                            </a>
                        </li>
                    @endforeach
              </ul>
           </li>
        </ul>
      </div>
  </div>
  <div class="row" style="margin-top:50px">
    <div class="col-md-3">
      <ul>
          <li>
              <h3><a href="{{url('/')}}">Index</a></h3>
         </li>
      </ul>
    </div>
  </div>
  <div class="row" style="margin-top:50px">
    <div class="col-md-3">
      <ul>
          <li>
              <h3><a href="{{url('/comunidad')}}">Comunidad</a></h3>
              <ul>
                  <li>
                      <a href="{{url('/comunidad/ranking')}}">
                          Ranking
                      </a>
                  </li>
                  <li>
                      <a href="{{url('/comunidad/foro')}}">
                          Foro
                      </a>
                  </li>
              </ul>
         </li>
      </ul>
    </div>
  </div>

  <div class="row" style="margin-top:50px">
    <div class="col-md-3">
      <ul>
          <li>
              <h3><a href="{{url('/herramientas')}}">Herramientas</a></h3>
              <ul>
                  <li>
                      <a href="{{url('/herramientas/mostrar')}}">
                          Ver
                      </a>
                  </li>
                  <li>
                      <a href="{{url('/herramientas/crear')}}">
                          Crear
                      </a>
                  </li>
              </ul>
         </li>
      </ul>
    </div>
  </div>

</div>
@endsection
