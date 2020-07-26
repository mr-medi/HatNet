@extends('layouts.master')
@section('titulo')
Editando perfil de {{Auth::user()->name}}
@endsection
@section('contenido')
<br><br><br><br>
<a href="{{ url('users') }}/{{ Auth::user()->name }}" class="btn btn-warning">
	Ver mi perfil
</a>
<a href="{{ url('/retos') }}" class="btn btn-primary">Volver al listado</a>
<div class="row">
	<div class="offset-md-3 col-md-6">
		<div class="card">
			<div class="card-header text-center">
				Editar perfil {{ Auth::user()->name }}
			</div>
			<div class="card-body" style="padding:30px">
				<form method="POST" enctype="multipart/form-data"
        action="{{ action('UserController@postEditar') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" name="nombre" id="nombre"
            class="form-control" value="{{ Auth::user()->name }}">
					</div>
					<div class="form-group">
						<input type="file" name="imagen">
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-success" style="padding:8px 100px;margin-top:25px;">
							Modificar perfil
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
