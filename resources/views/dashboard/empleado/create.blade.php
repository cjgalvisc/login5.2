@extends('dashboard.index')
<!--Links para el control del DatePicker-->
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>


@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Registrar <small>Empleado</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Empleado
                            </li>
                        </ol>
<!--mensaje de error-->
@if(Session::has('errors'))
	<div class="alert alert-warning alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <ul>
	  	@foreach($errors->all() as $error)
			<li>{{$error}}</li>
	  	@endforeach
	  </ul>
	</div>
@endif

      <div class="form-group">
      <form action="{{url('empleado/store')}}" method="post" id="empleado-crear">
		<label for="cedula">cedula</label>
		<input type="text" name="cedula" class="form-control">
		
		<label for="name">Nombre</label>
		<input type="text" name="name" class="form-control">

		<label for="apellido">Apellidos</label>
		<input type="text" name="apellidos" class="form-control">

		<label for="fechaNacimiento">Fecha Nacimiento</label>
	    <div class="content">
	        <div class="panel panel-default">
				<div class="panel-body">
	                <div class="col-md-4 col-md-offset-4">
	                        <div class="form-group">
	                            <label for="date">Fecha</label>
	                            <div class="input-group">
	                                <input type="text" class="form-control datepicker" name="fechaNacimiento">
	                                <div class="input-group-addon">
	                                    <span class="glyphicon glyphicon-th"></span>
	                                </div>
	                            </div>
	                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	            

		<label for="email">Correo</label>
		<input type="text" name="email" class="form-control">

		<label for="password">Contraseña</label>
		<input type="password" name="password" class="form-control">

		<label for="direccion">Direccion</label>
		<input type="text" name="direccion" class="form-control">

        <label for="telefono">Telefono</label>
		<input type="text" name="telefono" class="form-control">
		<!--imprimo los roles que los traiogo en el vector $roles-->
		<label >Rol</label>
		<select name="rol" class="form-control">
			  @foreach($roles as $rol)
			    @if($rol->id!= 1)
			    	<option value="{{$rol->id}}">{{$rol->nombre}}</option>
			    @endif
			  @endforeach
		</select>

		<label for="fechaIngreso">fechaIngreso</label>
		<div class="content">
	        <div class="panel panel-default">
				<div class="panel-body">
	                <div class="col-md-4 col-md-offset-4">
	                        <div class="form-group">
	                            <label for="date">Fecha</label>
	                            <div class="input-group">
	                                <input type="text" class="form-control datepicker" name="fechaIngreso">
	                                <div class="input-group-addon">
	                                    <span class="glyphicon glyphicon-th"></span>
	                                </div>
	                            </div>
	                        </div>
	                </div>
	            </div>
	        </div>
	    </div>

		<center><input type="submit" value="Guardar empleado" class="btn btn-primary" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>


<!--JavaScript para controlar el formato de las fechas de los datePicker-->
<script>
   $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>

@endsection