<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'PagesController@index');

Route::get('/register/applicant', 'PagesController@regisApplicant');

Route::get('/register/company', 'PagesController@regisCompany');

Route::get('/auth/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reporting/create', 'ApplicantControler@request');
Route::get('/verify', 'CompanyController@request');
Route::get('/vacancies', 'CompanyController@ShowVcy');
Route::get('/vacancy/create', 'CompanyController@createVcy');

Route::resource('portofolio', 'PortofolioController');
Route::resource('company', 'CompanyController');

