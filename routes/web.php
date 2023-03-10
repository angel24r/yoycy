<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomersController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function(){
    return view('auth.login');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/customers', [CustomersController::class, 'getCustomers'])->name('customers.getCustomers');
    Route::patch('/customers', [CustomersController::class, 'updateCustomers'])->name('customers.updateCustomers');
    Route::delete('/customers', [CustomersController::class, 'destroyCustomers'])->name('customers.destroyCustomers');
});

require __DIR__.'/auth.php';
