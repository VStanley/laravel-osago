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

Route::get('/', 'Front\CalculateController@index');
Route::post('/calculate', 'Front\CalculateController@calculate')->name('calculate');
Route::get('/calculate/getData', 'Front\CalculateController@getData');
Route::get('/oformit-osago', 'Front\OformitController@index');
Route::get('/proverit-osago', 'Front\ProveritController@index');
Route::get('/uznat-svoj-kbm', 'Front\KbmController@index');
Route::get('/informaciya', 'Front\InformaciyaController@index');
Route::get('/kontakty', 'Front\KontaktyController@index');

Route::group(['middleware' => 'guest', 'namespace'=>'Auth'], function () {
    Route::get('/lomantine', 'LoginController@index');
    Route::post('/lomantine', 'LoginController@auth');
});

Route::group(['middleware' => 'admin'], function (){
    Route::get('/dashboard', 'Admin\DashboardController@index');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::resource('/dashboard/pages', 'Admin\PagesController');
    Route::resource('/dashboard/regionsCoefficients', 'Admin\RegionsCityCoefficients')->name('get','regionsCoefficients');
    Route::resource('/dashboard/autoCategories', 'Admin\AutoCategoriesController');
    Route::resource('/dashboard/somePrices', 'Admin\SomePricesController');
});
