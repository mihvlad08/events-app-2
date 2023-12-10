<?php

use Illuminate\Support\Facades\Route;
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
    echo 1;
});
Route::post('/loginAdmin', function () {
    echo 1;
});