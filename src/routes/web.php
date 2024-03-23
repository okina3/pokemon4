<?php

use App\Http\Controllers\BattleController;
use App\Http\Controllers\EnvsController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // バトルデータ管理画面
    Route::controller(BattleController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/show/{battle}', 'show')->name('show');
        Route::get('edit/{battle}', 'edit')->name('edit');
        Route::patch('update', 'update')->name('update');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });

    //環境管理画面
    Route::controller(EnvsController::class)->prefix('envs')->group(function () {
        Route::get('/', 'index')->name('envs.index');
        Route::post('/store', 'store')->name('envs.store');
        Route::delete('/destroy', 'destroy')->name('envs.destroy');
    });

    // ポケモン管理画面
    Route::controller(PokemonController::class)->prefix('pokemon')->group(function () {
        Route::get('/', 'index')->name('pokemon.index');
        Route::get('create', 'create')->name('pokemon.create');
        Route::post('store', 'store')->name('pokemon.store');
        Route::get('show/{pokemon}', 'show')->name('pokemon.show');
        Route::get('edit/{pokemon}', 'edit')->name('pokemon.edit');
        Route::patch('update', 'update')->name('pokemon.update');
        Route::delete('destroy', 'destroy')->name('pokemon.destroy');
    });


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
