@extends('layouts.master')

@section('title')

	| Administraci&oacute;n de Usuarios

@stop

@section('content')

	<h1>Administraci&oacute;n de Usuarios</h1>

	<a class="btn btn-primary" href="{{ URL::to('admin/users/create') }}">Nuevo usuario</a>

	@if(Session::has('message'))
		
		<div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	
	@endif

	<h3>Listado de usuarios</h3>

	<table class="table table-striped">
		<thead>
	    	<tr>
				<th>Nombre y Apellidos</th>
				<th>Email</th>
				<th>Fecha Alta</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $key => $user)
				<tr>
					<td>
						{{ ucfirst($user->first_name) }} {{ $user->last_name}}
						@if($user->inGroup($admin))
							<span class="label label-warning">{{ 'Admin' }}</span>
						@endif
					</td>
					<td>{{ $user->email }}</td>
					<td>{{ date("d-m-Y",strtotime($user->created_at)) }}</td>
					<td>
						<a href="#" class="btn btn-info">Ver</a>
						<a href="{{ URL::to("admin/users/$user->id/edit") }}" class="btn btn-success">Editar</a>
						@if($current_user->id != $user->id)
			          		{{ Form::open(array('url' => 'admin/users/'.$user->id,'method' => 'DELETE')) }}
			          			<button class="btn btn-danger" onclick="return confirm('¿Estas seguro?');">Borrar</button>
			          		{{ Form::close() }}		          		
			          	@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@stop