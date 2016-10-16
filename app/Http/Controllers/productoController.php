<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Producto;
use App\TipoProducto;
use App\Proveedor;
use Validator;
use DB;

class productoController extends Controller
{
    public function index(){
		$productos=DB::table('producto')
                    ->where('estado','<>','2')
                    //->paginate(15)
                    ->get();
        $tipoProductos=DB::table('tipoProducto')
                    //->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    //->where('estado','<>','2')
                    ->get();
        return view('dashboard.producto.list',array('productos'=>$productos,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));
    }

   public function create(){
        $tipoProductos=DB::table('tipoProducto')
                    ->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.producto.create',array('tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));    
    }

    public function store(Request $request){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'nombre'=>"required|alpha_dash",
            'unidad'=>"required|alpha",
            'costo'=>"required|integer",
            'precio'=>"required|integer",
            'cantidad'=>"required|integer"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $producto = new Producto();
            $producto->nombre = $request->input("nombre");
            $producto->unidad =  $request->input("unidad");
            $producto->costo =  $request->input("costo");
            $producto->precio =  $request->input("precio");
            $producto->cantidad =  $request->input("cantidad");
            $producto->estado =  "1";
            $producto->id_tipoProducto =  $request->input("tipo");
            $producto->id_proveedor =  $request->input("proveedor");
            $producto->save();
            return redirect('producto/list')->with('exito',"Producto guardado con exito");
        }
    }
    public function edit(Request $request,$id){
            $producto=Producto::find($id);
            $tipoProductos=DB::table('tipoProducto')
                        ->where('estado','<>','2')
                        ->get();
        	$proveedores=DB::table('proveedor')
                        ->where('estado','<>','2')
                        ->get();
            return view('dashboard.producto.edit',array('producto'=>$producto,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores)); 
        }
    
    public function update(Request $request,$id){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'nombre'=>"required|alpha",
            'unidad'=>"required|alpha",
            'costo'=>"required|integer",
            'precio'=>"required|integer",
            'cantidad'=>"required|integer"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $producto=Producto::find($id);
            $producto->nombre = $request->input("nombre");
            $producto->unidad =  $request->input("unidad");
            $producto->costo =  $request->input("costo");
            $producto->precio =  $request->input("precio");
            $producto->cantidad =  $request->input("cantidad");
            $producto->estado =  "1";
            $producto->id_tipoProducto =  $request->input("tipo");
            $producto->id_proveedor =  $request->input("proveedor");
            $producto->save();
            return redirect('producto/list')->with('exito',"Producto Actualizado con exito");
        }
  
        }

    public function delete($id){
        $producto=Producto::find($id);
        $producto->estado = "2";
        $producto->save();
        return redirect('producto/list')->with('exito',"Producto Eliminado con exito");
    }

    public function ordenarNombre(){
        //realizo la consulta para ordenar por nombre descendiente 
        $productos = DB::table('producto')
                ->orderBy('nombre', 'asc')
                ->where('estado','<>','2')
                ->get();
        $tipoProductos=DB::table('tipoProducto')
                //->where('estado','<>','2')
                ->get();
        $proveedores=DB::table('proveedor')
                //->where('estado','<>','2')
                ->get();
        return view('dashboard.producto.list',array('productos'=>$productos,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));
    }

    public function ordenarPrecio(){
        //realizo la consulta para ordenar por nombre descendiente 
        $productos = DB::table('producto')
                ->orderBy('precio', 'asc')
                ->where('estado','<>','2')
                ->get();
        $tipoProductos=DB::table('tipoProducto')
                //->where('estado','<>','2')
                ->get();
        $proveedores=DB::table('proveedor')
                //->where('estado','<>','2')
                ->get();
        return view('dashboard.producto.list',array('productos'=>$productos,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));
    }

    public function ordenarCantidad(){
        //realizo la consulta para ordenar por nombre descendiente 
        $productos = DB::table('producto')
                ->orderBy('cantidad', 'asc')
                ->where('estado','<>','2')
                ->get();
        $tipoProductos=DB::table('tipoProducto')
                //->where('estado','<>','2')
                ->get();
        $proveedores=DB::table('proveedor')
                //->where('estado','<>','2')
                ->get();
        return view('dashboard.producto.list',array('productos'=>$productos,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));
    }

    public function search(Request $request){
        $codigo=$request->input('codigo');
        $productos=DB::table('producto')
                    ->where('id','=',$codigo)
                    ->get();
        $tipoProductos=DB::table('tipoProducto')
                    //->where('estado','<>','2')
                    ->get();
        $proveedores=DB::table('proveedor')
                    //->where('estado','<>','2')
                    ->get();
        return view('dashboard.producto.list',array('productos'=>$productos,'tipoProductos'=>$tipoProductos,'proveedores'=>$proveedores));

    }
}
