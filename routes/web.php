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

Route::get('/search', 'PagesController@search');
Route::any('/search/result', 'PagesController@result');
Route::get('/validate', 'PagesController@validateVacancy');
Route::get('/accounts/edit', 'PagesController@settings');
Route::post('/accounts/edit', 'PagesController@changePassword')->name('change.password');

Route::get('/getCity/{id}','PagesController@getCity');
Route::get('/getDistrict/{id}','PagesController@getDistrict');
Route::get('/getPostalCode/{id}','PagesController@getPostalCode');


Route::get('/auth/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/myvacancy', 'ApplicantControler@appliedJob');
Route::get('/reporting/create', 'ApplicantControler@request');
Route::post('/reporting/create', 'ApplicantControler@storeReport')->name('store.reporting');

Route::get('/verify', 'CompanyController@viewVerify');
Route::post('/verify', 'CompanyController@requestVerify')->name('store.verify');
Route::get('/vacancy/{id}/list', 'CompanyController@listApplicantVacancy');
Route::post('/register/company', 'CompanyController@register');

Route::get('/vacancy/{vacancy_id}/portofolio/{user_id}', 'PortofolioController@checkPortofolio');
Route::get('/vacancy/{vacancy_id}/portofolio/{user_id}/send-interview', 'PortofolioController@sendInterview');
Route::post('/vacancy/{vacancy_id}/portofolio/{user_id}/send-interview', 'PortofolioController@saveInterview')->name('store.interview');

Route::resource('portofolio', 'PortofolioController');
Route::resource('company', 'CompanyController');
Route::resource('vacancy', 'VacancyController');

