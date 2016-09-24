@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Registrar <small>Proveedor</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Proveedor
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
     <form action="{{url('proveedor/store')}}" method="post" id="proveedor-crear">
		<label for="cedula">Cedula</label>
		<input type="text" name="cedula" class="form-control">
		
		<label for="name">Nombre</label>
		<input type="text" name="nombre" class="form-control">

		<label for="apellido">Apellidos</label>
		<input type="text" name="apellido" class="form-control">

        <label for="telefono">Telefono</label>
		<input type="text" name="telefono" class="form-control">
		
		<label for="Empresa">Empresa</label>
		<input type="text" name="empresa" class="form-control">
	
		<label for="Nit">Nit</label>
		<input type="text" name="nit" class="form-control">
	
		<center><input type="submit" value="Guardar Proveedor" class="btn btn-primary" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>


@endsection