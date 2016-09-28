<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Facturas</title>
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}
footer { 
  width: 700px;
  font: 140% 'News Cycle', arial, sans-serif;
  height: 50px;
  padding: 9px 0 15px 0;
  color: #FFF;
  text-align: center;
  background: #333; /* Show a solid color for older browsers */
  background: -moz-linear-gradient(#444, #222);
  background: -o-linear-gradient(#444, #222);
  background: -webkit-linear-gradient(#444, #222);
  -webkit-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
  -moz-box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
  box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 2px;
  border: 1px solid #222;
}


</style>
	  
</head>
<body > 

<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <div align="center"><img src="reporte/REPORTEa.jpg" style="width: 700px;" >
                    <img src="reporte/INFORME.png" style="float:left; margin:10px;" width=80 height=55 ><BR><BR>
                  </div>
                  <center><h3 class="box-title">Reporte de Facturas {{$date}}</h3></center>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered" border="1" width="90%">
                  <thead>
                     <tr>
                      <th style="width: 40px">Codigo Factura</th>
                      <th style="width: 40px">Fecha</th>
                      <th style="width: 40px">Proveedor</th>
                      <th style="width: 40px">Total</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php $total=0; ?>
                 @foreach($facturas as $factura)
                    <tr>
                      <td align="center" style="width: 40px">{{$factura->id}}</td>
                      <td align="center" style="width: 40px">{{$factura->fecha}}</td>
                      <td align="center" style="width: 40px">{{$factura->empresa}}</td>
                      <td align="center" style="width: 40px">$ <?php echo number_format($factura->total,0); ?></td>
                    </tr>
                    <?php $total=$total+($factura->total); ?>
                  @endforeach
                  </tbody>

                  </table>

                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>
              </div><!-- /.box -->

              <h3 align="right">Total: $ <?php echo number_format($total,0); ?></h3>
              <footer >
               <!-- pie de pagina-->
               
              <p>Copyright & copy 2016;Powered By CJG & YAO | systemContab.co</p>
            </footer>
            </div>


	
</body>
</html>


