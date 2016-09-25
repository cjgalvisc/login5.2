<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use App\Proveedor;

use App\Producto;

use App\Compra;

use App\FacturaCompra;

class compraController extends Controller
{
    public function index(){
        $facturas=FacturaCompra::all();
        $proveedores=Proveedor::all();
        $productos=Producto::all();
        return view('dashboard.compra.list',array('facturas'=>$facturas,'proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function create(){
    	$proveedores=Proveedor::all();
    	$productos=Producto::all();
        return view('dashboard.compra.create',array('proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function store(Request $request){
        //captruo las filas de la tabla
        $codigos=$_POST['codigos'];
        $cantidades=$_POST['cantidades'];
        $costos=$_POST['costos'];
        $bandera=false;
       $validator= Validator::make($request->all(),[
            'fecha'=>"required",
            'imagen'=>"required",
            'total'=>"required|integer|between:0,100000000"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados

        //valido que las filas de las tablas no sean negativas y solo sean numeros enteros
       for ($i=0; $i <sizeof($codigos) ; $i++) { 
           if(!ctype_digit($codigos[$i]) || !ctype_digit($cantidades[$i]) || !ctype_digit($costos[$i])){
            $bandera=true;
            break;
           }
       }
       
        if($validator->fails()|| $bandera){
            return redirect()->back()->withErrors($validator->errors());
        }else{
        

        //capturo las filas de la tabla de la factura
        $imagen=$_FILES['imagen']['name'];
        

        //instanciamos una nueva factura de compra
        $facturaCompra=new FacturaCompra();
        //datos para facturaCompra
        $facturaCompra->fecha= date("Y-m-d",strtotime($request->input("fecha")));
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
        
        //creo cada una de las compras de la factura
        for ($k=0; $k<sizeof($codigos); $k++) 
        { 
            $compra=new Compra();
            $compra->cantidad=$cantidades[$k];
            $compra->subtotal=$costos[$k]*$cantidades[$k];
            $compra->id_producto=$codigos[$k];
            $compra->id_facturaCompra=$id_factura;
            $compra->save();         
        }

        } 	
        
    }

    public function buscar(Request $request){
        $producto1=$_POST['codigoProducto'];
        foreach ($productos as $producto) {
            if($producto->id==$producto1){
                return redirect('compra/create')->with('exito');
            }else{
                return redirect('compra/create')->with('error');
            }
        }
    }
}
