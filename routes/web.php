<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;
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
    /*return view('welcome');*/
    return view('auth.login');
});

Route::get('/testroute', function() {
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
    // The email sending is done using the to method on the Mail facade
    $status = Mail::to('shahir.rahman3502@gmail.com')->send(new MyTestEmail($details));
    echo "Mail send success";
    /*try{
        $status = Mail::to('testreceiver@gmail.com')->send(new MyTestEmail($details));
        return $status;
    }catch (Exception $e){
        throw new Error($e);
    }*/
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// user routes
Route::prefix('user')->group(function(){
    Route::get('form', [\App\Http\Controllers\User\UserController::class, 'create'])->name('user.form');
    Route::post('form', [\App\Http\Controllers\User\UserController::class, 'store'])->name('user.form.submit');

    Route::get('current-status', [\App\Http\Controllers\User\UserController::class, 'currentStatusIndex'])->name('current-status.index');
    Route::post('current-status', [\App\Http\Controllers\User\UserController::class, 'currentStatusPost'])->name('current-status.post');
});

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

        Route::resource('users', \App\Http\Controllers\Sya\UserController::class);
        Route::get('users/{userId}/delete', [\App\Http\Controllers\Sya\UserController::class, 'destroy']);

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
        Route::get('/admincell-page',[App\Http\Controllers\Sya\AdminCellController::class,'index'])->name('admincell-page');

        Route::post('/admincell',[App\Http\Controllers\Sya\AdminCellController::class,'store'])->name('admincell.store');
        Route::get('/admincell/{formNo}/{app_id}',[App\Http\Controllers\Sya\AdminCellController::class,'show'])->name('admincell.show');
        Route::put('/admincell/{formNo}',[App\Http\Controllers\Sya\AdminCellController::class,'update'])->name('admincell.update');
        Route::get('/admincell/{formNo}/edit',[App\Http\Controllers\Sya\AdminCellController::class,'edit'])->name('admincell.edit');

    });

    Route::group(['middleware' => ['role:dept-approval']], function() {
        Route::resource('dept-approval',\App\Http\Controllers\Sya\DeptApprovalController::class)->names('deptapproval');
        Route::get('/dept-approval/{formNo}/{app_id}',[App\Http\Controllers\Sya\DeptApprovalController::class,'show'])->name('deptapproval.show');

    });

    Route::group(['middleware' => ['role:id-section']], function() {
        Route::resource('idsection',\App\Http\Controllers\Sya\IdSectionController::class)->names('idsection');
        Route::get('/idsection/{formNo}/{app_id}',[App\Http\Controllers\Sya\IdSectionController::class,'show'])->name('idsection.show');
        Route::get('email-page',[App\Http\Controllers\Sya\IdSectionController::class,'emailPage'])->name('idsection.email');
        Route::post('email-page',[App\Http\Controllers\Sya\IdSectionController::class,'sendEmail'])->name('idsection.sendemail');
    });

    Route::group(['middleware' => ['role:gm-security']], function() {
        Route::resource('gmsecurity',\App\Http\Controllers\Sya\SecurityDivisionController::class)->names('gmsecurity');
        Route::get('/gmsecurity/{formNo}/{app_id}',[App\Http\Controllers\Sya\SecurityDivisionController::class,'show'])->name('gmsecurity.show');
    });

    Route::get('card-current-status',[\App\Http\Controllers\Sya\CurrentStatusController::class, 'index'])->name('admin-card-status');

});



require __DIR__.'/auth.php';
