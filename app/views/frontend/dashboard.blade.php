@extends('layouts.master')

@section('title')

	| Administracion

@stop

@section('content')

	<div class="jumbotron">
		<h1>Admin Page</h1>
		<p>This page is for admins only!</p>

		<a class="btn btn-primary" href="{{ URL::to('/admin/users/index') }}">Usuarios</a>
		<a class="btn btn-primary" href="{{ URL::to('/admin/grades/index') }}">Cursos</a>
		<a class="btn btn-primary" href="{{ URL::to('/admin/alumns/index') }}">Alumnos</a>
	</div>
	

@stop