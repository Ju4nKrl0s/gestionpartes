@extends('layouts.master')

@section('title')
	
	| Editar Alumno
	
@stop

@section('content')

		<h1>Editar Alumno</h1>
	
		<hr/>
		
		@if(Session::has('message'))
		
			<div style="display:block">
				{{ Session::get('message') }}
			</div>
		
		@endif
		
		{{ Form::open(array('url' => 'admin/alumns/'.$alumn->id, 
							'method' => 'PUT', 
							'files' => true, 
							'class' => 'myForm', 
							'id' => 'myFormId', 
							'role' => 'form')) }}

			<div class="form-group">
			
				{{ Form::label('first_name', 'Nombre', array('class' => 'control-label')) }}
				
				{{ Form::text('first_name', $alumn->first_name, array('placeholder' => 'Nombre')) }}
				
				@if($errors->createalumn->first('first_name'))
					<span class="label label-danger">
						{{ $errors->createalumn->first('first_name') }}
					</span>
				@endif
			
			</div>
			
			<div class="form-group">
			
				{{ Form::label('last_name', 'Apellidos', array('class' => 'control-label')) }}
				
				{{ Form::text('last_name', $alumn->last_name, array('placeholder' => 'Apellidos')) }}
				
				@if($errors->createalumn->first('last_name'))
					<span class="label label-danger">
						{{ $errors->createalumn->first('last_name') }}
					</span>
				@endif
			
			</div>

			<div class="form-group">
			
				{{ Form::label('grade', 'Curso', array('class' => 'control-label')) }}
				
				{{ Form::select('grade', $array_grades, $alumn_grade) }}
				
				@if($errors->createalumn->first('grade'))
					<span class="label label-danger">
						{{ $errors->createalumn->first('grade') }}
					</span>
				@endif
			
			</div>
									
			{{ Form::submit('Actualizar') }}			
			
		{{ Form::close() }}
		
	
	

@stop