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
Auth::routes();
Route::get('/', 'StudentController@Index');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/AddStu','StudentController@AddStu');
Route::post('/AddStuProcess', 'StudentController@AddStuProcess')->name('AddStu');
Route::middleware('auth')->get('/SeeStu', 'StudentController@SeeStu');
Route::middleware('auth')->post('/SeeStu/{term}', 'StudentController@TermFilter')->name('SeeStu');
Route::middleware('auth')->get('/EditStu/{student}', 'StudentController@EditStu')->name('EditStu');
Route::middleware('auth')->post('/UpdateStu/{student}', 'StudentController@UpdateStu')->name('UpdateStu');
Route::middleware('auth')->post('/DeleteStu/{student}', 'StudentController@DeleteStu')->name('DeleteStu');
//Reporting
Route::middleware('auth')->get('/ReportStu', 'StudentController@ReportStu');
Route::middleware('auth')->post('/ReportStu/{term}', 'StudentController@ReportTermFilter')->name('ReportStu');

Route::middleware('auth')->get('/SeeDegree', 'DegreeController@SeeDegree');
Route::middleware('auth')->get('/EditDegree/{degree}', 'DegreeController@EditDegree')->name('EditDegree');
Route::middleware('auth')->post('/UpdateDegree/{degree}', 'DegreeController@UpdateDegree')->name('UpdateDegree');

Route::middleware('auth')->get('/AddMaster','UserController@AddMaster');
Route::post('/AddMasterProcess', 'UserController@AddMasterProcess')->name('AddMaster');
Route::middleware('auth')->get('/SeeMaster', 'UserController@SeeMaster');
Route::middleware('auth')->get('/EditMaster/{user}', 'UserController@EditMaster')->name('EditMaster');
Route::middleware('auth')->post('/UpdateMaster/{user}', 'UserController@UpdateMaster')->name('UpdateMaster');
Route::middleware('auth')->post('/DeleteMaster/{user}', 'UserController@DeleteMaster')->name('DeleteMaster');

Route::middleware('auth')->get('/SeeStuMaster/{user}', 'UserController@SeeStuMaster')->name('SeeStuMaster');
Route::middleware('auth')->post('/SeeStuMaster/{term}', 'UserController@TermFilter')->name('SeeStuFilter');
//Reporting
Route::middleware('auth')->get('/ReportStuMaster', 'UserController@ReportStuMaster');
Route::middleware('auth')->post('/ReportStuMaster/{term}', 'UserController@ReportTermFilter')->name('ReportStuMaster');
