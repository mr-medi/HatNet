@extends('layouts.master')
@section('titulo')
Ver perfil de {{ $user->name }}
@endsection
@section('contenido')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>
    <script>
        $(document).ready( function()
        {
            $(".col-sm-5").click(function()
            {
                    $(".col-sm-5").css("background-color","white");
                    $(this).css("background-color","#edecec");
            });

            $('#user').keydown(function()
            {
              function log( message )
              {
                 $( "#result" ).scrollTop( 0 );
              }

              $("#user").autocomplete(
               {
                  source: function( request, response )
                  {
                      var formulario = $( "#user" ).val();

                      $.ajax
                      ({
                          url : "{{url('/busquedaAjax')}}",
                          type : 'POST',
                          data :
                          {
                            "_token":"{{ csrf_token() }}",
                            "busqueda":formulario
                          },
                          dataType : 'json',
                          success : function( json )
                          {
                              $( "#log" ).empty();

                              for(let i in json)
                              {
                                  var info = document.getElementById('result');//DIV UBICADO EN EL FORM
                                  var div  = document.createElement('div');
                                  div.setAttribute('name','search');
                                  div.textContent = json[i].name;//NOMBRE DEL USER
                                  div.addEventListener('click',function()
                                  {
                                      console.log(this.textContent);
                                      document.getElementById('user').value = this.textContent;
                                      this.remove();
                                  });
                                  info.appendChild(div);//LO AÑADIMOS DEBAJO DEL INPUT
                              }
                          }
                      });
                  }
              });
          });
        }
        );
    </script>
    <style>


        .pr
        {
            border-width: 5px;
            border-color: red;
            border-style: solid;
        }

        .tabs
        {
            border-width: 3px;
            border-style: solid;
            margin-left: 35%;
        }

        .col-sm-9
        {
            background-color:white;
        }
    </style>
  <br><br><br><br>
  <span>
      <a href="{{url('/')}}">
          Inicio
      </a>
     <a href="{{url('users')}}/{{$user->slug}}" style="margin:15px;">
         Perfil de {{ $user->name }}
     </a>
  </span>
  <div class="container">
  <div class="row">
     <dl class="tabs col-md-6">
         <dd class="col-sm-5" style="float:left;width: 24%;">
             <a href="?ver=profile">Perfil</a>
         </dd>
         <dd class="col-sm-5" style="float:left;width: 25%;">
             <a href="?ver=score">Puntuacion</a>
         </dd>
         <dd class="col-sm-5" style="float:left;width: 26%;">
             <a href="?ver=stats">Estadisticas</a>
         </dd>
         <dd class="col-sm-5" style="float:left;width: 25%;">
             <a href="?ver=contact">Contacto</a>
         </dd>
     </dl>
     <!--IMAGEN USER-->
     <div class="col-md-4">
   		<img src="{{ asset('assets/imagenes/'.$user->rutaImagen) }}" width="70"
          class="pr">
          <div class="row">
              <h6 style="margin-top:20px;float:left;">{{ $user->name }}</h6>
          </div>

          <div class="row">
              @if(Auth::user() !== null)
                  @if(Auth::user()->name == $user->name)
                    <a href="{{ url('/editar') }}" class="btn btn-secondary">Editar perfil</a>
                  @endif
              @endif
          </div>

          <!--ACTIVIDAD RECIENTE-->
          <div class="row">
              <h4 style="margin-top:20px;float:left;">
                  Actividad reciente
              </h4>
          </div>

          @inject('u','App\UsersChallenge')
          @php
              $activity = false;
          @endphp
          @foreach( $u::all() as $u )
              @php
                  $r=App\Challenge::find($u->idReto);
                  $p = App\Project::find($r->idProject);
              @endphp
            @if ($user->id == $u->idUsuario)
                @php
                    $activity = true;
                @endphp
                <div class="col-md4">
                  <div class="col-xs-12col-sm-6col-md-4">
                      <img src="{{asset('assets/imagenes/')}}/{{$p->categoria->logo}}"
                      width='40' height='40'>
                        <a href="{{ url('retos') }}/{{$p->categoria->slug}}/{{$p->slug}}">
                        <title>{{ $p->nombre }}</title>
                        <rect width="100%" height="100%" fill="#55595c"/>
                        <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                            @php
                                echo $p->nombre." en ".$p->created_at;
                            @endphp
                        </text>
                        </a>
                    </div>
                </div>
            @endif
          @endforeach
          @if (!$activity)
              <div class="col-md4 h-25">
                <div class="col-xs-12col-sm-6col-md-4">
                      <title>No se ha encontrado actividad reciente....</title>
                      <rect width="100%" height="100%" fill="#55595c"/>
                      <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                          No se ha encontrado actividad reciente....
                      </text>
                  </div>
              </div>
          @endif
          <!--FIN ACTIVIDAD RECIENTE-->
   	</div>

    <div class="col-md-2 h-25">
        <img src="{{ asset('assets/imagenes/score.svg') }}" width="50" height="50"
         style="float:left;margin-right: 20px">
      <h3>{{ $user->puntos }}</h3>
      <strong>Puntos</strong>
    </div>
    <div class="col-md-2 h-25">
        <img src="{{ asset('assets/imagenes/posicion.svg') }}" width="50" height="50"
         style="float:left;margin-right: 20px">
      <h3>{{ $user->positionRanking($user->id) }}</h3>
      <strong>Posición</strong>
    </div>
    <div class="col-md-2 h-25">
        <img src="{{ asset('assets/imagenes/reto.svg') }}" width="50" height="50"
         style="float:left;margin-right: 20px">
      <h3>{{ $user->retosCompleted->count() }}</h3>
      <strong>Retos</strong>
    </div>
    <div class="col-md-2 h-25">
        <img src="{{ asset('assets/imagenes/herramienta.svg') }}" width="50" height="50"
         style="float:left;margin-right: 20px">
         @php
             $id = $user->id;
         @endphp
      <h3>{{$user->totalTools($id)}}</h3>

      <strong>Tools</strong>
    </div>
<!--DIV ROW</div>-->
<!--DIV CONTAINER</div>-->

  <!--SHOWING OPTION-->
  <br>
  <div class="col-md-8 h-50" style="margin-left:35%;position:relative;margin-top:0%">
    <div class="col-md-8 h-50">
  @php
      $ver = "profile";
      if(isset($_GET["ver"]))
      {
          $ver = $_GET["ver"];
          if($ver!="profile"&&$ver!="score"&&$ver!="stats"&&$ver!="contact")
              $ver="profile";
      }
  @endphp

      @if($ver == "profile")

          <h3>Mi informacion:</h3>
          <a href="">
              <img src="{{asset('/assets/imagenes/help.svg')}}" width="20" height="20">
          </a>
          Status: <img src="{{asset('/assets/imagenes/')}}/{{$user->status->logo}}" width='50' height='50'>
    @elseif($ver == "score")
          @inject('r', 'App\Reto')
          @inject('p', 'App\Project')
          @inject('u', 'App\User')
          @inject('c', 'App\Categoria')
          <div class="row">
              <strong>Retos</strong><br>
          </div>
          <div class="row">
              <p>
                  {{$user->retosCompleted->count()}}
                  /
                  {{ $r::all()->count() }} retos completados
              </p>
          </div>
          <div class="row">
              <strong>Posicion</strong><br>
          </div>
          <div class="row">
              <p>{{ $user->positionRanking($user->id) }}
                  /
                  {{ $u::all()->count() }}
              </p>
          </div>
          <div class="row">
              @foreach ($c::all() as $categoria)
                  <div class="col-md-6" style="border:1px solid rgb(238, 238, 238);">
                      <h4>
                          <div class="pull-right ">
                              <a href="{{url('retos')}}/{{$categoria->categoria}}">
                                  {{ $categoria->categoria }}
                              </a>
                              <img src="{{asset('assets/imagenes/')}}/{{$categoria->logo}}"
                              width='40'
                              height='40'>
                          </div>
                          <span class="badge badge-secondary" style="margin: 10px">
                              {{ $user->getPuntosCategoria($categoria->id,$user->id) }} puntos
                              &emsp;
                              {{ $user->getRetosCategoria($categoria->id,$user->id) }}
                              /
                              {{ $c->getCountRetos($categoria->categoria) }}
                          </span>
                    </h4>
                   </div>
            @endforeach
          </div>
    @elseif($ver == "stats")
          <h3>Mis stats</h3>
          @php
           $pos = $user->positionRanking($user->id);
           $usersToShow = 5;
           $i = $pos;
          @endphp
          <div class='table-responsive'>
            <table class="table table-striped table-sm">
              <thead>
                <td>Posicion</td>
                <td>Avatar</td>
                <td>Usuario</td>
                <td>Status</td>
                <td>Puntos</td>
              </thead>
              <tbody>
                @while ($i <= 5)
                    @php
                        $done = false;
                        $u = $user->getUserByPosition($i);
                        //var_dump($u);
                    @endphp
                    @if ($u != null)
                        <tr>
                          <td>
                            <strong># {{ $user->positionRanking($i) }}</strong>
                          </td>
                          <td>
                            <img src="{{ asset('assets/imagenes/'.$u->rutaImagen) }}"
                            width='50' height='50'
                            style="border-color: <?php echo $user->status->color ?>;"
                            class="pic">
                          </td>
                          <td>
                            <a href="{{ url('users/'.$u->slug) }} ">
                              {{ $u->name }}
                            </a>
                          </td>
                          <td>
                              <img src="{{ asset('assets/imagenes/'.$user->status->logo) }}"
                              width='50' height='50'>
                          </td>
                          <td>
                            {{ $u->puntos }}
                          </td>
                        </tr>
                        @php
                            $done = true;
                            $i++;
                        @endphp
                    @endif
                    @php
                        if(!$done) $i++;
                    @endphp
                @endwhile
              </tbody>
          </table>
      </div>
    @elseif($ver == "contact")
          <h3>Contact page</h3>
          <!--div class="row" >-->
          	<div class="offset-md-3 col-md-6" >
          		<div class="card">
          			<div class="card-header text-center">
          				Enviar mensaje
          			</div>
                    <div class="card-body" style="padding:30px">
                          <form action="{{url('/send')}}" method="POST">
                              {{ csrf_field() }}
                              <div class="form-group" id="result">
                                  <label for="nombre">Para ***</label>
                                  <input type="text" name="receptor" id="user"
                                    class="form-control" value="">
                              </div>
                              <div class="form-group">
                                  <label for="nombre">Mensaje ***</label>
                                  <input type="text" name="mensaje" id="mensaje"
                                    class="form-control" value="">
                              </div>
                              <div class="form-group text-center">
          						<button type="submit" class="btn btn-success" style="padding:8px 100px;margin-top:25px;">
          							Enviar
          						</button>
          					</div>
                          </form>
                    </div>
                </div>
            </div>
        <!--</div>-->
        <br><br>
    @endif
  </div>
</div>
</div>
</div>
@endsection
<br>
