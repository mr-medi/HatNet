@extends('layouts.master')
@section('titulo')
Crear
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
        <a href="{{url('/retos/crear')}}"
            style="margin:15px;">
            Crear reto
        </a>
    </span><br><br>
  <div class="row">
  	<div class="offset-md-3 col-md-6">
  		<div class="card">
  			<div class="card-header text-center">
  				Añadir Reto
  			</div>
  			<div class="card-body" style="padding:30px">
          <!--FORMULARIO-->
  				<form method="POST" action="{{ url('retos/crear') }}" enctype="multipart/form-data">
  					{{ csrf_field() }}
            <!--nombre-->
  					<div class="form-group">
  						<label>Nombre</label>
  						<input type="text" name="nombre" class="form-control">
  					</div>
            <!--categoria-->
  					<div class="form-group">
              <label>Categoria</label>
              @inject('c', 'App\Categoria')
  			  <select name="categoria" class="form-control">
                @foreach ($c::all() as $categoria)
                {
                    <option value="{{ $categoria->categoria }}">
                      {{ $categoria->categoria }}
                    </option>
                }
                @endforeach
              </select>
  					</div>
            <!--puntos por resolver el reto-->
            <div class="form-group">
              <label>Puntos a obtener por resolver el reto</label>
              <input type="text" name="puntos" class="form-control">
            </div>
            <!--clave validacion reto, tambien llamado FLAG-->
            <div class="form-group">
              <label for="clave">Clave</label>
              <input type="text" name="clave" class="form-control">
            </div>
            <!--descripcion reto-->
  					<div class="form-group">
  						<label for="descripcion">Descripcion</label>
  						<textarea name="descripcion" class="form-control" rows="3">
  						</textarea>
  					</div>
            <!--ficheros reto-->
  					<div class="form-group">
              <label>Ficheros</label>
  						<input type="file" name="proyecto" class="form-control">
  					</div>
  					<div class="form-group text-center">
  						<button type="submit" class="btn btn-success" style="padding:8px 100px;margin-top:25px;">
  							Añadir Reto
  						</button>
  					</div>
  			</form>
  			</div>
  		</div>
  	</div>
  </div>
@endsection
