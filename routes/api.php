<?php
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

route::group(["prefix" => "/v1/auth"],function() {
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/registro",[AuthController::class, "registrar"]);

    route::group(["middleware" => "auth:sanctum"],function() {
        route::get("/perfil",[AuthController::class,"perfil"]);
        route::post("/logout",[AuthController::class,"salir"]);

    });

    });



