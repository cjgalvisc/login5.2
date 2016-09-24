<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Proveedor;

use App\Producto;

class compraController extends Controller
{
    public function create(){
    	$proveedores=Proveedor::all();
    	$productos=Producto::all();
        return view('dashboard.compra.create',array('proveedores'=>$proveedores,'productos'=>$productos));    
    }

    public function store(Request $request){
    	//$facturaCompra=new FacturaCompra();

    	//datos para facturaCompra
    	/*$facturaCompra->fecha=date("Y-m-d", strtotime($request->input("fecha")));
    	$facturaCompra->total=
    	$facturaCompra->foto=
    	$facturaCompra->id_proveedor=$request->input("proveedor"):*/
    	//datos para compra

    	$codigos=$_POST['codigos'];
    	$cantidades=$_POST['cantidades'];
    	$subtotales=$_POST['subtotales'];

    	for ($i=0; $i < sizeof($cantidades); $i++) { 
    		echo "<br>".($i+1).",".$cantidades[$i].",".$subtotales[$i].",".$codigos[$i];
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
