@extends('layouts.master')

@section('title')
	
	Registro Cursos
	
@stop

@section('content')

		<h1>Registro Cursos</h1>
	
		<hr/>
		
		@if(Session::has('message'))
		
			<div style="display:block">
				{{ Session::get('message') }}
			</div>
		
		@endif
		
		{{ Form::open(array('url' => 'admin/grades', 
							'method' => 'POST', 
							'files' => true, 
							'class' => 'myForm', 
							'id' => 'myFormId', 
							'role' => 'form')) }}
			
			<div class="form-group">
			
				{{ Form::label('name', 'Nombre', array('class' => 'control-label')) }}
				
				{{ Form::text('name', '', array('placeholder' => 'Nombre')) }}
				
				@if($errors->creategrade->first('name'))
					<span class="label label-danger">
						{{ $errors->creategrade->first('name') }}
					</span>
				@endif
			
			</div>
			
			{{ Form::submit('Crear curso') }}			
			
		{{ Form::close() }}
		
@stop