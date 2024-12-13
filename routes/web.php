<?php


use App\Http\Controllers\Web\Employee\EmployeeTaskController;
use App\Http\Controllers\Web\Manager\DepartmentController;
use App\Http\Controllers\Web\Manager\TaskController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\Manager\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::view('/unauthorized', 'errors.unauthorized')->name('unauthorized');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->name('employee.home');

Route::namespace('Manager')->prefix('managers')->group(function () {

    Route::middleware(['AuthenticateManagerWeb'])->group(function () {





        Route::prefix('employees')->group(function (){

            Route::get('index', [EmployeeController::class, 'index'])->name('employee.index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');

            Route::post('store', [EmployeeController::class, 'store'])->name('employee.store');;
            Route::get('show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
            Route::post('update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
            Route::get('delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');;
        });

        Route::prefix('tasks')->group(function (){
            Route::get('/create/{id}', [TaskController::class, 'create'])->name('task.create');
            Route::post('store', [TaskController::class, 'store'])->name('task.store');;

        });


        Route::prefix('departments')->group(function (){

            Route::get('index', [DepartmentController::class, 'index'])->name('department.index');;
            Route::get('/create', [DepartmentController::class, 'create'])->name('department.create');

            Route::post('store', [DepartmentController::class, 'store'])->name('department.store');;
            Route::get('show/{id}', [DepartmentController::class, 'show'])->name('department.show');;
            Route::post('update/{id}', [DepartmentController::class, 'update'])->name('department.update');;
            Route::get('delete/{id}', [DepartmentController::class, 'destroy'])->name('department.delete');;
        });


    });








});


Route::namespace('Employee')->prefix('employees')->group(function () {


    Route::middleware(['AuthenticateEmployeeWeb'])->group(function () {

        Route::prefix('tasks')->group(function (){
            Route::get('index', [EmployeeTaskController::class, 'index'])->name('employee.task.index');;

            Route::get('show/{id}', [EmployeeTaskController::class, 'show'])->name('employee.task.show');
            Route::post('update/{id}', [EmployeeTaskController::class, 'update'])->name('employee.task.update');;

        });

    });

});


