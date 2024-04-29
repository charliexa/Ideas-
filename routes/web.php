<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, "index"])->name("dashboard");

Route::post("/idea", [IdeaController::class, "store"])->name("idea.create");

Route::get("/idea/{idea}", [IdeaController::class, "show"])->name("idea.show");

Route::get("/idea/{idea}/edit", [IdeaController::class, "edit"])->name("idea.edit");

Route::put("/idea/{idea}", [IdeaController::class, "update"])->name("idea.update");

Route::delete("/idea/{idea}", [IdeaController::class, "destroy"])->name("idea.destroy");

Route::post("/idea/{idea}/comments", [CommentController::class, "store"])->name("idea.comments.create");

Route::get("/register", [AuthController::class, "register"])->name("register");

Route::post("/register", [AuthController::class, "store"]);

Route::get("/login", [AuthController::class, "login"])->name("login");

Route::post("/login", [AuthController::class, "authenticate"]);

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get('/terms', function() {
    return view("terms");
});
