@extends('layouts.master')

@section('title')

	| Administraci&oacute;n de Cursos

@stop

@section('content')

	<h1>Administraci&oacute;n de Cursos</h1>

	<a class="btn btn-primary" href="{{ URL::to('admin/grades/create') }}">Nuevo curso</a>

	@if(Session::has('message'))
		
		<div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	
	@endif

	<h3>Listado de cursos</h3>

	<table class="table table-striped">
		<thead>
	    	<tr>
				<th>Nombre</th>
				<th>Fecha Alta</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($grades as $key => $grade)
				<tr>
					<td>{{ ucfirst($grade->name) }}</td>
					<td>{{ date("d-m-Y",strtotime($grade->created_at)) }}</td>
					<td>
						<a href="#" class="btn btn-info">Ver</a>
						<a href="{{ URL::to("admin/grades/$grade->id/edit") }}" class="btn btn-success">Editar</a>
						{{ Form::open(array('url' => 'admin/grades/'.$grade->id,'method' => 'DELETE')) }}
			          		<button class="btn btn-danger" onclick="return confirm('¿Estas seguro?');">Borrar</button>
			          	{{ Form::close() }}		          		
			        </td>
				</tr>
			@endforeach
		</tbody>
	</table>

@stop