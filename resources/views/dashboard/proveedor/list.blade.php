@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Proveedores</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Proveedor
                            </li>
                        </ol>
<!--mensaje de confirmacion -->
@if(Session::has('exito'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('exito')}}
	</div>
@endif

    @if(count($proveedores)==0)
		<h1> No hay Proveedores Registrados</h1>
	@else
		<table class="table table-striped">
            <thead>
              <tr>
                <th>Nit</th>
                <th>Empresa</th>
                <th>Vendedor</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach($proveedores as $proveedor)
	              <tr>
	                <td>{{$proveedor->nit}}</td>
	                <td>{{$proveedor->empresa}}</td>
	                <td>{{$proveedor->cedula}}</td>
	                <td>{{$proveedor->nombre}}</td>
	                <td>{{$proveedor->apellido}}</td>
	                <td>{{$proveedor->telefono}}</td>
	                <td>
                        <a href="{{url('proveedor/edit',array('id'=>$proveedor->id))}}"  ><button type="button" class="btn btn-sm btn-success">editar</button></a>
                        <a href="{{url('proveedor/delete',array('id'=>$proveedor->id))}}" ><button type="button" class="btn btn-sm btn-danger">eliminar</button></a>
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