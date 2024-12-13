<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Employee\EmpTaskController;
use App\Http\Controllers\Manager\DepartmentController;
use App\Http\Controllers\Manager\EmployeeController;
use App\Http\Controllers\Manager\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('api.auth.login');
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::namespace('Manager')->prefix('managers')->group(function () {

    Route::middleware(['auth:sanctum', 'manager'])->group(function () {

        Route::prefix('employees')->group(function (){

            Route::get('index', [EmployeeController::class, 'index']);
            Route::post('store', [EmployeeController::class, 'store']);
            Route::get('show/{id}', [EmployeeController::class, 'show']);
            Route::post('update/{id}', [EmployeeController::class, 'update']);
            Route::post('delete/{id}', [EmployeeController::class, 'destroy']);
        });



        Route::prefix('departments')->group(function (){

            Route::get('index', [DepartmentController::class, 'index']);
            Route::post('store', [DepartmentController::class, 'store']);
            Route::get('show/{id}', [DepartmentController::class, 'show']);
            Route::post('update/{id}', [DepartmentController::class, 'update']);
            Route::post('delete/{id}', [DepartmentController::class, 'destroy']);
        });

        Route::prefix('tasks')->group(function (){
            Route::post('store', [TaskController::class, 'store']);

        });


    });


});


Route::namespace('Employee')->prefix('employees')->group(function () {


    Route::middleware(['auth:sanctum', 'employee'])->group(function () {

        Route::prefix('tasks')->group(function (){
            Route::get('my-tasks', [EmpTaskController::class, 'index']);
            Route::get('show/{id}', [EmpTaskController::class, 'show']);
            Route::post('update/{id}', [EmpTaskController::class, 'update']);

        });

    });


});
