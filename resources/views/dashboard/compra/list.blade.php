@extends('dashboard.index')
<!--Links para el control del DatePicker-->
<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Datepicker Files -->
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-standalone.css')}}">
    <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
    <!-- Languaje -->
    <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>

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
        <label for="date">Fecha</label>
        <div class="input-group">
            <input type="text" class="form-control datepicker" name="fecha">
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <label class="radio-inline">
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="MenorIgual") echo "checked";?> value="MenorIgual">MenorIgual
        </label>
        <label class="radio-inline">
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="MayorIgual") echo "checked";?> value="MayorIgual">MayorIgual
        </label>
        <label class="radio-inline">
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Igual") echo "checked";?> value="Igual">Igual
        </label>
        <div>
            <input type="submit" class="btn btn-sm btn-success" align="center" value="Filtrar"></input>       
        </div>
        
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
		<h1> No hay Facturas Registradas</h1>
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

    <a href="{{url('compra/reporte')}}" ><button type="button" class="btn btn-sm btn-primary">Descargar Pdf</button></a>
    
             <a href="{{url('menu')}}" ><button type="button" class="btn btn-sm btn-primary">MENU</button></a>
    
<script>
   $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>

@endsection