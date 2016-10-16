@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Tipo productos</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Tipo Producto
                            </li>
                        </ol>
<!--mensaje de confirmacion -->
@if(Session::has('exito'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('exito')}}
	</div>
@endif
<form action="{{url('tipoProducto/search')}}" method="post" >
    <LABEL>Codigo:</LABEL>
    <input type="text" name="codigo" ></input>
    <input type="submit" value="Buscar" class="btn btn-sm btn-primary"> 
    <input type="hidden" name="_token" value="{{csrf_token()}}">
</form>
<br>
<a href="{{url('tipoProducto/ordenar')}}"  ><button type="button" class="btn btn-sm btn-primary">Ordenar</button></a>
    @if(count($tipoProductos)==0)
		<h1> No hay Tipos de Productos Registrados</h1>
	@else
		<table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach($tipoProductos as $tipoProducto)
	              <tr>
	                <td>{{$tipoProducto->id}}</td>
	                <td>{{$tipoProducto->nombre}}</td>
	                <td>
                        <a href="{{url('tipoProducto/edit',array('id'=>$tipoProducto->id))}}" ><button type="button" class="btn btn-sm btn-success">editar</button></a>
                        <a href="{{url('tipoProducto/delete',array('id'=>$tipoProducto->id))}}" ><button type="button" class="btn btn-sm btn-danger">eliminar</button></a>
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