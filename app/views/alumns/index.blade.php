@extends('layouts.master')

@section('title')

	| Administraci&oacute;n de Alumnos

@stop

@section('content')

	<h1>Administraci&oacute;n de Alumnos</h1>

	<a class="btn btn-primary" href="{{ URL::to('admin/alumns/create') }}">Nuevo alumno</a>

	@if(Session::has('message'))
		
		<div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	
	@endif

	<h3>Listado de alumnos</h3>

	<table class="table table-striped">
		<thead>
	    	<tr>
	    		<th>ID</th>
				<th>Nombre y Apellidos</th>
				<th>Curso</th>
				<th>Fecha Alta</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($alumns as $key => $alumn)
				<tr>
					<td>{{ $alumn->id }}</td>
					<td>{{ ucfirst($alumn->first_name) }} {{ $alumn->last_name}}</td>
					<td>{{ $alumn->grade_id }}</td>
					<td>{{ date("d-m-Y",strtotime($alumn->created_at)) }}</td>
					<td>
						<a href="#" class="btn btn-info">Ver</a>
						<a href="{{ URL::to("admin/alumns/$alumn->id/edit") }}" class="btn btn-success">Editar</a>
						{{ Form::open(array('url' => 'admin/alumns/'.$alumn->id,'method' => 'DELETE')) }}
			          		<button class="btn btn-danger" onclick="return confirm('¿Estas seguro?');">Borrar</button>
			          	{{ Form::close() }}		          		
			        </td>
				</tr>
			@endforeach
		</tbody>
	</table>

@stop