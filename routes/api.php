<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CrowdSourcingController;
use App\Http\Controllers\OrdererController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDetailController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// プロジェクト
Route::post('/project/index', [ProjectController::class, 'index'])
     ->name('project.index')
     ->middleware(['auth:sanctum']);
Route::resource('project', ProjectController::class)
     ->except(['index', 'destroy'])
     ->middleware(['auth:sanctum']);
// プロジェクト詳細
Route::resource('project.project_detail', ProjectDetailController::class, ['names' => 'project_detail'])
     ->parameters(['project' => 'project_id', 'project_detail' => 'id'])
     ->except(['show', 'destroy'])
     ->middleware(['auth:sanctum']);
Route::get('/project/{project_id}/project_detail/{id}/download', [ProjectDetailController::class, 'download'])
     ->name('project.download')
     ->middleware(['auth:sanctum']);
// 発注者
Route::resource('orderer', OrdererController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth:sanctum']);
// クラウドソーシング
Route::resource('crowd_sourcing', CrowdSourcingController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth:sanctum']);
// 進捗
Route::resource('progress', ProgressController::class)
     ->except(['show', 'destroy'])
     ->middleware(['auth:sanctum']);
