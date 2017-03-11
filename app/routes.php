<?php

/*Llamadas al controlador Auth*/
Route::get('login', 'AuthController@showLogin'); // Mostrar login
Route::post('login', 'AuthController@postLogin'); // Verificar datos
Route::get('logout', 'AuthController@logOut'); // Finalizar sesión


/*Rutas privadas solo para usuarios autenticados*/
Route::group(['before' => 'auth'], function()
{
    Route::get('/', 'HomeController@showWelcome'); // Vista de inicio

    //Usuarios
    Route::get('register', 'UsuariosController@get_nuevo');
	Route::post('register', 'UsuariosController@post_nuevo');

	Route::get('edit_user{id}', 'UsuariosController@getEditUsuario')->where('id', '[0-9]+');
	Route::post('edit_user', 'UsuariosController@update');

	Route::get('lista_usuarios{id}', 'UsuariosController@destroy');
	Route::get('lista_usuarios', 'UsuariosController@all_users');

	//Clientes
	Route::get('register_cliente', 'ClientesController@get_nuevo');
	Route::post('register_cliente', 'ClientesController@post_nuevo');
	Route::get('lista_clientes', 'ClientesController@all_clients');
	Route::get('lista_clientes{id}', 'ClientesController@destroy');

	//Recursos
	Route::get('register_recurso', 'RecursosController@get_nuevo');
	Route::post('register_recurso', 'RecursosController@post_nuevo');
	Route::get('lista_recursos', 'RecursosController@all_resources');

	//Proyectos
	Route::get('register_proyecto', 'ProyectosController@get_nuevo');
	Route::post('register_proyecto', 'ProyectosController@post_nuevo');
	Route::get('continuar_etapa{id}', 'ProyectosController@get_continuarEtapa')->where('id', '[0-9]+');
	Route::post('continuar_etapa', 'ProyectosController@post_continuarEtapa');

	//Proyectos Solicitudes
	Route::get('solicitudes_proyectos', 'ProyectosController@all_solicitudes');
	Route::post('solicitudes_proyectos', 'ProyectosController@get_solicitud');
	Route::post('register_solicitud', 'ProyectosController@post_solicitud'); 
	Route::get('continuar_etapa_solicitud{id}', 'ProyectosController@get_continuarEtapaSolicitud')->where('id', '[0-9]+');
	Route::post('continuar_etapa_solicitud', 'ProyectosController@post_continuarEtapaSolicitud');
	Route::get('continuar_recurso_solicitud{id}', 'ProyectosController@get_continuarRecursoSolicitud')->where('id', '[0-9]+');
	Route::post('continuar_recurso_solicitud', 'ProyectosController@post_continuarRecursoSolicitud');
	Route::get('confirma_proyecto_solicitud{id}', 'ProyectosController@get_confirmarproyectosolicitud')->where('id', '[0-9]+');
	Route::post('confirma_proyecto_solicitud', 'ProyectosController@post_confirmarproyecto_solicitud');

	//Editar solicitudes
	Route::get('edit_solicitud{id}', 'ProyectosController@getEditSolicitud')->where('id', '[0-9]+');
	Route::post('edit_solicitud', 'ProyectosController@postEditSolicitud');

	Route::get('continuar_recurso{id}', 'ProyectosController@get_continuarRecurso');
	Route::post('continuar_recurso', 'ProyectosController@post_continuarRecurso');

	Route::get('confirma_proyecto{id}', 'ProyectosController@get_confirmarproyecto')->where('id', '[0-9]+');
	Route::post('confirma_proyecto', 'ProyectosController@post_confirmarproyecto');

	Route::get('lista_proyectos', 'ProyectosController@all_projects');
	Route::get('lista_proyectos{id}', 'ProyectosController@getEditEtapa')->where('id', '[0-9]+');

	Route::get('edit_etapa{id}', 'ProyectosController@cambiarEstadoEtapa')->where('id', '[0-9]+');

	Route::get('feedback_etapa{id}', 'ProyectosController@getDarFeedback')->where('id', '[0-9]+');

	Route::get('dar_feedback', 'ProyectosController@getDarFeedback');
	Route::post('dar_feedback', 'ProyectosController@postDarFeedback');
	Route::get('lista_feedbacks{proetapa}', 'ProyectosController@all_feedbacks');
});

App::missing(function($exception) {
    return "exception";

});





/*Route::get('/', 'HomeController@showWelcome');

// Rutas de /usuario
Route::get('usuario', 'UserController@getIndex');

//Pestañas de inscripcion
Route::get('inscripcion','AlumnController@getIndex');
Route::get('inscripcion/alumno', 'AlumnController@getTabAlumno');
Route::get('inscripcion/familiares', 'AlumnController@getTabFamiliares');
Route::get('inscripcion/salud', 'AlumnController@getTabSalud');
Route::get('inscripcion/sae', 'AlumnController@getTabSae');

Route::get('inscripcion/alumno/{id}', 'AlumnController@getEditTabAlumno')->where('id', '[0-9]+');
Route::get('inscripcion/familiares/{id}', 'AlumnController@getEditTabFamiliares')->where('id', '[0-9]+');
Route::get('inscripcion/salud/{id}', 'AlumnController@getEditTabSalud')->where('id', '[0-9]+');
Route::get('inscripcion/sae/{id}', 'AlumnController@getEditTabSae')->where('id', '[0-9]+');

//Ruta de validaciones
Route::get('validaciones', 'AlumnController@validaciones');
Route::get('inscripcion/alumno/validaciones', 'AlumnController@validaciones');
Route::get('inscripcion/familiares/validaciones', 'AlumnController@validaciones');
Route::get('inscripcion/salud/validaciones', 'AlumnController@validaciones');

//Ruta de alta de alumno 
Route::post('inscripcion/alumno', 'AlumnController@alta_alumno');

//Ruta de alta Familiares/tutores
Route::post('inscripcion/familiares', 'AlumnController@alta_familiar');

//Ruta de alta salud
Route::post('inscripcion/salud', 'AlumnController@alta_salud');

//Ruta de inscripcion
Route::get('login' , 'UserController@getLogin');
Route::post('login' , 'UserController@postLogin');
Route::get('logout','UserController@logout');

*/