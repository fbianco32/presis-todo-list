<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\TaskMiddleware;
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
Route::get('task', [TaskController::class, 'index'])->name('task.index');
Route::get('task/{id}', [TaskController::class, 'show'])->name('task.show');
Route::post('task', [TaskController::class, 'store'])->middleware(TaskMiddleware::class)->name('task.store');
Route::patch('task', [TaskController::class, 'edit'])->middleware(TaskMiddleware::class)->name('task.edit');
Route::delete('task/{id}', [TaskController::class, 'destroy'])->middleware(TaskMiddleware::class)->name('task.destroy');
