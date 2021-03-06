<?php

//use Illuminate\Support\Facades\Route;
Auth::routes(["register" => false]);
//Route::view('/','auth/login')->name('login');
Route::view('/','auth/login')->name('inicio');

Route::view('/quienes-somos','about')->name('about');
//esto es lo que esta de bajo en comentario hacen lo mismo
//Route::group(['middleware' => 'auth'], function () {


Route::resource('portafolio', 'ProjectController')
    ->parameters(['portafolio' => 'project'])
    ->names('projects');  
 

Route::view('/contacto','contact')->name('contact');
Route::post('contact', 'MessageController@store')->name('messages.store');



////////////////////////////// VIEW ALUMNOS /////////////////////////////////

Route::get('/alumnos/index','AlumnosController@index')->name('alumnos.index');
Route::get('/alumnos/{id_alumnos}','AlumnosController@show')->name('alumnos.show');
Route::get('/alumnos/create/{id_pago}','AlumnosController@create')->name('alumnos.create')->middleware('role:admin,finance-manager');
Route::get('/alumnos/editar/{id_pago}', 'AlumnosController@edit')->name('alumnos.edit')->middleware('role:admin,finance-manager');
Route::patch('/alumnos/{id_pago}', 'AlumnosController@update')->name('alumnos.update')->middleware('role:admin,finance-manager');
Route::post('/alumnos', 'AlumnosController@store')->name('alumnos.store')->middleware('role:admin,finance-manager');
Route::delete('/alumnos/{id_pago}', 'AlumnosController@destroy')->name('alumnos.destroy')->middleware('role:admin,finance-manager'); 
/*Route::get('/alumnos/imagen/{pagoItem}', 'AlumnosController@imagen')->name('alumnos.imagen');*/

Route::get('/alumno_pdf/prorroga/{id}','PDFController@PDF')->name('descargarPDF');
Route::get('/alumnos/baucher/{id_pago}', 'AlumnosController@baucher')->name('alumnos.baucher');

/*Route::get('attached/edit', function ()    {
        return view('attached.edit');
    });
Route::get('attached/edit/{id}','attachedController@edit')->middleware('role:admin,finance-manager');
Route::put('attached/editar/{id}','attachedController@update')->middleware('role:admin,finance-manager');*/
 
  
                         
Route::get('/alumnos/baucher/{id_pago}' , 'AlumnosController@baucher')->name('alumnos.baucher');


////////////////////////// VIEW CATEGORIES /////////////////////////

Route::get('/categorias/','CategoriasController@index')->name('categorias.index');
Route::get('/categorias/create', 'CategoriasController@create')->name('categorias.create')->middleware('role:admin,finance-manager');  //muy importante el orden de las rutas si no no va a funcionar 
Route::get('/categorias/{categoria}/editar', 'CategoriasController@edit')->name('categorias.edit')->middleware('role:admin,finance-manager');
Route::patch('/categorias/{categoria}', 'CategoriasController@update')->name('categorias.update')->middleware('role:admin,finance-manager');
Route::post('/categorias', 'CategoriasController@store')->name('categorias.store')->middleware('role:admin,finance-manager');
Route::delete('/categorias/{categoria}', 'CategoriasController@destroy')->name('categorias.destroy')->middleware('role:admin,finance-manager');  

/////// permisos y roles
Route::resource('users', 'UsersController')
    ->parameters(['users' => 'user'])
    ->names('users')->middleware('role:admin');
//Route::resource('users', 'UsersController');

    /// Roles

Route::resource('roles', 'RolesController')
    ->parameters(['roles' => 'role'])
    ->names('roles')->middleware('role:admin'); 


Route::resource('costo-semestres', 'CostoSemestreController')
    ->parameters(['costo-semestres' => 'cargoItem'])
    ->names('costo-semestre')->middleware('role:admin,finance-manager');


Route::get('/cargo-alumno/create/{id_alumno}', 'CargoAlumnoController@create')->name('cargo-alumno.create')->middleware('role:admin,finance-manager');
Route::post('cargo-alumno/fetch', 'CargoAlumnoController@fetch')->name('cargo-alumno.fetch')->middleware('role:admin,finance-manager');
Route::post('/cargo-alumno', 'CargoAlumnoController@store')->name('cargo-alumno.store')->middleware('role:admin,finance-manager');
Route::get('/cargo-alumno/show/{id_alumno}', 'CargoAlumnoController@show')->name('cargo-alumno.show')->middleware('role:admin,finance-manager');
Route::delete('/cargo-alumno/{id_cargo}', 'CargoAlumnoController@destroy')->name('cargo-alumno.destroy')->middleware('role:admin,finance-manager');


////////////////////////////// CREAR EDITAR ALUMNO /////////////////////////////////77
Route::get('/estudiante/create','EstudianteController@create')->name('estudiante.create')->middleware('role:admin,school-manager');
Route::post('/estudiante', 'EstudianteController@store')->name('estudiante.store')->middleware('role:admin,school-manager');
Route::get('getEspecialidades/{id_plan}','EstudianteController@getEspecialidades')->middleware('role:admin,school-manager');
Route::get('/estudiante/edit/{id_alumno}','EstudianteController@edit')->name('estudiante.edit')->middleware('role:admin,school-manager');
Route::patch('estudiante/{alumno}', 'EstudianteController@update')->name('estudiante.update')->middleware('role:admin,school-manager');



//////////////////////////// CONTROL ESCOLAR NDEX ///////////////
Route::get('/controlEscolar/index','ControlEscolarController@index')->name('controlescolar.index')->middleware('role:admin,school-manager');
Route::get('/credencial/{id_alumno}', 'SubirCredencialController@show')->name('credencial.show')->middleware('role:admin,school-manager');
Route::get('/credencial/id/{id}','SubirCredencialController@pdf')->name('credencialPDF')->middleware('role:admin,school-manager');
Route::get('/credencial/create/{id_alumno}', 'SubirCredencialController@create')->name('credencial.create')->middleware('role:admin,school-manager');
Route::post('/credencial/', 'SubirCredencialController@store')->name('credencial.store')->middleware('role:admin,school-manager');
Route::get('/credencial/edit/{id_alumno}', 'SubirCredencialController@edit')->name('credencial.edit')->middleware('role:admin,school-manager');
Route::patch('credencial/{data}', 'SubirCredencialController@update')->name('credencial.update')->middleware('role:admin,school-manager');
Route::delete('/credencial/{alumno}', 'SubirCredencialController@destroy')->name('credencial.destroy')->middleware('role:admin,school-manager');


//////////////////////////// INSCRIPCION & REINSCRIPCION /////////////////////////////////7

Route::get('/inre/edit/{id_alumno}','InReinscripcionController@edit')->name('inre.edit')->middleware('role:admin,school-manager');
Route::patch('inre/{id_alumno}', 'InReinscripcionController@update')->name('inre.update')->middleware('role:admin,school-manager');
Route::get('/inre/ficha/{id_alumno}','InReinscripcionController@pdf')->name('inre.alumno')->middleware('role:admin,school-manager');



Route::get('/official/{id_alumno}', 'DocumentosOficialesController@show')->name('official.show')->middleware('role:admin,school-manager');
Route::get('/official/create/{id_alumno}', 'DocumentosOficialesController@create')->name('official.create')->middleware('role:admin,school-manager');
Route::post('/official', 'DocumentosOficialesController@store')->name('official.store')->middleware('role:admin,school-manager');
Route::get('/official/edit/{id}', 'DocumentosOficialesController@edit')->name('official.edit')->middleware('role:admin,school-manager');
Route::patch('official/{id}', 'DocumentosOficialesController@update')->name('official.update')->middleware('role:admin,school-manager');
Route::get('/official/bachiller/{id_alumno}', 'DocumentosOficialesController@bachiller')->name('official.bachiller')->middleware('role:admin,school-manager');
Route::get('/official/curp/{id_alumno}', 'DocumentosOficialesController@curp')->name('official.curp')->middleware('role:admin,school-manager');
Route::get('/official/acta/{id_alumno}', 'DocumentosOficialesController@acta')->name('official.acta')->middleware('role:admin,school-manager');
Route::delete('/official/acta/{data}', 'DocumentosOficialesController@destroy')->name('official.destroy')->middleware('role:admin,school-manager');


