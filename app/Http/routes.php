<?php


//ruta para la intefaz de login
Route::get('/', function () {
    return view('auth.login');
});
//ruta para autentificar los usuarios
Route::auth();

//ruta para proteger las rutas del menu(solo usuarios autentificacdos pueden verlas)
Route::group(['middleware'=>'auth'],function(){

/*
//ruta para el menu principal de la aplicaion
Route::get('/menu', function () {
    return view('dashboard.index');
});
*/

//rutas para empleado
Route::group(['prefix'=>'empleado'],function(){
	Route::get("list","empleadoController@index");
	Route::get("create","empleadoController@create");
	Route::post("store","empleadoController@store");
	//el estatus es opcional lo denoto con el ?
	Route::get("edit/{id}/{estatus?}","empleadoController@edit");
	Route::post("update/{id}","empleadoController@update");
	Route::get("delete/{id}","empleadoController@delete");
	Route::get("search/{id}","empleadoController@search");
});
//rutas para proveedor
Route::group(['prefix'=>'proveedor'],function(){
	Route::get("list","proveedorController@index");
	Route::get("create","proveedorController@create");
	Route::post("store","proveedorController@store");
	Route::get("edit/{id}","proveedorController@edit");
	Route::post("update/{id}","proveedorController@update");
	Route::get("delete/{id}","proveedorController@delete");
	Route::get("ordenarEmpresa","proveedorController@ordenarEmpresa");
	Route::get("ordenarVendedor","proveedorController@ordenarVendedor");
	Route::post("search","proveedorController@search");
});
//rutas para tipoProducto
Route::group(['prefix'=>'tipoProducto'],function(){
	Route::get("list","tipoProductoController@index");
	Route::get("create","tipoProductoController@create");
	Route::post("store","tipoProductoController@store");
	Route::get("edit/{id}","tipoProductoController@edit");
	Route::post("update/{id}","tipoProductoController@update");
	Route::get("delete/{id}","tipoProductoController@delete");
	Route::get("ordenar","tipoProductoController@ordenar");
	Route::post("search","tipoProductoController@search");
});
//rutas para producto
Route::group(['prefix'=>'producto'],function(){
	Route::get("list","productoController@index");
	Route::get("create","productoController@create");
	Route::post("store","productoController@store");
	Route::get("edit/{id}","productoController@edit");
	Route::post("update/{id}","productoController@update");
	Route::get("delete/{id}","productoController@delete");
	Route::get("ordenarNombre","productoController@ordenarNombre");
	Route::get("ordenarPrecio","productoController@ordenarPrecio");
	Route::get("ordenarCantidad","productoController@ordenarCantidad");
	Route::post("search","productoController@search");

});



//rutas para compra
Route::group(['prefix'=>'compra'],function(){
	Route::get("list","compraController@index");
	Route::get("create","compraController@create");
	Route::post("store","compraController@store");
	Route::get("edit/{id}","compraController@edit");
	Route::post("update/{id}","compraController@update");
	Route::get("delete/{id}","compraController@delete");
	Route::get("filtroProveedor","compraController@filtroProveedor");
	Route::get("filtroFecha","compraController@filtroFecha");
	Route::get("filtroProducto","compraController@filtroProducto");
	Route::get("reporte","compraController@reporte");
	Route::get("reporteProveedor/{id}","compraController@reporteProveedor");
	Route::get("reporteProducto/{id}","compraController@reporteProducto");
	Route::get("reporteFecha/{fa}/{fb}","compraController@reporteFecha");
	/*Route::get('reporteFecha/{fa}/{fb}', function($fa, $fb){
			return "fecha1: $fa y fecha2: $fb";
	});*/
	Route::post("search","compraController@search");
	Route::get("ordenarFecha","compraController@ordenarFecha");
	Route::get("ordenarTotal","compraController@ordenarTotal");
	Route::get("autocompletar","compraController@autocompletar");
});





});

