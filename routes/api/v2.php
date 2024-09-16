<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V2\TaskController;
use App\Http\Controllers\Api\V2\SummaryController;
use App\Http\Controllers\Api\V2\CompleteTaskController;
use App\Http\Controllers\Api\V2\ProductController;


Route::middleware('auth:sanctum')->prefix('v2')->group(function () {
    Route::apiResource('/tasks', TaskController::class);
    Route::get('/summaries', SummaryController::class);
    Route::patch('/tasks/{task}/complete', CompleteTaskController::class);

    Route::resource('/products', ProductController::class);
    Route::delete('/products/{ids}/bulk', [ProductController::class, 'bulkDestroy'])->name('products.bulk-destroy');
    Route::patch('/products/bulk/update', [ProductController::class, 'bulkUpdate'])->name('products.bulk-update');
});