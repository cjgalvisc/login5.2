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

@if(Session::has('error'))
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{Session::get('error')}}
    </div>
@endif


      <div class="form-group">
      <form action="{{url('compra/store')}}" method="post" id="compra-crear" enctype="multipart/form-data">

		<label >Proveedor</label>
		<select name="proveedor" class="form-control" id="lista_proveedores">
			  @foreach($proveedores as $proveedor)
			    	<option value="{{$proveedor->id}}">{{$proveedor->empresa}}</option>	                                         	
			  @endforeach
		</select>
		<a href="{{url('proveedor/create')}}" ><button type="button" class="btn btn-sm btn-primary">Nuevo</button></a>

		<!--Campo para fecha-->
        <div class="form-group">
            <label for="date">Fecha(año/mes/dia)</label>
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
                    <th>Subtotal</th>
                    <th>Opcion</th>
                </tr>
            </thead>
         
            <!-- Cuerpo de la tabla con los campos -->
            <tbody>
         
                <!-- fila base para clonar y agregar al final -->
                <tr class="fila-base">
                    <td><input type="text" class="form-control" name="codigos[]" pattern="[0-9]{1,}" ></td>
                    <td><input type="text" class="form-control" id="cantidad-0" name="cantidades[]"  onchange="calcular_total('0')" value="0"  pattern="[0-9]{1,}" title="Este numero debe ser un entero"></td>
                    <td><input type="text" class="form-control" id="costo-0" name="costos[]"  onchange="calcular_total('0')" value="0" pattern="[0-9.]{1,}" title="Este valor debe ser un numero entero o decimal "></td>
                    <td><input type="text" class="form-control-static" id="total-0" name="subtotales[]"  value="0" readonly></td>
                    <td class="eliminar"><div class="btn  btn-danger">Eliminar</div></td>
                </tr>
         
            </tbody>
        </table>
        
        <label>Total</label>
        <input type="text" name="total" id="totales" value="0" class="form-control" readonly />
        <!--<input type="button" id="btotal" value="Calcular Total" class="btn btn-info" onclick="alerta()" />-->
		<center><input type="submit" value="Guardar compra" class="btn btn-success" id="guardar_compra" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>


<!--JavaScript para controlar el formato de las fechas de los datePicker-->

<script>
   $('.datepicker').datepicker({
        format: "yyyy/mm/dd",
        language: "es",
        autoclose: true
    });
</script>

<script>

//var x= $("#lineas div").length + 1;
var x=document.getElementById("tabla").rows.length-1;

function calcular_total(i) {
    importe_total = 0
    a=0;
    b=0;
    var cantidad="#cantidad-".concat(i);
    //alert(cantidad);
    $(cantidad).each(
        function(index, value) {
            a =  eval($(this).val());
        }
    );
    var costo="#costo-".concat(i);
    $(costo).each(
        function(index, value) {
            b =  eval($(this).val());
        }
    );
    var total="#total-".concat(i);
    importe_total=a*b;
    $(total).val(importe_total);
    alerta();
}


</script>

<script type="text/javascript">

function alerta(){
    
    importe_total = 0
    $(".form-control-static").each(
        function(index, value) {
            importe_total = importe_total + eval($(this).val());
        }
    );
    $("#totales").val(importe_total);

}


</script>
<!--script pra controlar los eventos de la tabla dinamica de compra-->
<script type="text/javascript">

$(function(){
    // Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
    $("#agregar").on('click', function(){
        //alert(x);
        var FieldCount = x-1; //para el seguimiento de los campos
        FieldCount++;
        $("#tabla")
        .append("<tr><td></select><input type='text' class='form-control' name='codigos[]' pattern='[0-9]{1,}' /></td>"+
            "<td></select><input type='text' class='form-control' id='cantidad-"+FieldCount+"' name='cantidades[]'  onchange='calcular_total("+ FieldCount +")' value='0' pattern='[0-9]{1,}'' title='Este numero debe ser un entero'/></td>"+
            " <td></select><input type='text' class='form-control' id='costo-"+FieldCount+"' name='costos[]'  onchange='calcular_total("+ FieldCount +")' value='0' pattern='[0-9.]{1,}'' title='Este valor debe ser un numero entero o decimal '/></td>"+
            " <td><input type='text' class='form-control-static' id='total-"+FieldCount+"' name='subtotales[]'  value='0' readonly/></td> "+
            "<td class='eliminar'><div class='btn  btn-danger'>Eliminar</div></td></tr>")
        x++;
    });
 
    // Evento que selecciona la fila y la elimina 
    $(document).on("click",".eliminar",function(){
        var parent = $(this).parents().get(0);
        $(parent).remove();
    });

});



</script>

@endsection


