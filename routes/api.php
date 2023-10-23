<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/movie')->group(function () {
    Route::get("/get", [MovieController::class, 'get'])->name("movie.get");
    Route::post("/add", [MovieController::class, 'create'])->name("movie.add");
    Route::put("/update/{id}", [MovieController::class, 'update'])->name("movie.update");
    Route::delete("/delete/{id}", [MovieController::class, 'delete'])->name("movie.delete");
});

Route::prefix('user')->group(function () {
    Route::get("/get", [UserController::class, 'get'])->name("user.get");
    Route::post("/register", [UserController::class, 'register'])->name("user.register");
});