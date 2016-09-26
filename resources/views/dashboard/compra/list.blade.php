@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Facturas</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Compras
                            </li>
                        </ol>
<!--mensaje de confirmacion -->
@if(Session::has('exito'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('exito')}}
	</div>
@endif

    <form action="{{url('compra/filtroProveedor')}}" class="form-group" method="get">
        <label>Proveedor</label>
        <select class="form-control" name="proveedor">
            @foreach($proveedores as $proveedor)
                <option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-sm btn-success"  value="Filtrar"></input>
    </form>

    <form class="form-group" action="{{url('compra/filtroFecha')}}" method="GET" >
        <label>Fecha</label>
        <input type="date" name="fecha" class="form-control" ></input>
        <input type="submit" class="btn btn-sm btn-success" align="center" value="Filtrar"></input>
    </form>
    
    <form class="form-group" action="{{url('compra/filtroProducto')}}" method="GET" >
        <label>Producto</label>
        <select class="form-control" name="producto">
            @foreach($productos as $producto)
                <option value="{{$producto->id}}">{{$producto->nombre}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-sm btn-success" align="center" value="filtrar"></input>
    </form>

    @if(count($facturas)==0)
		<h1> No hay Facturas Registrados</h1>
	@else
		<table class="table table-striped ">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Foto</th>
                <th>Proveedor</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach($facturas as $factura)
	              <tr>
	                <td>{{$factura->id}}</td>
	                <td>{{$factura->fecha}}</td>
	                <td>{{$factura->total}}</td>
	                <td><a class="btn btn-sm btn-success" href="/facturas/<?php echo $factura->foto; ?>" target="blank" >VER</a> </td>

                    @foreach($proveedores as $proveedor)
                        @if($proveedor->id==$factura->id_proveedor)
                            <td>{{$proveedor->empresa}}</td>
                        @endif
                    @endforeach
	                <td>
                        <a href="{{url('compra/edit',array('id'=>$factura->id))}}"  ><button type="button" class="btn btn-sm btn-success">editar</button></a>
                        <a href="{{url('compra/delete',array('id'=>$factura->id))}}" ><button type="button" class="btn btn-sm btn-danger">eliminar</button></a>
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