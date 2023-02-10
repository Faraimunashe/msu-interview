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

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');

Route::get('/companies', 'App\Http\Controllers\CompaniesController@index')->middleware(['auth'])->name('companies');
Route::post('/create-company', 'App\Http\Controllers\CompaniesController@create')->middleware(['auth'])->name('create-company');
Route::post('/update-company', 'App\Http\Controllers\CompaniesController@store')->middleware(['auth'])->name('update-company');
Route::post('/delete-company', 'App\Http\Controllers\CompaniesController@delete')->middleware(['auth'])->name('delete-company');

Route::get('/employees', 'App\Http\Controllers\EmployeesController@index')->middleware(['auth'])->name('employees');
Route::post('/create-employee', 'App\Http\Controllers\EmployeesController@create')->middleware(['auth'])->name('create-employee');
Route::post('/update-employee', 'App\Http\Controllers\EmployeesController@store')->middleware(['auth'])->name('update-employee');
Route::post('/delete-employee', 'App\Http\Controllers\EmployeesController@delete')->middleware(['auth'])->name('delete-employee');
