@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Listar <small>Empleados</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Empleado
                            </li>
                        </ol>
<!--mensaje de confirmacion -->
@if(Session::has('exito'))
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  {{Session::get('exito')}}
	</div>
@endif

    @if(count($empleados)==1)
		<h1> No hay empleados Registrados</h1>
	@else
		<table class="table table-striped">
            <thead>
              <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Nacimiento</th>
                <th>Correo</th>
                <th>Dirrecion</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Fecha Ingreso</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
            @foreach($empleados as $empleado)
	            @if($empleado->rol!=1 && $empleado->estado!=2)
	              <tr>
	                <td>{{$empleado->cedula}}</td>
	                <td>{{$empleado->name}}</td>
	                <td>{{$empleado->apellidos}}</td>
	                <td>{{$empleado->fechaNacimiento}}</td>
	                <td>{{$empleado->email}}</td>
	                <td>{{$empleado->direccion}}</td>
	                <td>{{$empleado->telefono}}</td>
                    @foreach($roles as $rol)
                        @if($rol->id==$empleado->rol)
                            <td>{{$rol->nombre}}</td>
                        @endif
                    @endforeach
	                <td>{{$empleado->fechaIngreso}}</td>
	                <td>
                        <a href="{{url('empleado/edit',array('id'=>$empleado->id))}}" ><button type="button" class="btn btn-sm btn-success">editar</button></a>
                        <a href="{{url('empleado/delete',array('id'=>$empleado->id))}}" ><button type="button" class="btn btn-sm btn-danger">eliminar</button></a>
	                </td>
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