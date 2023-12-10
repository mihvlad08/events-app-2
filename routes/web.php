<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});


/* User routes */
Route::get('/register', function () {
    echo 1;
});
Route::post('/register', function () {
    echo 1;
});

Route::get('/login', function () {
    echo 1;
});
Route::post('/login', function () {
    echo 1;
});

/* Admin routes */
Route::get('/loginAdmin', function () {
    return view('admin/loginAdmin');
})->name('loginAdminGET');
Route::post('/loginAdmin', [AdminAuthController::class, 'login'])->name('loginAdminPOST');

Route::middleware(['admin'])->group(function () {
    Route::get('/adminDashboard', function () {
        return view('admin/adminDashboard');
    })->name('adminDashboardGET');
});
