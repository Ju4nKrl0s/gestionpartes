@extends('layouts.master')

@section('title')
	
	| Nuevo Alumno
	
@stop

@section('content')

		<h1>Nuevo Alumno</h1>
	
		<hr/>
		
		@if(Session::has('message'))
		
			<div style="display:block">
				{{ Session::get('message') }}
			</div>
		
		@endif
		
		{{ Form::open(array('url' => 'admin/alumns', 
							'method' => 'POST', 
							'files' => true, 
							'class' => 'myForm', 
							'id' => 'myFormId', 
							'role' => 'form')) }}

			<div class="form-group">
			
				{{ Form::label('first_name', 'Nombre', array('class' => 'control-label')) }}
				
				{{ Form::text('first_name', '', array('placeholder' => 'Nombre')) }}
				
				@if($errors->createalumn->first('first_name'))
				<span class="label label-danger">
				{{ $errors->createalumn->first('first_name') }}
				</span>
				@endif
			
			</div>
			
			<div class="form-group">
			
				{{ Form::label('last_name', 'Apellidos', array('class' => 'control-label')) }}
				
				{{ Form::text('last_name', '', array('placeholder' => 'Apellidos')) }}
				
				@if($errors->createalumn->first('last_name'))
				<span class="label label-danger">
				{{ $errors->createalumn->first('last_name') }}
				</span>
				@endif
			
			</div>
			
			<div class="form-group">
			
				{{ Form::label('grade', 'Curso', array('class' => 'control-label')) }}
				
				{{ Form::select('grade', $array_grades) }}
				
				@if($errors->createalumn->first('grade'))
					<span class="label label-danger">
						{{ $errors->createalumn->first('grade') }}
					</span>
				@endif
			
			</div>
			
			{{ Form::hidden('action',1) }}
						
			{{ Form::submit('Crear alumno') }}
			
		{{ Form::close() }}

@stop