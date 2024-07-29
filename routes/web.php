<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, "index"])->name("dashboard");

Route::resource("idea", IdeaController::class)->except(["index", "create", "show"])->middleware("auth");

Route::resource("idea", IdeaController::class)->only("show");

Route::resource("idea.comments", CommentController::class)->only("store")->middleware("auth");

// AUTH
Route::get("/register", [AuthController::class, "register"])->name("register");

Route::post("/register", [AuthController::class, "store"]);

Route::get("/login", [AuthController::class, "login"])->name("login");

Route::post("/login", [AuthController::class, "authenticate"]);

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

// USERS
Route::resource("users", UserController::class)->only("show", "edit", "update");

Route::get("profile", [UserController::class,"profile"])->name("profile")->middleware("auth");

// FOLLOWERS

Route::post("users/{user}/follow", [FollowController::class, "follow"])->middleware("auth")->name("users.follow");
Route::post("users/{user}/unfollow", [FollowController::class, "unfollow"])->middleware("auth")->name("users.unfollow");

// TERMS
Route::get('/terms', function() {
    return view("terms");
});
