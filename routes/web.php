<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AccountGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\DocumentController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('accountgroups', [AccountGroupController::class, 'index'])
    ->name('accountgroups')
    ->middleware('auth');

Route::get('accountgroups/create', [AccountGroupController::class, 'create'])
    ->name('accountgroups.create')
    ->middleware('auth');

Route::get('accountgroups/{accountgroup}', [AccountGroupController::class, 'show'])
    ->name('accountgroups.show')
    ->middleware('auth');

Route::post('accountgroups', [AccountGroupController::class, 'store'])
    ->name('accountgroups.store')
    ->middleware('auth');

Route::get('accountgroups/{accountgroup}/edit', [AccountGroupController::class, 'edit'])
    ->name('accountgroups.edit')
    ->middleware('auth');

Route::put('accountgroups/{accountgroup}', [AccountGroupController::class, 'update'])
    ->name('accountgroups.update')
    ->middleware('auth');

Route::delete('accountgroups/{accountgroup}', [AccountGroupController::class, 'destroy'])
    ->name('accountgroups.destroy')
    ->middleware('auth');


    //my code
    Route::get('users', [UserController::class, 'index'])
    ->name('users')
    ->middleware('auth');


    Route::get('companies', [CompanyController::class, 'index'])
    ->name('companies')
    ->middleware('auth');

    Route::get('companies/create', [CompanyController::class, 'create'])
    ->name('companies.create')
    ->middleware('auth');

    // Route::get('accountgroups/{accountgroup}', [AccountGroupController::class, 'show'])
    // ->name('accountgroups.show')
    // ->middleware('auth');

    Route::post('companies', [CompanyController::class, 'store'])
    ->name('companies.store')
    ->middleware('auth');

Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])
    ->name('companies.edit')
    ->middleware('auth');

Route::put('companies/{company}', [CompanyController::class, 'update'])
    ->name('companies.update')
    ->middleware('auth');

Route::delete('companies/{company}', [CompanyController::class, 'destroy'])
    ->name('companies.destroy')
    ->middleware('auth');



    Route::get('accounts', [AccountController::class, 'index'])
    ->name('accounts')
    ->middleware('auth');

    Route::get('accounts/create', [AccountController::class, 'create'])
    ->name('accounts.create')
    ->middleware('auth');

    // Route::get('accountgroups/{accountgroup}', [AccountGroupController::class, 'show'])
    // ->name('accountgroups.show')
    // ->middleware('auth');

    Route::post('accounts', [AccountController::class, 'store'])
    ->name('accounts.store')
    ->middleware('auth');

Route::get('accounts/{account}/edit', [AccountController::class, 'edit'])
    ->name('accounts.edit')
    ->middleware('auth');

Route::put('accounts/{account}', [AccountController::class, 'update'])
    ->name('accounts.update')
    ->middleware('auth');

Route::delete('accounts/{account}', [AccountController::class, 'destroy'])
    ->name('accounts.destroy')
    ->middleware('auth');


    Route::get('documenttypes', [DocumentTypeController::class, 'index'])
    ->name('documenttypes')
    ->middleware('auth');

    Route::get('documenttypes/create', [DocumentTypeController::class, 'create'])
    ->name('documenttypes.create')
    ->middleware('auth');

//     // Route::get('accountgroups/{accountgroup}', [AccountGroupController::class, 'show'])
//     // ->name('accountgroups.show')
//     // ->middleware('auth');

    Route::post('documenttypes', [DocumentTypeController::class, 'store'])
    ->name('documenttypes.store')
    ->middleware('auth');

Route::get('documenttypes/{documenttype}/edit', [DocumentTypeController::class, 'edit'])
    ->name('documenttypes.edit')
    ->middleware('auth');

Route::put('documenttypes/{documenttype}', [DocumentTypeController::class, 'update'])
    ->name('documenttypes.update')
    ->middleware('auth');

Route::delete('documenttypes/{documenttype}', [DocumentTypeController::class, 'destroy'])
    ->name('documenttypes.destroy')
    ->middleware('auth');

    
    Route::get('documents', [DocumentController::class, 'index'])
    ->name('documents')
    ->middleware('auth');

    Route::get('documents/create', [DocumentController::class, 'create'])
    ->name('documents.create')
    ->middleware('auth');

// //     // Route::get('accountgroups/{accountgroup}', [AccountGroupController::class, 'show'])
// //     // ->name('accountgroups.show')
// //     // ->middleware('auth');

//     Route::post('documenttypes', [DocumentTypeController::class, 'store'])
//     ->name('documenttypes.store')
//     ->middleware('auth');

// Route::get('documenttypes/{documenttype}/edit', [DocumentTypeController::class, 'edit'])
//     ->name('documenttypes.edit')
//     ->middleware('auth');

// Route::put('documenttypes/{documenttype}', [DocumentTypeController::class, 'update'])
//     ->name('documenttypes.update')
//     ->middleware('auth');

// Route::delete('documenttypes/{documenttype}', [DocumentTypeController::class, 'destroy'])
//     ->name('documenttypes.destroy')
//     ->middleware('auth');