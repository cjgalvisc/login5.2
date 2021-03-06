@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Facturas por Proveedor</small>
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
		<h1> No hay Facturas del proveedor {{$proveedor->empresa}}</h1>
	@else
        <h1> Facturas del proveedor {{$proveedor->empresa}}</h1>
		<table class="table table-striped ">
            <thead>
              <tr>
                <th>Codigo</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody>
            <?php $total=0; ?>
            @foreach($resultados as $resultado)
	              <tr>
	                <td>{{$resultado->id}}</td>
	                <td>{{$resultado->fecha}}</td>
	                <td>$ {{$resultado->total}}</td>
	                <td><a class="btn btn-sm btn-success" href="/facturas/<?php echo $resultado->foto; ?>" target="blank" >VER</a> </td>
	              </tr>
                <?php $total=$total+$resultado->total; ?>   
            @endforeach
            </tbody>
         </table>
 <label><h1>Total: $<?php echo number_format($total); ?> </h1></label>
	@endif
  
                    </div>
                </div>
             </div>
             <a href="{{url('compra/reporteProveedor',array('proveedor'=>$proveedor->id))}}" ><button type="button" class="btn btn-sm btn-info">Descargar Pdf</button></a>
             <!--<a href="{{url('compra/list')}}" ><button type="button" class="btn btn-sm btn-primary">LISTAR COMPRAS</button></a>-->
             <!--<a href="{{url('menu')}}" ><button type="button" class="btn btn-sm btn-primary">MENU</button></a>-->

@endsection