@extends('layouts.master')
@section('titulo')
Herramientas / Mostrar
@endsection
@inject('h', 'App\Herramienta')
<br><br><br>
@section('contenido')
    <script type="text/javascript">
    $(document).ready( function()
    {
        $('img[name=image-form]').click( function()
        {
            this.parentNode.submit();
        });
    });
    </script>


    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
       <a href="{{url('herramientas')}}" style="margin:15px;">
           Herramientas
       </a>
       <a href="{{url('herramientas/mostrar')}}" style="margin:15px;">
           Ver
       </a>
    </span>
<br><br><br>
  @foreach( $h::all() as $tool )
      <div class="row" style="margin:10px;border:2px solid black">
         <div class="col-sm-4">
             <a href="{{url('herramientas/ver')}}/{{$tool->project->slug}}">
                 <img src="{{asset('assets/imagenes')}}/{{$tool->rutaImagen}}"
                 width="150" heigth="150">
         </a>
         </div>
         <div class="col-md-4">
             <span class="badge badge-secondary">
                <h2>{{$tool->project->nombre}}</h2>
             </span>
         </div>
         <div class="col-sm-2" style="float:right;">
             <span class="badge badge-primary">
                    <h4>{{$tool->project->ficheros[0]->lenguaje->nombre}}</h4>
             </span>
         </div>
         <div class="col-md-20" style="">
             <span class="badge">
                 <!--FORM TO GIVE LIKE!-->
                 <form id="form-like-project" method="POST" action="{{url('herramientas/like')}}">
                     @csrf
                     <input type="hidden" name="idProject" value="{{$tool->project->id}}">
                        @if ($tool->project->isLike($tool->project->id) )
                            <img name="image-form" src="{{ asset('assets/imagenes/like-si.png') }}"
                            width="50"
                            height="50">
                        @else
                            <img name="image-form" src="{{ asset('assets/imagenes/like-no.png') }}"
                            width="50"
                            height="50">
                        @endif

                 </form>
                 <h2>{{$tool->project->valoraciones->count()}}</h2>
             </span>
         </div>
     </div>
  @endforeach
@endsection
