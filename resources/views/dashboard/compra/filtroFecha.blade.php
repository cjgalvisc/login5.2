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
		<h1> No hay Facturas de la fecha {{$pivote}}</h1>
	@else
        <h1> Facturas de la fecha {{$pivote}}</h1>
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
            @foreach($resultados as $resultado)
                @if($resultado->estado!=2)
	              <tr>
	                <td>{{$resultado->id}}</td>
	                <td>{{$resultado->fecha}}</td>
	                <td>{{$resultado->total}}</td>
	                <td><a class="btn btn-sm btn-success" href="/facturas/<?php echo $resultado->foto; ?>" target="blank" >VER</a> </td>
	              </tr>
                @endif
            @endforeach
            </tbody>
         </table>
	@endif
                    </div>
                </div>
             </div>

@endsection