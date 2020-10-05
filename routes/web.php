<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Config;

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

$user = new User;
$numOfAdmins = $user->get_num_of_admins();
$allowRegister = Config::getConfigValueOf('allowRegister');
if (! $allowRegister && ! $numOfAdmins) $allowRegister = 1;
if (! $allowRegister){
  Auth::routes([
      'register' => false
  ]);
}else {
  Auth::routes();
}

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/home/{selectedTmima?}/{date?}', 'HomeController@index')->name('home');
Route::post('/home/{selectedTmima?}/{date?}', 'HomeController@index')->name('save');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/export', 'AdminController@export')->name('export');

Route::post('/export/apouxls', 'AdminController@exportApousiesXls')->name('apouxls');
Route::get('/export/kathxls', 'AdminController@exportKathigitesXls')->name('kathxls');
Route::get('/export/mathxls', 'AdminController@exportMathitesXls')->name('mathxls');
Route::get('/export/progxls', 'AdminController@exportProgramXls')->name('progxls');

Route::post('/insertusers', 'AdminController@insertUsers')->name('insertusers');
Route::post('/insertstudents', 'AdminController@insertStudents')->name('insertstudents');
Route::post('/insertprogram', 'AdminController@insertProgram')->name('insertprogram');
Route::post('/set', 'AdminController@setConfigs')->name('set');

Route::get('/delkath', 'AdminController@delKathigites')->name('delkath');
Route::get('/delmath', 'AdminController@delStudents')->name('delmath');
Route::get('/delprog', 'AdminController@delProgram')->name('delprog');
Route::get('/delapou/{keep?}', 'AdminController@delApousies')->name('delapou');
