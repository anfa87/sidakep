<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendidikanController;

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


Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/pegawai/data-pegawai/laporan', [PegawaiController::class, 'laporan'])->middleware('admin');

Route::resource('/pegawai/data-pegawai', PegawaiController::class)->scoped(['data_pegawai' => 'kd_pegawai'])->except('store','create')->middleware('admin');

Route::resource('/jabatan', JabatanController::class)->scoped(['jabatan' => 'kd_jabatan'])->except('create','show','edit',)->middleware('admin');

Route::get('/pratinjau/ktp/{pegawai:kd_pegawai}', [PegawaiController::class, 'pratinjauKtp'])->middleware('auth');
Route::get('/pratinjau/kk/{pegawai:kd_pegawai}', [PegawaiController::class, 'pratinjauKk'])->middleware('auth');
Route::get('/pratinjau/akta_lahir/{pegawai:kd_pegawai}', [PegawaiController::class, 'pratinjauAkta'])->middleware('auth');
Route::get('/pratinjau/cv/{pegawai:kd_pegawai}', [PegawaiController::class, 'pratinjauCv'])->middleware('auth');
Route::get('/pratinjau/ijazah/{pendidikan}', [PendidikanController::class, 'pratinjauIjazah'])->middleware('auth');

Route::resource('/users', UserController::class)->except('show','store','create','edit')->middleware('admin');
Route::resource('/gaji', GajiController::class)->except('create','show')->middleware('admin');

Route::resource('/pendidikan', PendidikanController::class)->except('show','create')->middleware('auth');
Route::post('/pegawai/data-pegawai/pendidikan/{pendidikan}', [PendidikanController::class, 'hapusPendidikan'])->middleware('auth');



Route::resource('/kegiatan', KegiatanController::class)->except('show')->middleware('auth');

Route::resource('/profil', ProfilController::class)->scoped(['profil' => 'kd_pegawai'])->except('index','store','create','destroy')->middleware('auth');

Route::post('/profil/user/{user:id}', [ProfilController::class, 'updateAkun'])->middleware('auth');


