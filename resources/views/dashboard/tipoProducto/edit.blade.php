@extends('dashboard.index')

@section('contenido')
<!-- Page Heading -->
<div id="page-wrapper">
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Editar <small>Tipo Producto</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Tipo Producto
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
      <form action="{{url('tipoProducto/update',array('id'=>$tipoProducto->id))}}" method="post" id="tipoProducto-actualizar">

		<label for="nombre">Nombre</label>
		<input type="text" value="{{$tipoProducto->nombre}}" name="nombre" class="form-control">


		<center><input type="submit" value="Guardar " class="btn btn-primary" ></center>
		<input type="hidden" name="_token" value="{{csrf_token()}}">

	</form>
      </div>
     
                    </div>
                </div>
             </div>




@endsection