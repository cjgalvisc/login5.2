<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TipoProducto;
use Validator;

class tipoProductoController extends Controller
{

    public function index(){
		$tipoProductos=TipoProducto::all();
        return view('dashboard.tipoProducto.list',array('tipoProductos'=>$tipoProductos));
    }

   public function create(){
        return view('dashboard.tipoProducto.create');    
    }

    public function store(Request $request){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'nombre'=>"required|alpha"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $tipoProducto = new TipoProducto();
            $tipoProducto->nombre = $request->input("nombre");
            $tipoProducto->save();
            return redirect('tipoProducto/list')->with('exito',"Tipo de tipoProducto guardado con exito");
        }
    }
    public function edit(Request $request,$id){
            $tipoProducto=TipoProducto::find($id);
            return view('dashboard.tipoProducto.edit',array('tipoProducto'=>$tipoProducto));  
        }
    
    public function update(Request $request,$id){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'nombre'=>"required|alpha"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            $tipoProducto = TipoProducto::find($id);
            $tipoProducto->nombre =  $request->input("nombre");
            $tipoProducto->save();
            return redirect('tipoProducto/list')->with('exito',"Tipo de Producto Actualizado con exito");
        }
  
        }

    public function delete($id){
        $tipoProducto=TipoProducto::find($id);
        $tipoProducto->delete();
        return redirect('tipoProducto/list')->with('exito',"Tipo de Producto Eliminado con exito");
    }
}
?>