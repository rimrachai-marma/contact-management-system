<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("guest")->controller(AuthController::class)->group(function (){
    Route::get("/register",  "showRegister")->name("show.register");
    Route::get("/login",  "showLogin")->name("show.login");

    Route::post("/register",  "register")->name("register");
    Route::post("/login",  "login")->name("login");
});

Route::middleware(['auth'])->group(function () {
    Route::resource('contacts', ContactController::class);

    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    Route::patch('/contacts/{contact}/toggle-started', [ContactController::class, 'toggleStarted'])->name('contacts.toggleStarted');

    // Admin routes for testing purposes 
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            Gate::authorize('access-dashboard');
            return view('admin.dashboard');
        })->name('dashboard');
    });
});


// Laravel resource routes for a handles CRUD (Create, Read, Update, Delete) operations

// | Method    | URI                      | Action  | Route Name       |
// | --------- | ------------------------ | ------- | ---------------- |
// | GET       | /contacts                | index   | contacts.index   |
// | GET       | /contacts/create         | create  | contacts.create  |
// | POST      | /contacts                | store   | contacts.store   |
// | GET       | /contacts/{contact}      | show    | contacts.show    |
// | GET       | /contacts/{contact}/edit | edit    | contacts.edit    |
// | PUT/PATCH | /contacts/{contact}      | update  | contacts.update  |
// | DELETE    | /contacts/{contact}      | destroy | contacts.destroy |

// for specific routes
// Route::resource('contacts', ContactController::class)->only(['index', 'show']);

// for exclude some routes
// Route::resource('contacts', ContactController::class)->except(['edit', 'update']);

// for nested
// /users/{user}/contacts // like so
// Route::resource('users.contacts', ContactController::class);

