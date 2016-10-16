<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Proveedor;

use App\Producto;

use App\Compra;

use App\FacturaCompra;

use DB;

class compraController extends Controller
{
    public function index(){
        $facturas=DB::table('facturaCompra')
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.list',array('facturas'=>$facturas,'proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function create(){
    	$proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
    	$productos=DB::table('producto')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.create',array('proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function store(Request $request){
        //captruo las filas de la tabla
        $codigos=$_POST['codigos'];
        $cantidades=$_POST['cantidades'];
        $costos=$_POST['costos'];
        $bandera1=false;
        $bandera2=false;
        $validator= Validator::make($request->all(),[
            'fecha'=>"required",
            'imagen'=>"required",
            'total'=>"required|integer|between:0,100000000"
        ]);
        //valido que las filas de las tablas no sean negativas y solo sean numeros enteros
       for ($i=0; $i <sizeof($codigos) ; $i++) { 
           if(!ctype_digit($codigos[$i]) || !ctype_digit($cantidades[$i]) || !ctype_digit($costos[$i])){
            $bandera1=true;
            break;
           }
       }
       

        //valido que las filas de las tablas no sean negativas y solo sean numeros enteros
        $productos=DB::table('producto')
                    ->where('estado','<>','2')
                    ->get();
        $contador=0;
       for ($i=0; $i <sizeof($codigos) ; $i++) { 
           foreach ($productos as $producto) {
               if($producto->id==$codigos[$i]){
                    $contador++;
               }
           }
       }
       if($contador!=sizeof($codigos)){
            $bandera2=true;
       }

       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else if($bandera1){
            return redirect()->back()->with("error","los campos de la tabla deben ser positivos");
        }else if($bandera2){
            return redirect()->back()->with("error","alguno de los productos ingresados no existen");
        }else{
        //capturo las filas de la tabla de la factura
        $imagen=$_FILES['imagen']['name'];
        

        //instanciamos una nueva factura de compra
        $facturaCompra=new FacturaCompra();
        //datos para facturaCompra
        $facturaCompra->fecha= date("Y-m-d", strtotime($request->input("fecha")));
        $facturaCompra->total=$request->input("total");
        $facturaCompra->foto=$imagen;
        $facturaCompra->estado="1";
        $facturaCompra->id_proveedor=$request->input("proveedor");
        $facturaCompra->save();

        //para subir la imagen al servidor
        if(!move_uploaded_file($_FILES['imagen']['tmp_name'],"facturas/".$imagen)){
            echo "erorr al subir documento";
        }
        //capturo el id con el cual fue guardado la factura
        $id_factura=$facturaCompra->id;

        //actualizo cada uno de los productos
        for ($j=0; $j < sizeof($codigos); $j++) 
        { 
            $producto=Producto::find($codigos[$j]);
            $producto->costo=(float)$costos[$j];
            $producto->precio=(float)$costos[$j]+(float)$costos[$j]*(0.25);
            $producto->cantidad=$producto->cantidad+(int)$cantidades[$j];
            $producto->save();
        }
        
        //creo cada una de las compras de la factura
        for ($k=0; $k<sizeof($codigos); $k++) 
        { 
            $compra=new Compra();
            $compra->cantidad=$cantidades[$k];
            $compra->costoUnitario=$costos[$k];
            $compra->subtotal=$costos[$k]*$cantidades[$k];
            $compra->estado="1";
            $compra->id_producto=$codigos[$k];
            $compra->id_facturaCompra=$id_factura;
            $compra->save();         
        }

        return redirect('compra/list')->with('exito',"compra registrada con exito");
        } 	
        
    }


    public function edit(Request $request,$id){
        $compra=FacturaCompra::find($id);
        $detalles=DB::table('compra')
                    ->where('id_facturaCompra','=',$id)
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.edit',array('compra'=>$compra,'proveedores'=>$proveedores,'detalles'=>$detalles)); 
    }

    public function update(Request $request,$id){
        //captruo las filas de la tabla
        $codigos=$_POST['codigos'];
        $cantidades=$_POST['cantidades'];
        $costos=$_POST['costos'];
        $bandera1=false;
        $bandera2=false;
        $validator= Validator::make($request->all(),[
            'fecha'=>"required",
            'imagen'=>"required",
            'total'=>"required|integer|between:0,100000000"
        ]);
        //valido que las filas de las tablas no sean negativas y solo sean numeros enteros
       for ($i=0; $i <sizeof($codigos) ; $i++) { 
           if(!ctype_digit($codigos[$i]) || !ctype_digit($cantidades[$i]) || !ctype_digit($costos[$i])){
            $bandera1=true;
            break;
           }
       }
       

        //valido que las filas de las tablas no sean negativas y solo sean numeros enteros
        $productos=DB::table('producto')
                    ->where('estado','<>','2')
                    ->get();
        $contador=0;
       for ($i=0; $i <sizeof($codigos) ; $i++) { 
           foreach ($productos as $producto) {
               if($producto->id==$codigos[$i]){
                    $contador++;
               }
           }
       }
       if($contador!=sizeof($codigos)){
            $bandera2=true;
       }

       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else if($bandera1){
            return redirect()->back()->with("error","los campos de la tabla deben ser positivos");
        }else if($bandera2){
            return redirect()->back()->with("error","alguno de los productos ingresados no existen");
        }else{

        //capturo las filas de la tabla de la factura
        $imagen=$_FILES['imagen']['name'];
        

        //buscamos la factura de compra
        $facturaCompra=FacturaCompra::find($id);
        //datos para facturaCompra
        $facturaCompra->fecha= date("Y-m-d", strtotime($request->input("fecha")));
        $facturaCompra->total=$request->input("total");
        $facturaCompra->foto=$imagen;
        $facturaCompra->id_proveedor=$request->input("proveedor");
        $facturaCompra->save();

        //para subir la imagen al servidor
        if(!move_uploaded_file($_FILES['imagen']['tmp_name'],"facturas/".$imagen)){
            echo "erorr al subir documento";
        }
        //capturo el id con el cual fue guardado la factura
        $id_factura=$facturaCompra->id;

        //actualizo cada uno de los productos
        for ($j=0; $j < sizeof($codigos); $j++) 
        { 
            $producto=Producto::find($codigos[$j]);
            $producto->costo=(float)$costos[$j];
            $producto->precio=(float)$costos[$j]+(float)$costos[$j]*(0.25);
            $producto->cantidad=$producto->cantidad+(int)$cantidades[$j];
            $producto->save();
        }
        
        //actualizo cada una de las compras de la factura
        for ($k=0; $k<sizeof($codigos); $k++) 
        { 
            $compras=Compra::all();
            foreach ($compras as $compra) {
                if($compra->id_facturaCompra==$id_factura){
                    $compra->cantidad=$cantidades[$k];
                    $compra->costoUnitario=$costos[$k];
                    $compra->subtotal=$costos[$k]*$cantidades[$k];
                    $compra->id_producto=$codigos[$k];
                    $compra->id_facturaCompra=$id_factura;
                    $compra->save();  
                }
            }       
        }

        return redirect('compra/list')->with('exito',"compra Actualizada con exito");
        }
    }
    
    public function delete($id){
        $facturaCompra=FacturaCompra::find($id);
        $facturaCompra->estado="2";
        $facturaCompra->save();

        $compras=Compra::all();
        foreach ($compras as $compra) 
        {
            if($compra->id_facturaCompra==$id)
            {
                $compra->estado="2";
                $compra->save();  
            }
        } 

        return redirect('compra/list')->with('exito',"compra Eliminada con exito");
        }
    
    public function filtroProveedor(Request $request){
        $pivote=$request->input('proveedor');
        $proveedor=Proveedor::find($pivote);
        $resultados=DB::table('facturaCompra')
                    ->where('id_proveedor', '=',$pivote)
                    ->where('estado','<>','2')
                    ->get();

           return view('dashboard.compra.filtroProveedor',array('resultados'=>$resultados,'proveedor'=>$proveedor));     
    }

    public function filtroProducto(Request $request){
        $pivote=$request->input('producto');
        $producto=Producto::find($pivote);
        $resultados = DB::table('compra')
            ->join('facturaCompra','compra.id_facturaCompra', '=', 'facturaCompra.id')
            ->where('compra.id_producto','=',$pivote)
            ->where('compra.estado','<>','2')
            ->get();

        return view('dashboard.compra.filtroProducto',array('resultados'=>$resultados,'producto'=>$producto));   
    }

    public function filtroFecha(Request $request){
        $opcion=$request->input('gender');
        if($opcion=='MayorIgual'){
            $pivote=$request->input('fecha');
            $texto='Facturas Mayores o iguales a la fecha '.$pivote;
            $resultados=DB::table('facturaCompra')
                    ->where('fecha', '>=',$pivote)
                    ->where('estado','<>','2')
                    ->get();
           return view('dashboard.compra.filtroFecha',array('resultados'=>$resultados,'texto'=>$texto));

        }else if($opcion=='MenorIgual'){
            $pivote=$request->input('fecha');
            $texto='Facturas Menores o iguales a la fecha '.$pivote;
            $resultados=DB::table('facturaCompra')
                    ->where('fecha', '<=',$pivote)
                    ->where('estado','<>','2')
                    ->get();
           return view('dashboard.compra.filtroFecha',array('resultados'=>$resultados,'texto'=>$texto));
        }else if($opcion=='Igual' || $opcion==''){
            $pivote=$request->input('fecha');
            $texto='Facturas Iguales a la fecha '.$pivote;
            $resultados=DB::table('facturaCompra')
                    ->where('fecha', '=',$pivote)
                    ->where('estado','<>','2')
                    ->get();
           return view('dashboard.compra.filtroFecha',array('resultados'=>$resultados,'texto'=>$texto));
        }
    }



    public function reporte()
    {
        $vistaurl="dashboard.pdf.reporte";

        $facturas=DB::table('facturaCompra')
                    ->join('proveedor','facturaCompra.id_proveedor', '=', 'proveedor.id')
                    ->where('facturaCompra.estado','<>','2')
                    ->select('facturaCompra.id', 'facturaCompra.fecha', 'proveedor.empresa','facturaCompra.total')
                    ->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('facturas', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->download('reporte.pdf');

        /*if($tipo==1){return $pdf->stream('reporte');}*/
    }  
/*
    public function ajaxProducto()
    {
        $id_proveedor=$_GET['id_proveedor'];
        $id_codigo=$_GET['id_codigo'];
        $consulta=DB::table('producto')
            ->where('id','=',$id_codigo)
            ->where('id_proveedor','=',$id_proveedor)
            ->get();

        if(!$consulta){
            echo "falso";
        }
    }
    */
}
