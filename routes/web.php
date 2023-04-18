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

Auth::routes();


Route::group(['middleware'=>'auth'],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/semesterDelete', [App\Http\Controllers\HomeController::class, 'semesterDelete'])->name('semesterDelete');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/show', [App\Http\Controllers\HomeController::class, 'show'])->name('show');
    Route::get('/experienceHome', [App\Http\Controllers\HomeController::class, 'experienceHome'])->name('experienceHome');
    Route::get('/resultTop', [App\Http\Controllers\HomeController::class, 'resultTop'])->name('resultTop');
    Route::get('/result', [App\Http\Controllers\HomeController::class, 'result'])->name('result');
    Route::get('/deleteHome', [App\Http\Controllers\HomeController::class, 'deleteHome'])->name('deleteHome');
    Route::get('/experienceDelete', [App\Http\Controllers\HomeController::class, 'experienceDelete'])->name('experienceDelete');
    Route::get('/reviewShow', [App\Http\Controllers\HomeController::class, 'reviewShow'])->name('reviewShow');
    Route::get('/evaluation', [App\Http\Controllers\HomeController::class, 'evaluation'])->name('evaluation');
    Route::get('/semester/{id}', [App\Http\Controllers\HomeController::class, 'semester'])->name('semester');
    Route::get('/subject/{id}', [App\Http\Controllers\HomeController::class, 'subject'])->name('subject');
    Route::get('/result/subject/{id}', [App\Http\Controllers\HomeController::class, 'resultSubject'])->name('resultSubject');
    Route::get('/experience/{id}', [App\Http\Controllers\HomeController::class, 'experience'])->name('experience');
    Route::get('/unit/{id}', [App\Http\Controllers\HomeController::class, 'unit'])->name('unit');
    Route::get('/purpose/{id}', [App\Http\Controllers\HomeController::class, 'purpose'])->name('purpose');
    Route::get('/unitCreate', [App\Http\Controllers\HomeController::class, 'unitCreate'])->name('unitCreate');
    Route::get('/purposeCreate', [App\Http\Controllers\HomeController::class, 'purposeCreate'])->name('purposeCreate');
    Route::get('/reviewCreate', [App\Http\Controllers\HomeController::class, 'reviewCreate'])->name('reviewCreate');
    Route::get('/studentTop', [App\Http\Controllers\HomeController::class, 'studentTop'])->name('studentTop');
    Route::get('/studentShow', [App\Http\Controllers\HomeController::class, 'studentShow'])->name('studentShow');
    Route::get('/studentReview', [App\Http\Controllers\HomeController::class, 'studentReview'])->name('studentReview');
    Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
    Route::post('/delete', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');
});
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
