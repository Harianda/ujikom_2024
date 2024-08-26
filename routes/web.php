<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CamabaController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/register', [LoginController::class, 'userRegis'])->name('admin.register');
Route::post('/admin/register', [LoginController::class, 'userProsesAdd'])->name('admin.userProsesAdd');

//- [Login/Logout User Lain] -- \\
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showlogin')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');

Route::get('/logout', function (Request $request) {
    $LoginController = new LoginController();
    return $LoginController->logout($request, 'pengguna');
})->name('logout');

Route::middleware(['admin'])->group(function () {
    //- [Admin] -- \\
    Route::get('/admin/pendaftar/listpendaftar', [AdminController::class, 'listPendaftarShow'])->name('admin.pendaftar.listpendaftar');
    Route::get('/admin/pendaftar/create', [AdminController::class, 'pendaftarShowCreate'])->name('admin.pendaftar.create');
    Route::get('/admin/pendaftar/edit/{id}', [AdminController::class, 'pendaftarShowEdit'])->name('admin.pendaftar.edit');


    Route::post('/admin/pendaftar/create/proses', [AdminController::class, 'pendaftarProsesAdd'])->name('admin.pendaftar.create.proses');
    Route::post('/admin/edit/proses/{id}', [AdminController::class, 'editProses'])->name('admin.edit.proses');
    Route::post('/admin/pendaftar/delete/proses/{id}', [AdminController::class, 'pendaftarProsesDelete'])->name('admin.pendaftar.delete.proses');

    //- [User Master] -- \\
    Route::get('/admin/user/listuser', [UserController::class, 'userShow'])->name('admin.user.listuser');
    Route::get('/admin/user/create', [UserController::class, 'userShowCreate'])->name('admin.user.create');
    Route::get('/admin/user/edit', [UserController::class, 'userShowEdit'])->name('admin.user.edit');

    Route::post('/admin/create/proses', [UserController::class, 'userProsesAdd'])->name('user.add.proses');
    Route::post('/admin/user/edit/proses', [UserController::class, 'userProsesEdit'])->name('user.edit.proses');
    Route::post('/admin/user/delete/proses', [UserController::class, 'userProsesDelete'])->name('user.delete.proses');
});


Route::middleware(['camaba'])->group(function () {

    Route::get('/camaba/pendaftar/listpendaftar', [CamabaController::class, 'listPendaftarShow'])->name('camaba.pendaftar.listpendaftar');
    Route::get('/camaba/pendaftar/create', [CamabaController::class, 'pendaftarShowCreate'])->name('camaba.pendaftar.create');
    Route::get('/camaba/pendaftar/edit/{id}', [CamabaController::class, 'pendaftarShowEdit'])->name('camaba.pendaftar.edit');

    Route::post('/camaba/pendaftar/create/proses', [CamabaController::class, 'pendaftarProsesAdd'])->name('camaba.pendaftar.create.proses');
    Route::post('/camaba/edit/proses/{id}', [CamabaController::class, 'editProses'])->name('camaba.edit.proses');
    Route::post('/camaba/pendaftar/delete/proses/{id}', [CamabaController::class, 'pendaftarProsesDelete'])->name('camaba.pendaftar.delete.proses');
});
