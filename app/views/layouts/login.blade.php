<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-theme.min.css') }}">

    <title>Gesti&oacute;n de Partes
	    
	    @section('title')
	    	
	    	· Login
	    
	    @show
	    
    </title>

  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Gesti&oacute;n de Partes</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Acceso</a></li>
            <li><a href="#about">Registro</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

  	<div class="container" style="padding-top:60px;">
    
      	@yield('content')     
    
    </div> <!-- /container -->

      <!-- Latest compiled and minified JavaScript -->
    <script src="{{ asset('assets/js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	
  </body>
</html>