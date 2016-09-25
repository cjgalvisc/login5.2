<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Proveedor;

use App\Producto;

use App\Compra;

use App\FacturaCompra;

class compraController extends Controller
{
    public function create(){
    	$proveedores=Proveedor::all();
    	$productos=Producto::all();
        return view('dashboard.compra.create',array('proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function store(Request $request){
        //capturo las filas de la tabla de la factura
        $codigos=$_POST['codigos'];
        $cantidades=$_POST['cantidades'];
        $costos=$_POST['costos'];

        //instanciamos una nueva factura de compra
        $facturaCompra=new FacturaCompra();
        //datos para facturaCompra
        $facturaCompra->fecha=date("Y-m-d", strtotime($request->input("fecha")));
        $facturaCompra->total=$request->input("total");
        $facturaCompra->id_proveedor=$request->input("proveedor");
        $facturaCompra->save();
        //capturo el id con el cual fue guardado la factura
        $id_factura=$facturaCompra->id;


        //$subtotales=$_POST['subtotales'];

        /*//validamos que los prodcutos si esten en la base de datos
        //traemos todos los productos que existen
        $productos=Producto::all();

        for ($i=0; $i <sizeof($codigos) ; $i++) { 
            foreach ($productos as $producto) {
                if($codigos[i]){

                }
            }
            
        }

        //actulizo cada uno de los productos de la factura
        for ($j=0; $j < sizeof($codigos); $j++) { 
            $producto=Producto::find($codigos[$j]);
            $producto->costo=(float)$costos[$j];
            $producto->precio=(float)$costos[$j]*(0.25);
            $producto->cantidad=(int)$cantidades[$j];
            $producto->save();
        }
        //instanciamos un nuevo producto 


        //instanciamos una nueva factura de compra
    	$facturaCompra=new FacturaCompra();
    	//datos para facturaCompra
    	$facturaCompra->fecha=date("Y-m-d", strtotime($request->input("fecha")));
    	$facturaCompra->total=$request->input("total");
    	$facturaCompra->foto;
    	$facturaCompra->id_proveedor=$request->input("proveedor");
        $facturaCompra->save();

        //actualizo cada uno de los productos
        for ($j=0; $j < sizeof($codigos); $j++) 
        { 
            $producto=Producto::find($codigos[$j]);
            $producto->costo=(float)$costos[$j];
            $producto->precio=(float)$costos[$j]*(0.25);
            $producto->cantidad=(int)$cantidades[$j];
            $producto->save();
        }*/
        
        //creo cada una de las compras de la factura
        for ($k=0; $k<sizeof($codigos); $k++) 
        { 
            $compra=new Compra();
            $compra->cantidad=$cantidades[$k];
            $compra->subtotal=$costos[$k];
            $compra->id_producto=$codigos[$k];
            $compra->id_facturaCompra=$id_factura;
            $compra->save();         
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
