<?php

use App\Http\Controllers\AIController;
use App\Models\User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/users', function (Request $request) {
    $data = User::all();
    return response()->json($data);
});

Route::post('/generate-suggestion', [AIController::class, 'generateSuggestion']);
Route::post('/generate-sentiment', [AIController::class, 'sentimentAnalyzer']);