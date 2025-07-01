<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSO\SSOApiController;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API SSO
Route::post('sso/check-user', [SSOApiController::class, 'checkUserExistsByNip']);
