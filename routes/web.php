<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index');
Route::resource('Gasoil', 'GasoilController')->middleware('auth') ;
Route::resource('Kilometrage', 'KilometrageController')->middleware('auth');
Route::resource('Alimentation_Cuve', 'AlimentationCuveController')->middleware('auth');
Route::resource('User', 'UserController')->middleware('auth');
Route::resource('Fournisseur', 'FournisseurController')->middleware('auth');
Route::resource('Cuve', 'CuveController')->middleware('auth');
Route::resource('Unite', 'UniteController')->middleware('auth');
Route::resource('Vehicule', 'VehiculeController')->middleware('auth');
Route::resource('Marque', 'MarqueController')->middleware('auth');
Route::resource('Modele', 'ModeleController')->middleware('auth');

Auth::routes(['register'=>false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/excel', 'ExcelController@import')->name('excelimport')->middleware('auth');
Route::post('/Vgasoil', 'GasoilController@Vgasoil')->middleware('auth');
Route::post('/Alimentationcuvefilter', 'AlimentationCuveController@indexdate')->middleware('auth');
Route::post('/gasoilfilter', 'GasoilController@gasoilfilter')->middleware('auth');
Route::get('/createstatsvehicule', 'VehiculeController@statsvehicule')->middleware('auth');
Route::get('/Gasoil/pdfgasoil/{id}', 'GasoilController@printpdf')->middleware('auth')->name('gasoilpdf');


