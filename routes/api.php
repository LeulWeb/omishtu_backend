<?php

use App\Http\Controllers\Api\CountController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\TestimonyController;
use App\Http\Controllers\Story;
use App\Models\Testimony;
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

Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
Route::apiResource('stories', StoryController::class)->only(['index', 'show']);
// searching api for stories 


Route::apiResource('testimonies', TestimonyController::class)->only(['index']);
Route::apiResource('counts', CountController::class)->only(['index']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
