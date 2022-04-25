<?php

use App\Models\Records;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RecordsController;


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
Route::get('/', function(){
    if(!isset(Auth::user()->id)){
        return redirect("/login");
    }
    return view('records.index')->with("records",Records::all());
});

Route::get('/home', function(){
    return redirect("/");
});

Route::get("/export_db",[RecordsController::class,"download"]);

Route::get('/search',[ RecordsController::class,"search"])->name('search');

Route::get("/newest",[ RecordsController::class,"filterNewst"]);

Route::get("records/{id}",[RecordsController::class,"view"]);

Route::get('/create', function(){
    return view('records.create');
});
