<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\V1\CompleteTaskController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

Route::prefix('auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    Route::post('/register', RegisterController::class);
});

Route::get('/students', [StudentController::class, 'index']);
Route::delete('student/delete/{student}', [StudentController::class, 'destroy']);
Route::delete('students/massDestroy/{students}', [StudentController::class, 'massDestroy']);
Route::get('students/export/{students}', [StudentController::class, 'export']);

Route::get('/classes', [ClassesController::class, 'index']);
Route::get('/sections', [SectionController::class, 'index']);

require __DIR__ . '/api/v1.php';
require __DIR__ . '/api/v2.php';

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
