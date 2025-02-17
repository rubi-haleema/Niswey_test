<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

//crud contacts
Route::get('/', [ContactController::class, 'index']);
Route::get('index', [ContactController::class, 'index']);

Route::get('/add', [ContactController::class, 'add'])->name('add');
Route::post('/add', [ContactController::class, 'addSubmit']);

Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('edit');
Route::post('/edit', [ContactController::class, 'editSubmit']);
Route::get('/delete/{id}', [ContactController::class, 'delete'])->name('delete');

//xml file import
Route::match(["get", "post"], "read-xml", [ContactController::class, "xmlUpload"])->name('xml-upload');