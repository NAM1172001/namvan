<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Amin\Uses\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\UploadController;

Route::get( 'admin/uses/login', [LoginController::class, 'index'])->name('login');
Route::post( 'admin/uses/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function (){
        Route::get('/' , [MainController::class, 'index']) ->name('admin');
        Route::get('main' , [MainController::class, 'index']);

        #menu
        Route::prefix('menus')->group(function (){
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        });
        #product
        Route::prefix('products')->group(function (){
              Route::get('add', [\App\Http\Controllers\Admin\ProductController::class, 'create']);
        });

        #upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);
    });
});




