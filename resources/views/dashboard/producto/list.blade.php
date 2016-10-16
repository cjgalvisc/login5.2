@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Productos</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Producto
                            </li>
                        </ol>
<!--mensaje de confirmacion -->
@if(Session::has('exito'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('exito')}}
	</div>
@endif

<form action="{{url('producto/search')}}" method="post" >
    <LABEL>Codigo:</LABEL>
    <input type="text" name="codigo" ></input>
    <input type="submit" value="Buscar" class="btn btn-sm btn-primary"> 
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>

<br>
<LABEL>Ordenar por:</LABEL>
<br>
<a href="{{url('producto/ordenarNombre')}}"  ><button type="button" class="btn btn-sm btn-primary">Nombre</button></a>
<a href="{{url('producto/ordenarPrecio')}}"  ><button type="button" class="btn btn-sm btn-primary">Precio</button></a>
<a href="{{url('producto/ordenarCantidad')}}"  ><button type="button" class="btn btn-sm btn-primary">Cantidad</button></a>
    @if(count($productos)==0)
		<h1> No hay Productos Registrados</h1>
	@else
		<table class="table table-striped">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Proveedor</th>
                <th>Unidad</th>
                <th>Costo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
	              <tr>
                    <td>{{$producto->id}}</td>
	                <td>{{$producto->nombre}}</td>
                    @foreach($tipoProductos as $tipoProducto)
                        @if($tipoProducto->id==$producto->id_tipoProducto)
                            <td>{{$tipoProducto->nombre}}</td>
                        @endif
                    @endforeach

                    @foreach($proveedores as $proveedor)
                        @if($proveedor->id==$producto->id_proveedor)
                            <td>{{$proveedor->empresa}}</td>
                        @endif
                    @endforeach
	                <td>{{$producto->unidad}}</td>
	                <td>{{$producto->costo}}</td>
	                <td>{{$producto->precio}}</td>
	                <td>{{$producto->cantidad}}</td>
	                <td>
                        <a href="{{url('producto/edit',array('id'=>$producto->id))}}" ><button type="button" class="btn btn-sm btn-success">editar</button></a>
                        <a href="{{url('producto/delete',array('id'=>$producto->id))}}" ><button type="button" class="btn btn-sm btn-danger">eliminar</button></a>
	                </td>
	              </tr>
            @endforeach
            </tbody>
         </table>
	@endif
                    </div>
                </div>
             </div>

@endsection