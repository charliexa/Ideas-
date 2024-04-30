<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, "index"])->name("dashboard");

Route::group(["prefix"=> "ideas/", "as"=> "idea."], function () {

    Route::post("", [IdeaController::class, "store"])->name("create");

    Route::get("{idea}", [IdeaController::class, "show"])->name("show");

    Route::group(["middleware" => ["auth"]], function () {

        Route::get("{idea}/edit", [IdeaController::class, "edit"])->name("edit");

        Route::put("{idea}", [IdeaController::class, "update"])->name("update");

        Route::delete("{idea}", [IdeaController::class, "destroy"])->name("destroy");

        Route::post("{idea}/comments", [CommentController::class, "store"])->name("comments.create");

    });

});

Route::get("/register", [AuthController::class, "register"])->name("register");

Route::post("/register", [AuthController::class, "store"]);

Route::get("/login", [AuthController::class, "login"])->name("login");

Route::post("/login", [AuthController::class, "authenticate"]);

Route::post("/logout", [AuthController::class, "logout"])->name("logout");

Route::get('/terms', function() {
    return view("terms");
});
