$(document).ready(function(){
	$("#empleado-crear").validate({
		rules:{
			cedula:{
				required:true
			},
			name:{
				required:true
			},
			apellidos:{
				required:true
			},
			fechaNacimiento:{
				required:true
			},
			email:{
				required:true
			},
			password:{
				required:true
			},
			direccion:{
				required:true
			},
			telefono:{
				required:true
			},
			fechaIngreso:{
				required:true
			}
		}
	})
});