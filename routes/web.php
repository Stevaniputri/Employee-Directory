<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobTitleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EmployeeController::class, 'getEmployees'])->name('employees');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/data', [EmployeeController::class, 'getEmployeesData'])->name('employees.data');
Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');

Route::get('/departments', [DepartmentController::class, 'index'])->name('department');
Route::get('/jobs', [JobTitleController::class, 'index'])->name('job');
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
