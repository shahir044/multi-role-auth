<?php

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Route::group(['middleware' => ['role:super-admin|admin']], function() {
    Route::group(['middleware' => ['role:super-admin|admin']], function() {
        Route::resource('permissions', App\Http\Controllers\Sya\PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\Sya\PermissionController::class, 'destroy']);

        Route::resource('roles', App\Http\Controllers\Sya\RoleController::class);
        Route::get('roles/{roleId}/delete', [App\Http\Controllers\Sya\RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\Sya\RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\Sya\RoleController::class, 'givePermissionToRole']);

        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    });

    Route::group(['middleware' => ['role:super-admin']], function() {
        Route::get('/superadmin-page',function (){
            return view('pages.super-admin');
        })->name('superadmin-page');
    });

    Route::group(['middleware' => ['role:admin']], function() {
        Route::get('/admin-page',function (){
            return view('pages.admin');
        })->name('admin-page');
    });

    Route::group(['middleware' => ['role:user']], function() {
        Route::get('/user-page',function (){
            return view('pages.user');
        })->name('user-page');
    });

    Route::group(['middleware' => ['role:admin-cell']], function() {
        Route::get('/admincell-page',function (){
            return view('pages.admin-cell');
        })->name('admincell-page');
    });

});

require __DIR__.'/auth.php';
