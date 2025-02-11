<?php

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
// Route::middleware(['auth:sanctum', 'role:teacher'])->post('/attendance', [AttendanceController::class, 'store']);

require_once __DIR__ . '/Api/general.php';
require_once __DIR__ . '/Api/admin.php';
require_once __DIR__ . '/Api/teacher.php';
    
