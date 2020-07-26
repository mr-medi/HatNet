@extends('layouts.master')
@section('titulo')
Crear
@endsection
@section('contenido')
    <br>
    <br>
    <br>
    <span>
        <a href="{{url('/')}}">
            Inicio
        </a>
       <a href="{{url('herramientas')}}" style="margin:15px;">
           Herramientas
       </a>
       <a href="{{url('herramientas/crear')}}" style="margin:15px;">
           Crear
       </a>
    </span>
  <div class="row">
  	<div class="offset-md-3 col-md-6">
  		<div class="card">
  			<div class="card-header text-center">
  				Añadir Herramienta
  			</div>
  			<div class="card-body" style="padding:30px">
          <!--FORMULARIO-->
  				<form method="POST" action="{{ url('herramientas/crear') }}" enctype="multipart/form-data">
  					{{ csrf_field() }}
                    <!--nombre-->
  			          <div class="form-group">
  						<label>Nombre</label>
  						<input type="text" name="nombre" class="form-control">
  					</div>
                    <!--LOGO TOOL-->
          			<div class="form-group">
          				<label>Logo</label>
          				<input type="file" name="logo"
                        class="form-control">
          			</div>
                    <!--categoria-->
  					<div class="form-group">
              <label>Categoria</label>
              @inject('c', 'App\Categoria')
  			  <select name="categoria" class="form-control">
                @foreach ($c::all() as $categoria)
                    <option value="{{ $categoria->id }}">
                      {{ $categoria->categoria }}
                    </option>
                @endforeach
            </select>
  			</div>
            <!--descripcion herramienta-->
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<textarea name="descripcion" class="form-control" rows="3">
				</textarea>
			</div>
            <!--ficheros Herramienta-->
			<div class="form-group">
                <label>Ficheros</label>
				<input type="file" name="proyecto[]" class="form-control" multiple>
			</div>
			<div class="form-group text-center">
				<button type="submit" class="btn btn-success" style="padding:8px 100px;margin-top:25px;">
					Añadir Herramienta
				</button>
			</div>
  		</form>
  	</div>
  </div>
 </div>
</div>
@endsection
