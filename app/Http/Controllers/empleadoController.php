<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rol;
use Validator;
use App\Http\Requests;
use Carbon\Carbon;
class empleadoController extends Controller
{

	public function index(){
		$empleados=User::all();
        $roles=Rol::all();

        return view('dashboard.empleado.list',array('roles'=>$roles,'empleados'=>$empleados));
    }

   public function create(){
        $roles=Rol::all();
        return view('dashboard.empleado.create',array('roles'=>$roles));    
    }

    public function store(Request $request){

        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'cedula'=>"required|alpha_num|min:8|max:10",
            'name'=>"required|alpha",
            'apellidos'=>"required|alpha",
            'fechaNacimiento'=>"required|before:1996",
            'email'=>"required",
            'password'=>"required",
            'direccion'=>"required|alpha_dash",
            'telefono'=>"required|alpha_num|min:6|max:10",
            'fechaIngreso'=>"required"
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            //instancio un nuevo empleado
            $empleado = new User();
            //capturo cada datos mediante el metodo request que trae los datos desde el formulario de resgistrar empleado
            $empleado->cedula = $request->input("cedula");
            $empleado->name =  $request->input("name");
            $empleado->apellidos =  $request->input("apellidos");
            //convierto la fecha del datepick a date
            $empleado->fechaNacimiento =  date("Y-m-d", strtotime($request->input("fechaNacimiento")));
            $empleado->email =  $request->input("email");
            //encripto la contraaseña
            $empleado->password = bcrypt($request->input("password"));
            $empleado->direccion =  $request->input("direccion");
            $empleado->telefono =  $request->input("telefono");
            $empleado->rol =  $request->input("rol");
            $empleado->estado="1";
            $empleado->fechaIngreso = date("Y-m-d", strtotime($request->input("fechaIngreso")));
            //token requerido para procesar correctamente la solicitud de guardado
            $empleado->remember_token=  $request->input("_token");
            $empleado->save();
            //redirecciono a la lista de empleados para verificar que el empelado si quedo guardado correctamente
            return redirect('empleado/list')->with('exito',"Empleado guardado con exito");
        }
    }
    public function edit(Request $request,$id){
            $empleado=User::find($id);
            $roles=Rol::all();
            return view('dashboard.empleado.edit',array('empleado'=>$empleado,'roles'=>$roles));  
        }
    
    public function update(Request $request,$id){
        //para validar todos los campos del formulario
        $validator= Validator::make($request->all(),[
            'cedula'=>"required|alpha_num|min:8|max:10",
            'name'=>"required|alpha",
            'apellidos'=>"required|alpha",
            'fechaNacimiento'=>"required|before:1996",
            'email'=>"required",
            'password'=>"required",
            'direccion'=>"required|alpha_dash",
            'telefono'=>"required|alpha_num|min:6|max:10",
            'fechaIngreso'=>"required",
        ]);
        //si existen errores en la validacion me devuelvo a la misma pagina pero con los errores encontrados
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }else{
            //instancio un nuevo empleado
            $empleado = User::find($id);
            //capturo cada datos mediante el metodo request que trae los datos desde el formulario de resgistrar empleado
            $empleado->cedula = $request->input("cedula");
            $empleado->name =  $request->input("name");
            $empleado->apellidos =  $request->input("apellidos");
            //convierto la fecha del datepick a date
            $empleado->fechaNacimiento =  date("Y-m-d", strtotime($request->input("fechaNacimiento")));
            $empleado->email =  $request->input("email");
            //encripto la contraaseña
            $empleado->password = bcrypt($request->input("password"));
            $empleado->direccion =  $request->input("direccion");
            $empleado->telefono =  $request->input("telefono");
            $empleado->rol =  $request->input("rol");
            $empleado->estado="1";
            $empleado->fechaIngreso = date("Y-m-d", strtotime($request->input("fechaIngreso")));
            //token requerido para procesar correctamente la solicitud de guardado
            $empleado->remember_token=  $request->input("_token");
            $empleado->save();
            //redirecciono a la lista de empleados para verificar que el empelado si quedo guardado correctamente
            return redirect('empleado/list')->with('exito',"Empleado Actualizado con exito");
        }
  
        }

    public function delete($id){
        $empleado=User::find($id);
        $empleado->estado="2";
        $empleado->save();
        return redirect('empleado/list')->with('exito',"Empleado Eliminado con exito");
    }

   /* public function search(){
        $empleado->estado="2";
        $empleado->save();
        return redirect('empleado/list')->with('exito',"Empleado Eliminado con exito");
    }*/
    
}
