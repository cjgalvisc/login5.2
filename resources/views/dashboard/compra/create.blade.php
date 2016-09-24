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
                            Registrar <small>Empleado</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Empleado
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
<script type="text/javascript">

$(document).ready(function(){
    $(".textos").click(function(){
        $("#capa").val($(this).val());
    });
});
 
</script>

      <div class="form-group">
      <form action="{{url('compra/store')}}" method="post" id="compra-crear">

		<label >Proveedor</label>
		<select name="proveedor" class="form-control" id="lista_proveedores">
			  @foreach($proveedores as $proveedor)
			    	<option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>		
			  @endforeach
		</select>
		<a href="{{url('proveedor/create')}}" ><button type="button" class="btn btn-sm btn-success">Nuevo</button></a>

		<!--Campo para fecha-->
        <div class="form-group">
            <label for="date">Fecha</label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="fecha">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>


	    <!--Campo para guardar documento-->      
		<div class="form-group">
             	<label>Foto<span class="required">*</span></label>
				<input type="file" name="documento" class="form-control">
        </div>


        <label >Factura Compra</label>
      <input type="button" id="agregar" value="Agregar" class="btn btn-success"></input>
        <!--tabla-->
        <table id="tabla" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Opcion</th>
                </tr>
            </thead>
         
            <!-- Cuerpo de la tabla con los campos -->
            <tbody>
         
                <!-- fila base para clonar y agregar al final -->
                <tr class="fila-base">
                    <td><input type="text" class="form-control" name="codigos[]"></td>
                    <td><input type="text" class="form-control" name="cantidades[]"></td>
                    <td><input type="text" class="form-control" name="subtotales[]"></td>
                    <td class="eliminar"><div class="btn  btn-danger">Eliminar</div></td>
                </tr>
         
            </tbody>
        </table>
        
        <label>Total</label>
        <input type="text" name="total" class="form-control"></input>
        <input type="button" id="total" value="Calcular Total" class="btn btn-success"></input>
		<center><input type="submit" value="Guardar compra" class="btn btn-primary" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>


<!--JavaScript para controlar el formato de las fechas de los datePicker-->
<script>
   $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });
</script>

<!--script pra controlar los eventos de la tabla dinamica de compra-->
<script type="text/javascript">

$(function(){
    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#agregar").on('click', function(){
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla tbody");
    });
 
    // Evento que selecciona la fila y la elimina 
    $(document).on("click",".eliminar",function(){
        var parent = $(this).parents().get(0);
        $(parent).remove();
    });

    /*$(".texto").on('click', function(){
        $("#capa").val($(this).val());
    });*/
 
});


</script>


@endsection


