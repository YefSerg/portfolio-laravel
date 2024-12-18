<?php

use App\Http\Controllers\Api\Main\IndexController;
use App\Http\Controllers\Api\Project\Review\StoreController;
use App\Http\Controllers\Api\Project\SearchController;
use App\Http\Controllers\Api\Project\ShowController;
use App\Http\Controllers\Api\ProjectUserLike\ToggleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/index', IndexController::class)->name('api.main.index');

Route::prefix('project')->group(function () {
    Route::get('/', \App\Http\Controllers\Api\Project\IndexController::class)->name('api.project.index');
    Route::get('/search', SearchController::class)->name('api.project.search');
    Route::get('/{project}/show', ShowController::class)->name('api.project.show');
    Route::get('/{project}/like', ToggleController::class)->middleware('auth:sanctum')->name('api.project.like.toggle');

    Route::prefix('{project}/review')->group(function () {
        Route::get('/', \App\Http\Controllers\Api\Project\Review\IndexController::class)->name('api.project.review.index');
        Route::post('/', StoreController::class)->middleware('auth:sanctum')->name('api.project.review.store');
    });
});

Route::prefix('subscription')->group(function () {
    Route::post('/', \App\Http\Controllers\Api\Subscription\StoreController::class)->name('api.subscription.store');
});





