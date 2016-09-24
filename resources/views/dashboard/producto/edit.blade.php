@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Actualizar <small>Producto</small>
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
     <form action="{{url('producto/update',array('id'=>$producto->id))}}" method="post" id="producto-actualizar">

		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="{{$producto->nombre}}" class="form-control">

		<label for="unidad">Unidad</label>
		<input type="text" name="unidad" value="{{$producto->unidad}}" class="form-control">

        <label for="costo">Costo</label>
		<input type="text" name="costo" value="{{$producto->costo}}" class="form-control">
		
		<label for="precio">Precio</label>
		<input type="text" name="precio" value="{{$producto->precio}}" class="form-control">
	
		<label for="cantidad">Cantidad</label>
		<input type="text" name="cantidad" value="{{$producto->cantidad}}" class="form-control">
		
		<label >Tipo Producto</label>
		<select name="tipo" class="form-control">
			  @foreach($tipoProductos as $tipoProducto)
			    	@if($tipoProducto->id==$producto->id_tipoProducto)
		                <option selected="" value="{{$tipoProducto->id}}">{{$tipoProducto->nombre}}</option>
		            @else
		            	<option value="{{$tipoProducto->id}}">{{$tipoProducto->nombre}}</option>
		            @endif
			  @endforeach
		</select>

		<label >Proveedor</label>
		<select name="proveedor" class="form-control">
			  @foreach($proveedores as $proveedor)
			    	@if($proveedor->id==$producto->id_proveedor)
		                <option selected="" value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
		            @else
		            	<option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
		            @endif
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