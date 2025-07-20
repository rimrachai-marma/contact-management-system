<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
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
});



// Route::middleware("auth")->controller(ContactController::class)->group(function () {
//     Route::get("/contacts", "index")->name("contacts.index");

//     Route::get("/contacts/create", "create")->name("contacts.create");
//     Route::post("/contacts", "store")->name("contacts.store");

//     // Route::get("/contacts/{id}", "show")->name("contacts.show");
//     Route::get("/contacts/{contact}", "show")->name("contacts.show");

//     // Route::get("/contacts/{id}/edit", "edit")->name("contacts.edit");
//     Route::get("/contacts/{contact}/edit", "edit")->name("contacts.edit");
//     // Route::patch("/contacts/{id}", "update")->name("contacts.update");
//     Route::patch("/contacts/{contact}", "update")->name("contacts.update");

//     // Route::delete("/contacts/{id}", "destroy")->name("contacts.destroy");
//     Route::delete("/contacts/{contact}", "destroy")->name("contacts.destroy");

//     Route::patch('/contacts/{contact}/toggle-started', 'toggleStarted')->name('contacts.toggleStarted');
// });