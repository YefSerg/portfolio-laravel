<?php

use App\Enums\UserRoles;
use App\Http\Controllers\Admin\Main\IndexController;
use App\Http\Controllers\Admin\User\CreateController;
use App\Http\Controllers\Admin\User\DestroyController;
use App\Http\Controllers\Admin\User\EditController;
use App\Http\Controllers\Admin\User\SearchController;
use App\Http\Controllers\Admin\User\ShowController;
use App\Http\Controllers\Admin\User\StoreController;
use App\Http\Controllers\Admin\User\UpdateController;
use App\Http\Controllers\Api\Auth\LogInController;
use App\Http\Controllers\Api\Auth\LogOutController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\EmailVerification\HandlerController;
use App\Http\Controllers\EmailVerification\NoticeController;
use App\Http\Controllers\EmailVerification\ResendingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:'.UserRoles::ADMIN->value])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', IndexController::class)->name('admin.index')->middleware('role:'.UserRoles::ADMIN->value);

    Route::prefix('user')->middleware('role:'.UserRoles::SUPER_ADMIN->value)->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\User\IndexController::class)->name('admin.user.index');
        Route::get('/create', CreateController::class)->name('admin.user.create');
        Route::post('/', StoreController::class)->name('admin.user.store');
        Route::get('/{user}/show', ShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', EditController::class)->name('admin.user.edit');
        Route::patch('/{user}', UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', DestroyController::class)->name('admin.user.destroy');
        Route::get('/search', SearchController::class)->name('admin.user.search');
    });

    Route::prefix('category')->middleware('role:'.UserRoles::ADMIN->value)->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Category\IndexController::class)->name('admin.category.index');
        Route::get('/create', \App\Http\Controllers\Admin\Category\CreateController::class)->name('admin.category.create');
        Route::post('/', \App\Http\Controllers\Admin\Category\StoreController::class)->name('admin.category.store');
        Route::get('/{category}/show', \App\Http\Controllers\Admin\Category\ShowController::class)->name('admin.category.show');
        Route::get('/{category}/edit', \App\Http\Controllers\Admin\Category\EditController::class)->name('admin.category.edit');
        Route::patch('/{category}', \App\Http\Controllers\Admin\Category\UpdateController::class)->name('admin.category.update');
        Route::delete('/{category}', \App\Http\Controllers\Admin\Category\DestroyController::class)->name('admin.category.destroy');
        Route::get('/search', \App\Http\Controllers\Admin\Category\SearchController::class)->name('admin.category.search');
    });

    Route::prefix('project')->middleware('role:'.UserRoles::ADMIN->value)->group(function () {
        Route::get('/', \App\Http\Controllers\Admin\Project\IndexController::class)->name('admin.project.index');
        Route::get('/create', \App\Http\Controllers\Admin\Project\CreateController::class)->name('admin.project.create');
        Route::post('/', \App\Http\Controllers\Admin\Project\StoreController::class)->name('admin.project.store');
        Route::get('/{project}/show', \App\Http\Controllers\Admin\Project\ShowController::class)->name('admin.project.show');
        Route::get('/{project}/edit', \App\Http\Controllers\Admin\Project\EditController::class)->name('admin.project.edit');
        Route::patch('/{project}', \App\Http\Controllers\Admin\Project\UpdateController::class)->name('admin.project.update');
        Route::delete('/{project}', \App\Http\Controllers\Admin\Project\DestroyController::class)->name('admin.project.destroy');
        Route::get('/search', \App\Http\Controllers\Admin\Project\SearchController::class)->name('admin.project.search');
    });
});

Route::prefix('api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/registration', RegistrationController::class)->middleware('api-guest:api-user')->name('api.auth.registration');
        Route::post('/login', LogInController::class)->middleware('api-guest:api-user')->name('api.auth.login');
        Route::post('/logout', LogOutController::class)->middleware('auth:api-user')->name('api.auth.logout');
    });
});

Route::get('/email/verify', NoticeController::class)->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', HandlerController::class)->middleware(['auth:api-user', 'signed'])->name('verification.verify');
Route::post('/api/email/resend', ResendingController::class)->middleware(['auth:api-user', 'throttle:6,1'])->name('verification.resend');

require __DIR__.'/auth.php';
