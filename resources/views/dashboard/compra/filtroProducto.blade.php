@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Facturas por Producto</small>
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

    
    @if(count($resultados)==0)
		<h1> No hay Facturas del producto {{$producto->nombre}}</h1>
	@else
        <h1> Facturas del producto {{$producto->nombre}}</h1>
		<table class="table table-striped ">
            <thead>
              <tr>
                <th>Codigo Factura</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($resultados as $resultado) 
                @if($resultado->estado!= 2)
                    <tr>
                        <td>{{$resultado->id_facturaCompra}}</td>
                        <td>{{$resultado->fecha}}</td>
                        <td>{{$resultado->cantidad}}</td>
                        <td>$ {{$resultado->costoUnitario}}</td>
                        <td>$ {{$resultado->subtotal}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
         </table>
	@endif
                    </div>
                </div>
             </div>
             <a href="{{url('compra/reporteProducto',array('producto'=>$producto->id))}}" ><button type="button" class="btn btn-sm btn-info">Descargar Pdf</button></a>
             <!--<a href="{{url('compra/list')}}" ><button type="button" class="btn btn-sm btn-primary">LISTAR COMPRAS</button></a>
             <a href="{{url('menu')}}" ><button type="button" class="btn btn-sm btn-primary">MENU</button></a>-->

@endsection