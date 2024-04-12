<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, "index"])->name("dashboard");

Route::post("/idea", [IdeaController::class, "store"])->name("idea.create");

Route::get("/idea/{idea}", [IdeaController::class, "show"])->name("idea.show");

Route::get("/idea/{idea}/edit", [IdeaController::class, "edit"])->name("idea.edit");

Route::delete("/idea/{idea}", [IdeaController::class, "destroy"])->name("idea.destroy");

Route::get('/terms', function() {
    return view("terms");
});
