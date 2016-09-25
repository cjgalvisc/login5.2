@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Registrar <small>Producto</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Producto
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
     <form action="{{url('producto/store')}}" method="post" id="producto-crear">

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" class="form-control">

		<label for="unidad">Unidad</label>
		<input type="text" name="unidad" class="form-control">

        <label for="costo">Costo</label>
		<input type="text" name="costo" class="form-control">
		
		<label for="precio">Precio</label>
		<input type="text" name="precio" class="form-control">
	
		<label for="cantidad">Cantidad</label>
		<input type="text" name="cantidad" class="form-control">

		<label >Tipo Producto</label>
		<select name="tipo" class="form-control">
			  @foreach($tipoProductos as $tipoProducto)
			  	@if($tipoProducto->estado!=2)
			    	<option value="{{$tipoProducto->id}}">{{$tipoProducto->nombre}}</option>
			    @endif
			  @endforeach
		</select>

		<label >Proveedor</label>
		<select name="proveedor" class="form-control">
			  @foreach($proveedores as $proveedor)
			    	<option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
			  @endforeach
		</select>
	
		<center><input type="submit" value="Guardar Producto" class="btn btn-primary" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>


@endsection