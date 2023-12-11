<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\EventController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Event as Event;

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

    Route::get('/createNewEvent', function () {
        return view('admin/createNewEvent');
    })->name('createNewEvent');
    Route::post('/createNewEvent', [EventController::class, 'create'])->name('createNewEventPOST');

    Route::get('/seeEvents', function () {
        $events = Event::all();
        return view('admin/seeEvents')->with('events' , $events);
    })->name('seeEvents');

    Route::get('/deleteAllEvents', [EventController::class, 'deleteAll'])->name('deleteAllEvents');
    Route::get('/delete-event/{id}', [EventController::class, 'deleteEvent'])->name('deleteEvent');

    Route::get('/edit-event/{id}', [EventController::class, 'editEvent'])->name('editEventGET');
    Route::post('/update-event/{id}', [EventController::class, 'updateEvent'])->name('updateEvent');
});


Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
Route::get('/logout-user', [UserAuthController::class, 'logout'])->name('logout-user');


Route::get('/register-user', function () {
    return view('userRegistration');
})->name('userRegisterGET');
Route::post('/register-user', [UserAuthController::class, 'register'])->name('userRegistrationPOST');

Route::get('/login-user', function () {
    return view('loginUser');
})->name('userLoginGET');
Route::post('/login-user', [UserAuthController::class, 'login'])->name('userLoginPOST');


Route::middleware(['admin2'])->group(function () {
    Route::get('/user-dashboard', function () {
        return view('userDashboard');
    })->name('userDashboardGET');
});
