<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BljrController;
use App\Http\Middleware\LoginCheck;
use App\Http\Middleware\LoggedIn;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/coba', function () {
    return 'haiiii';
});
Route::get('/coba/cobasaja', function () {
    return view('cobaview');
});
Route::get('/dashboard', [BljrController::class, 'tampiladmin'])->name('dashboard.admin');

Route::get('/cobacontroller', [BljrController::class, 'tampil']);
Route::get('/cobacontroller2', [BljrController::class, 'tampil2']);

Route::middleware(LoginCheck::class)->group(function()
{
    Route::get('/login', [BljrController::class, 'login'])->name('loginadmin');
    Route::post('/proseslogin', [BljrController::class, 'proseslogin'])->name('loginproses');
});

Route::middleware(LoggedIn::class)->group(function(){
     // Admin
     Route::get('/cobaadmin', [BljrController::class, 'tampiladmin'])->name('dashboard.admin');
     Route::get('/listbarang', [BljrController::class, 'listbarang'])->name('listbarang');
     Route::get('/formhitung', [BljrController::class, 'fhitung'])->name('formhitung');
     Route::post('/proseshitung', [BljrController::class, 'calculate'])->name('proseshitung');
     Route::get('/listgempa', [BljrController::class, 'listgempa'])->name('datagempa');
     // Account
     Route::get('/formregister', [BljrController::class, 'fregister'])->name('formregister');
     Route::post('/prosesregister', [BljrController::class, 'daftar'])->name('prosesregister');
     Route::get('/edituser/{id}', [BljrController::class, 'editUser'])->name('useredit');
     Route::post('/updateuser/{id}', [BljrController::class, 'updateuser'])->name('updateuser');
     Route::delete('/userdelete/{id}', [BljrController::class, 'deleteUser'])->name('userdelete');
     Route::post('/logout', [BljrController::class, 'logout'])->name('logout');
});