<?php

use App\Http\Livewire\Expense;
use App\Http\Livewire\Plan;
use App\Http\Livewire\Payment;
use App\Services\PagSeguro\Subscription\SubscriptionReaderService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    
    Route::get('/subscription/{plan:slug}', Payment\CreditCard::class)->name('plans.subscription');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::prefix('expenses')->name('expenses.')->prefix('expenses/')->group(function () {
        Route::get('/', Expense\Index::class)->name('index');
        Route::get('/create', Expense\Create::class)->name('create');

        Route::prefix('{expense}')->group(function () {
            Route::get('/edit', Expense\Edit::class)->name('edit');
            Route::get('/photo', function ($expense) {
                $expense = auth()->user()->expenses()->findOrFail($expense);

                if (empty($expense->photo) || !Storage::exists($expense->photo)) {
                    return abort(Response::HTTP_NOT_FOUND, 'Image not found');
                }

                $typeImage = Storage::mimeType($expense->photo);
                $image = Storage::get($expense->photo);
                return response($image)->header('Content-Type', $typeImage);
            })->name('photo');
        });
    });

    Route::prefix('plans')->name('plans.')->prefix('plans/')->group(function () {
        Route::get('/', Plan\Index::class)->name('index');
        Route::get('/create', Plan\Create::class)->name('create');
    });
});
