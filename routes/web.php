<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//INICIO
Route::get('/', 'RetoController@getIndex');

//RETOS
Route::get('retos/validations/{reto}','RetoController@getValidations');
Route::get('retos','RetoController@getRetos');

//COMUNIDAD
Route::get('comunidad', 'ComunidadController@getIndex');
Route::get('comunidad/ranking', 'ComunidadController@getRanking');
Route::get('comunidad/foro', 'ComunidadController@getForo');

//HERRAMIENTAS
Route::get('herramientas', 'HerramientasController@getIndex');
Route::get('herramientas/mostrar', 'HerramientasController@getMostrar');
Route::get('herramientas/ver/{herramienta}', 'HerramientasController@getHerramienta');

//SITEMAP
Route::get('sitemap','RetoController@getSitemap');

//F.A.Q.
Route::get('faq','RetoController@getFAQ');

//LOGIN
Auth::routes();

Route::get('logout', function()
{
     return back();
});

Route::group(['middleware' => 'auth'], function()
{
  //RETOS MIDDLEWARE
  Route::post('retos/validar','RetoController@postIsValidFlag');
  Route::get('retos/crear','RetoController@getCrear');
  Route::post('retos/crear','RetoController@postCrear');
  Route::get('retos/{categoria}','RetoController@getRetosCategoria');
  Route::get('retos/{categoria}/{reto}','RetoController@getReto');

  //USERS MIDDLEWARE
  Route::get('editar','UserController@getEditar');
  Route::post('editar','UserController@postEditar');
  Route::post('/send','UserController@postSend');
  Route::get('/mensajes', 'UserController@getMensajes');

  //COMUNITY
  Route::post('comunidad/foro/crear','PostController@postCrear');

  //TOOLS
  Route::get('herramientas/crear', 'HerramientasController@getCrear');
  Route::post('herramientas/crear', 'HerramientasController@postCrear');
  Route::post('herramientas/like', 'ValoracionesController@postLike');

  //API
  Route::get('api','ApiController@getApi');
  Route::get('api/rest','ApiController@getRest');
  Route::get('api/soap','ApiController@getSoap');
});

//USUARIOS
Route::get('/users/{user}', 'UserController@getProfile');

//AJAX
Route::post('/busquedaAjax','UserController@postAjax');

//API
//REST
Route::get('api/rest/users', 'RestWebServiceController@getUsers');
Route::get('api/rest/reto/{id}', 'RestWebServiceController@getChallenge');
Route::get('api/rest/retos', 'RestWebServiceController@getChallenges');
Route::get('api/rest/user/{name}', 'RestWebServiceController@getUser');
//Route::delete('rest/borrar/{id}', 'RestWebServiceController@deleteBorrar');
//Route::post('rest/insertar', 'RestWebServiceController@postInsertar');
