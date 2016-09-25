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

<!--script para hacer el calculo del subtotal autmoatico-->+
<script type="text/javascript">
function producto(){
    m1=document.getElementById('columna1').value;
    m2=document.getElementById('columna2').value;
    resultado=m1*m2;
    document.getElementById('columna3').value=resultado;
}
    

</script>

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Registrar <small>Compra</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Compra
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


      <div class="form-group">
      <form action="{{url('compra/store')}}" method="post" id="compra-crear" enctype="multipart/form-data">

		<label >Proveedor</label>
		<select name="proveedor" class="form-control" id="lista_proveedores">
			  @foreach($proveedores as $proveedor)
                @if( $proveedor->estado!=2)
			    	<option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>	
                @endif                                            	
			  @endforeach
		</select>
		<a href="{{url('proveedor/create')}}" ><button type="button" class="btn btn-sm btn-primary">Nuevo</button></a>

		<!--Campo para fecha-->
        <div class="form-group">
            <label for="date">Fecha(DD/MM/YY)</label>
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="fecha">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
        </div>


	    <!--Campo para guardar documento-->      
		<div class="form-group">
             	<label>Foto(jpg,jpge,gif)<span class="required">*</span></label>
				<input type="file" name="imagen" class="form-control" accept="image/*">
        </div>


      <label >Factura Compra</label>
      <input type="button" id="agregar" value="Agregar" class="btn btn-sm btn-success"></input>
        <!--tabla-->
        <table id="tabla" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Codigo Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Opcion</th>
                </tr>
            </thead>
         
            <!-- Cuerpo de la tabla con los campos -->
            <tbody>
         
                <!-- fila base para clonar y agregar al final -->
                <tr class="fila-base">
                    <td><input type="text" class="form-control" name="codigos[]"></td>
                    <td><input type="text" class="form-control" id="columna1" name="cantidades[]"></td>
                    <td><input type="text" class="form-control" id="columna2" name="costos[]" ></td>
                    <td class="eliminar"><div class="btn  btn-danger">Eliminar</div></td>
                </tr>
         
            </tbody>
        </table>
        
        <label>Total</label>
        <input type="text" name="total" class="form-control"></input>
        <input type="button" id="total" value="Calcular Total" class="btn btn-info"></input>
		<center><input type="submit" value="Guardar compra" class="btn btn-success" id="guardar_compra"></center>
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
        $("#tabla")
        .append("<tr><td></select><input type='text' class='form-control' name='codigos[]' ></input></td> <td></select><input type='text' class='form-control' id='columna1' name='cantidades[]' ></input></td> <td></select><input type='text' class='form-control' id='columna2' name='costos[]' ></input></td>  <td class='eliminar'><div class='btn  btn-danger'>Eliminar</div></td><tr>")
    });
 
    // Evento que selecciona la fila y la elimina 
    $(document).on("click",".eliminar",function(){
        var parent = $(this).parents().get(0);
        $(parent).remove();
    });

});


</script>

@endsection


