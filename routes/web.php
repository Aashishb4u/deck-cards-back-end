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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/api/auth/signup', 'UserController@signUp');
Route::post('api/auth/login', 'LoginController@login');

//Route::post('api/auth/login', 'UserController@login');

//Route::post('/login','UserController@login');

Route::group(['prefix' => 'api/auth/', 'middleware' => ['App\Http\Middleware\AuthenticateUser']], function () {
    Route::post('/logout', 'LoginController@logout');
    Route::get('/getCards', 'UserController@getCards');

});