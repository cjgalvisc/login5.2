<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Proveedor;
use Validator;
use DB;
class proveedorController extends Controller
{
    public function index(){
		$proveedores=DB::table('proveedor')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.proveedor.list',array('proveedores'=>$proveedores));
    }

   public function create(){
        return view('dashboard.proveedor.create');    
    }

    public function store(Request $request){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'cedula'=>"required|alpha_num|min:8|max:10",
            'nombre'=>"required|alpha_dash",
            'apellido'=>"required|alpha_dash",
            'telefono'=>"required|alpha_num|min:6|max:10",
            'empresa'=>"required|alpha_dash",
            'nit'=>"required|alpha_num"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            //instancio un nuevo empleado
            $proveedor = new Proveedor();
            $proveedor->cedula = $request->input("cedula");
            $proveedor->nombre =  $request->input("nombre");
            $proveedor->apellido =  $request->input("apellido");
            $proveedor->telefono =  $request->input("telefono");
            $proveedor->empresa =  $request->input("empresa");
            $proveedor->estado="1";
            $proveedor->nit =  $request->input("nit");
            $proveedor->save();
            //redirecciono a la lista de empleados para verificar que el empelado si quedo guardado correctamente
            return redirect('proveedor/list')->with('exito',"proveedor guardado con exito");
        }
    }
    public function edit(Request $request,$id){
            $proveedor=Proveedor::find($id);
            return view('dashboard.proveedor.edit',array('proveedor'=>$proveedor));  
        }
    
    public function update(Request $request,$id){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'cedula'=>"required|alpha_num|min:8|max:10",
            'nombre'=>"required|alpha_dash",
            'apellido'=>"required|alpha_dash",
            'telefono'=>"required|alpha_num|min:6|max:10",
            'empresa'=>"required|alpha_dash",
            'nit'=>"required|alpha_num"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            //instancio un nuevo empleado
            $proveedor =Proveedor::find($id);
            $proveedor->cedula = $request->input("cedula");
            $proveedor->nombre =  $request->input("nombre");
            $proveedor->apellido =  $request->input("apellido");
            $proveedor->telefono =  $request->input("telefono");
            $proveedor->empresa =  $request->input("empresa");
            $proveedor->estado="1";
            $proveedor->nit =  $request->input("nit");
            $proveedor->save();
            //redirecciono a la lista de empleados para verificar que el empelado si quedo guardado correctamente
            return redirect('proveedor/list')->with('exito',"proveedor Actualizado con exito");
        }
  
        }

    public function delete($id){
        $proveedor=Proveedor::find($id);
        $proveedor->estado="2";
        $proveedor->save();
        return redirect('proveedor/list')->with('exito',"Proveedor Eliminado con exito");
    }

    public function ordenarEmpresa(){
        $proveedores=DB::table('proveedor')
                    ->orderBy('empresa','asc')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.proveedor.list',array('proveedores'=>$proveedores));
    }

    public function ordenarVendedor(){
        $proveedores=DB::table('proveedor')
                    ->orderBy('nombre','asc')
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.proveedor.list',array('proveedores'=>$proveedores));
    }

   public function search(Request $request){
        $empresa=$request->input('empresa');
        $proveedores=DB::table('proveedor')
                    ->where('empresa','=',$empresa)
                    ->where('estado','<>','2')
                    ->get();
        return view('dashboard.proveedor.list',array('proveedores'=>$proveedores));
    }
}
