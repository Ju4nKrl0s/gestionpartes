@extends('layouts.login')

@section('title')

	| Login

@stop

@section('content')

	<h1>Login Usuarios</h1>

	@if(Session::has('message'))

		<div style)"display:block">
			{{ Session::get('message') }}
		</div>

	@endif

	{{ Form::open(array('url' => 'login',
						'method' => 'POST',
						'files' => false,
						'class' => 'myForm',
						'role' => 'form')) }}

		<div class="form-group">

			{{ Form::label('email', 'Email', array('class' => 'control-label')) }}
			{{ Form::text('email', '', array()) }}



		</div>

		<div class="form-group">

			{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
			{{ Form::password('password', '',array()) }}

			

		</div>

		{{ Form::submit('Login') }}

	{{ Form::close() }}

@stop