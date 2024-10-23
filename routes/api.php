<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function (){
   Route::prefix('signup')->group(function (){
       Route::post('/register', [SignupController::class, 'register']);
       Route::post('/signup', function (){
           return "hello";
       });
});

    Route::post('/login', [LoginController::class, 'login']);

});

Route::prefix('admin')->group(function () {
    Route::prefix('setting')->group(function () {
        Route::prefix('product-category')->group(function () {
            Route::get('/', [ProductCategoryController::class, 'index']);
        });
    });
});



