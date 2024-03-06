<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;
use App\Models\Tenant;
use Illuminate\Support\Facades\Artisan;


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
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    // if (!function_exists('finfo_file')) { echo ' [ERROR] Fileinfo extension is NOT enabled.'; } else { echo ' [OK] Fileinfo extension is enabled.'; }
    // echo phpinfo();
     return '<h1>Clear cleared</h1>';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('create-tenant',[TenantController::class,'index'])->name('createTenant');
Route::post('store-user',[TenantController::class,'store'])->name('store.user');

Route::delete('/delete-tenant/{tenant}', [TenantController::class,'destroy'])->name('deleteTenant');
Route::get('/tenant/edit/{id}', [TenantController::class,'edit'])->name('tenants.edit');

// web.php

Route::get('/dashboard', function () {
    $tenants = Tenant::with('domains')->get();
    return view('dashboard',['tenants' => $tenants]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
