<?php

use App\Http\Livewire\Expense;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::prefix('expenses')->name('expenses.')->prefix('expenses/')->group(function(){
        Route::get('/', Expense\Index::class)->name('index');
        Route::get('/create', Expense\Create::class)->name('create');
        Route::get('/edit/{expense}', Expense\Edit::class)->name('edit');
    });
});
