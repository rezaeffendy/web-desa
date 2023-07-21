<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataVaksinController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\VaksinController;
use App\Models\Penduduk;
use App\Models\Vaksin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [AppController::class, 'index']);

Route::get('/reload/captcha', CaptchaController::class);

Route::middleware(['guest'])->group(function () {
    Route::get('auth', [AuthLoginController::class, 'index']);
    Route::post('auth', [AuthLoginController::class, 'proccess']);
    Route::get('auth/register', [RegisterController::class, 'index']);
    Route::post('auth/register', [RegisterController::class, 'proccess']);
    Route::get('siteman/login', [LoginController::class, 'login']);
    Route::post('siteman/login', [LoginController::class, 'proses']);
});

Route::get('vaksin', DataVaksinController::class);

Route::get('berita', [BeritaController::class, 'showAll']);
Route::get('berita/{slug}', [BeritaController::class, 'show']);

Route::get('formulir/{tipe}', [FormulirController::class, 'index']);
Route::post('formulir/{tipe}', [FormulirController::class, 'store']);

Route::prefix('tentang')->group(function () {
    Route::get('visi-misi', function () {
        $data = [
            'title' => 'Visi Misi',
            'title1' => 'Home',
        ];

        return view('landing.tentang.visi-misi', $data);
    });

    Route::get('profil-wilayah', function () {
        $data = [
            'title' => 'Profil Wilayah',
            'title1' => 'Home',
        ];

        return view('landing.tentang.profil-wilayah', $data);
    });

    Route::get('map', function () {
        $data = [
            'title' => 'Maps',
            'title1' => 'Home',
        ];

        return view('landing.tentang.map', $data);
    });
});

Route::prefix('penduduk')->group(function () {
    Route::get('logout', [AuthLoginController::class, 'logout']);
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/profil', [AkunController::class, 'show']);
    Route::put('/profil', [AkunController::class, 'proccess']);

    Route::get('formulir', [SuratController::class, 'index']);
    Route::get('formulir/{tipe}', [SuratController::class, 'show']);
    Route::post('formulir', [SuratController::class, 'store']);

    Route::post('vaksin', [VaksinController::class, 'store']);
});

Route::middleware(['autentikasi'])->group(function () {
    Route::prefix('api/v1/')->group(function () {
        Route::get('/formulir/image/{id}', [FormulirController::class, 'showImage']);
        Route::get('/sertifikat/image/{id}', [VaksinController::class, 'showImage']);
    });

    Route::get('auth/logout', [LoginController::class, 'logout']);

    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        Route::resource('akun', AkunController::class);

        Route::get('surat/{tipe}', [FormulirController::class, 'show']);
        Route::get('surat/cetak/{tipe}/{id}', [FormulirController::class, 'cetak']);
        Route::delete('surat/{tipe}/{id}', [FormulirController::class, 'destroy']);

        Route::resource('berita', BeritaController::class);

        Route::resource('vaksin', VaksinController::class);

        Route::post('penduduk/reset/{id}', [PendudukController::class, 'reset']);
        Route::resource('penduduk/tetap', PendudukController::class);
        Route::post('penduduk/tetap/upload', [PendudukController::class, 'import']);
        Route::get('penduduk/tetap/download', [PendudukController::class, 'export']);
        Route::get('penduduk/baru', [PendudukController::class, 'view']);
        Route::put('penduduk/baru/{id}', [PendudukController::class, 'validasi']);
        Route::get('penduduk/tetap/{id}', [PendudukController::class, 'edit']);
    });
});
