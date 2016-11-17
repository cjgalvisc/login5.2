<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Proveedor;

use Carbon\Carbon;

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
                    //->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    //->where('estado','<>','2')
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

        //columna con todos los codigos de producto
        //compruebo que exista almenos una fila en la tabla
        if(isset($_POST['codigos'])){
            $codigos=$_POST['codigos'];
        }else{
            return redirect()->back()->with("error","Debe ingresar al menos un producto");
        }
        //columna con todas las cantidades
        $cantidades=$_POST['cantidades'];
        //columna con todos los subtotales
        $costos=$_POST['costos'];

        //para validar que los campos "fecha","imagen" y "total" no esten vacios
        $validator= Validator::make($request->all(),[
            'fecha'=>"required",
            'imagen'=>"required",
        ]);

       //si existe algun error redirecciono  de vuelta con el mensaje de error
        if($validator->fails()){
            //si el campo fecha,imagen o total estan vacios
            return redirect()->back()->withErrors($validator->errors());
        }else{
        //si no existe ningun error todo esta bien ingresado y procedo a guardar la informacion en la BD

        //capturo el nombre del la imagen 
        $imagen=$_FILES['imagen']['name'];
        

        //instanciamos una nueva factura de compra(usamos ELOQUENT)
        $facturaCompra=new FacturaCompra();
        //guardo los datos para facturaCompra
        //la fecha
        $facturaCompra->fecha= date("Y-m-d", strtotime($request->input("fecha")));
        //el total de la facturaCompra
        $facturaCompra->total=$request->input("total");
        //la nombre de la imagen
        $facturaCompra->foto=$imagen;
        //el estado
        $facturaCompra->estado="1";
        //el id del proveedor 
        $facturaCompra->id_proveedor=$request->input("proveedor");
        //finalmento guardo la factura en la BD
        $facturaCompra->save();

        //para subir la imagen al servidor(almeceno la ruta)
        if(!move_uploaded_file($_FILES['imagen']['tmp_name'],"facturas/".$imagen)){
            echo "erorr al subir documento";
        }

        //capturo el id con el cual fue guardado la factura
        $id_factura=$facturaCompra->id;

        //actualizo cada uno de los productos
        for ($j=0; $j < sizeof($codigos); $j++) 
        { 
            //para encontrar los productos con el id correspondientes
            $producto=Producto::find($codigos[$j]);
            $producto->costo=(float)$costos[$j];
            $producto->precio=(float)$costos[$j]+(float)$costos[$j]*(0.25);
            $producto->cantidad=$producto->cantidad+(int)$cantidades[$j];
            $producto->save();
        }
        
        //creo cada una de las compras relacionadas a la facturaCompra
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

        //si todo salio bien, redirecciono a la lista de facturasCompra con el mensaje
        //de exito
        return redirect('compra/list')->with('exito',"compra registrada con exito");
        } 	
        
    }


    public function edit(Request $request,$id){
        //Traigo la facturaCompra con el ID
        $compra=FacturaCompra::find($id);
        //traigo las compras relacionadas a esa facturaCompra
        $detalles=DB::table('compra')
                    ->where('id_facturaCompra','=',$id)
                    ->where('estado','<>','2')
                    ->get();
        //traigo el proveedor relacionado a esa facturaCompra
        $proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    ->where('estado','<>','2')
                    ->get();
        //envio todo a la vista editar compra
        return view('dashboard.compra.edit',array('compra'=>$compra,'proveedores'=>$proveedores,'detalles'=>$detalles,'productos'=>$productos)); 
    }

    public function update(Request $request,$id){

        //columna con todos los codigos de producto
        //compruebo que exista almenos una fila en la tabla
        if(isset($_POST['codigos'])){
            $codigos=$_POST['codigos'];
        }else{
            return redirect()->back()->with("error","Debe ingresar al menos un producto");
        }

        $cantidades=$_POST['cantidades'];
        $costos=$_POST['costos'];

        $validator= Validator::make($request->all(),[
            'fecha'=>"required",
            'imagen'=>"required",
            'total'=>"required|numeric"
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
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
        //encuentro la facturaCompra con el ID
        $facturaCompra=FacturaCompra::find($id);
        //actualizo su estado a 2
        $facturaCompra->estado="2";
        $facturaCompra->save();

        //encuentro todas las compras con id_facturaCompra igual al ID
        $compras=Compra::all();
        foreach ($compras as $compra) 
        {
            if($compra->id_facturaCompra==$id)
            {
                //actulizo su estado a 2   
                $compra->estado="2";
                $compra->save();  
            }
        } 

        return redirect('compra/list')->with('exito',"compra Eliminada con exito");
        }
    
    public function filtroProveedor(Request $request){
        $pivote=$request->input('proveedor');
        //encuentro el proveedor de la facutare
        $proveedor=Proveedor::find($pivote);
        //busco las facturas con ese proveedor
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
            ->select('facturaCompra.id','facturaCompra.fecha','compra.cantidad','compra.costoUnitario','compra.subtotal')
            ->get();

        return view('dashboard.compra.filtroProducto',array('resultados'=>$resultados,'producto'=>$producto));   
    }

    public function filtroFecha(Request $request)
    {
        //guardo las dos fechas
        $fechaMenor=$request->input('fechaMenor');
        $fechaMayor=$request->input('fechaMayor');
        //compruebo que no sean inconsistentes y que no esten vacias
        if($fechaMenor > $fechaMayor || $fechaMenor=='' || $fechaMayor==''){
            return redirect()->back()->with("error","la fechaMenor no puede ser Mayor a la fechaMayor");
        }else{

            $texto='Facturas entre '.$fechaMenor.' y '.$fechaMayor;
            //Query usando ELOQUENT
            $resultados=DB::table('facturaCompra')
                    ->join('proveedor','facturaCompra.id_proveedor', '=', 'proveedor.id')
                    ->whereBetween('fecha',[$fechaMenor,$fechaMayor])
                    ->where('facturaCompra.estado','<>','2')
                    ->select('facturaCompra.id','facturaCompra.fecha','proveedor.empresa','facturaCompra.total','facturaCompra.foto')
                    ->get();
            //convierto las fechas a String para poder enviarlas por el Urrel
            $fechaMenor=date("Y-m-d", strtotime($fechaMenor));
            $fechaMayor=date("Y-m-d", strtotime($fechaMayor));

           return view('dashboard.compra.filtroFecha',array('resultados'=>$resultados,'texto'=>$texto,'fechaMenor'=>$fechaMenor,'fechaMayor'=>$fechaMayor));
        }

    }


    /*public function filtroFecha(Request $request){
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
    }*/

    public function reporte()
        {
            $vistaurl="dashboard.pdf.reporte";

            $facturas=DB::table('facturaCompra')
                        ->join('proveedor','facturaCompra.id_proveedor', '=', 'proveedor.id')
                        ->where('facturaCompra.estado','<>','2')
                        ->orderBy('facturaCompra.fecha','asc')
                        ->select('facturaCompra.id', 'facturaCompra.fecha', 'proveedor.empresa','facturaCompra.total')
                        ->get();

            $date = date('Y-m-d');
            $view =  \View::make($vistaurl, compact('facturas', 'date'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view);
     
            return $pdf->download('reporte.pdf');

            /*if($tipo==1){return $pdf->stream('reporte');}*/
        }  

    public function reporteProveedor($proveedor)
    {
        $vistaurl="dashboard.pdf.reporteProveedor";

        $empresa=Proveedor::find($proveedor);
        $facturas=DB::table('facturaCompra')
                    ->where('id_proveedor', '=',$proveedor)
                    ->where('estado','<>','2')
                    ->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('facturas', 'date','empresa'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
 
        return $pdf->download('reporte.pdf');

        /*if($tipo==1){return $pdf->stream('reporte');}*/
    }  

    public function reporteProducto($producto)
    {
        $vistaurl="dashboard.pdf.reporteProducto";

        $nombre=Producto::find($producto);
        $facturas = DB::table('compra')
            ->join('facturaCompra','compra.id_facturaCompra', '=', 'facturaCompra.id')
            ->where('compra.id_producto','=',$producto)
            ->where('compra.estado','<>','2')
            ->select('facturaCompra.id','facturaCompra.fecha','compra.cantidad','compra.costoUnitario','compra.subtotal')
            ->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('facturas', 'date','nombre'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
 
        return $pdf->download('reporte.pdf');

        /*if($tipo==1){return $pdf->stream('reporte');}*/
    }
    
    public function reporteFecha($fa,$fb)
    {
        $vistaurl="dashboard.pdf.reporteFecha";
        $facturas=DB::table('facturaCompra')
                    ->join('proveedor','facturaCompra.id_proveedor', '=', 'proveedor.id')
                    ->whereBetween('fecha',[$fa,$fb])
                    ->where('facturaCompra.estado','<>','2')
                    ->select('facturaCompra.id','facturaCompra.fecha','proveedor.empresa','facturaCompra.total')
                    ->get();

        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('facturas', 'date','fa','fb'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
 
        return $pdf->download('reporte.pdf');

        /*if($tipo==1){return $pdf->stream('reporte');}*/
    }

     public function search(Request $request){
        $codigo=$request->input('codigo');
        $facturas=DB::table('facturaCompra')
                    ->where('id','=',$codigo)
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    //->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    //->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.list',array('facturas'=>$facturas,'proveedores'=>$proveedores,'productos'=>$productos)); 

    }

    public function ordenarFecha(){
        $facturas=DB::table('facturaCompra')
                    ->orderBy('fecha','asc')
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    //->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    //->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.list',array('facturas'=>$facturas,'proveedores'=>$proveedores,'productos'=>$productos)); 
    }

    public function ordenarTotal(){
        $facturas=DB::table('facturaCompra')
                    ->orderBy('total','asc')
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    //->where('estado','<>','2')
                    ->get();
        $productos=DB::table('producto')
                    //->where('estado','<>','2')
                    ->get();
        return view('dashboard.compra.list',array('facturas'=>$facturas,'proveedores'=>$proveedores,'productos'=>$productos)); 
    }
    /*metodo para el autocompletado*/
    public function autocompletar(Request $request){
        $letra=$_GET['letra'];
        $productos=DB::table('producto')
                    ->where('nombre','like','$letra%')
                    //->where('estado','<>','2')
                    ->get();
        $datos=array();
        foreach ($productos as $producto) {
            $datos[]=$producto->nombre;
        }
        return response()->json(['datos' => $datos]);

    }

}
