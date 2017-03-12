@extends('layouts.master')

@section('title')
	
	Editar Curso
	
@stop

@section('content')

		<h1>Editar Curso</h1>
	
		<hr/>
		
		@if(Session::has('message'))
		
			<div style="display:block">
				{{ Session::get('message') }}
			</div>
		
		@endif
		
		{{ Form::open(array('url' => 'admin/grades/'.$grade->id, 
							'method' => 'PUT', 
							'files' => true, 
							'class' => 'myForm', 
							'id' => 'myFormId', 
							'role' => 'form')) }}
			
			<div class="form-group">
			
				{{ Form::label('name', 'Nombre', array('class' => 'control-label')) }}
				
				{{ Form::text('name', $grade->name, array('placeholder' => 'Nombre')) }}
				
				@if($errors->creategrade->first('name'))
					<span class="label label-danger">
						{{ $errors->creategrade->first('name') }}
					</span>
				@endif
			
			</div>
			
			{{ Form::submit('Editar curso') }}			
			
		{{ Form::close() }}
		
@stop