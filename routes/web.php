<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

Route::get('/', fn()=>redirect()->route('employees.index'));

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);

Route::get('/employees-data', [EmployeeController::class, 'getData'])->name('employees.data');

