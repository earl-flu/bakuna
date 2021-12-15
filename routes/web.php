<?php

use App\Http\Controllers\VaccinatorController;
use App\Http\Controllers\VaccineeAttendanceController;
use App\Http\Controllers\VaccineeBakunaController;
use App\Http\Controllers\VaccineeController;
use App\Http\Controllers\VaccineeExportController;
use App\Http\Controllers\VaccineeImportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//public
Route::get('/registration', [VaccineeController::class, 'onlineVaccineeCreate'])->name('registration');
Route::post('/registration', [VaccineeController::class, 'onlineVaccineeStore'])->name('registration.store');

//superadmin only
Route::get('/vaccinees/import', [VaccineeImportController::class, 'show'])->name('vaccinees.import');
Route::post('/vaccinees/import', [VaccineeImportController::class, 'store'])->name('vaccinees.import-store');
Route::get('/vaccinees/export', [VaccineeExportController::class, 'show'])->name('vaccinees.export');
Route::post('/vaccinees/export', [VaccineeExportController::class, 'export'])->name('vaccinees.export-store');


//should be admin
// Route::get('/vaccinees/create', [VaccineeController::class, 'create'])->name('vaccinees.create');
// Route::post('/vaccinees/create', [VaccineeController::class, 'store'])->name('vaccinees.store');
// Route::get('/vaccinees', [VaccineeController::class, 'index'])->name('vaccinees.index');
// Route::get('/vaccinees/{vaccinee}/edit', [VaccineeController::class, 'edit'])->name('vaccinees.edit');
// Route::get('/vaccinees/{vaccinee}', [VaccineeController::class, 'show'])->name('vaccinees.show');
// Route::put('/vaccinees/{vaccinee}', [VaccineeController::class, 'update'])->name('vaccinees.update');

Route::resource('vaccinees', VaccineeController::class);

Route::resource('vaccinees.bakunas', VaccineeBakunaController::class);

//superadmin only
Route::resource('vaccinators', VaccinatorController::class);

Route::put('/vaccinees/{vaccinee}/edit-schedule', [VaccineeController::class, 'updateSchedule'])->name('vaccinees.updateSchedule');


// Route::get('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'show'])->name('vaccinees.attendace-show');
// Route::get('/vaccinees/attendance', [VaccineeAttendanceController::class, 'index'])->name('vaccinees.attendace-index');
// Route::get('/vaccinees/attendance/{vaccinee}/edit', [VaccineeAttendanceController::class, 'edit'])->name('vaccinees.attendance-edit');
// Route::put('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'update'])->name('vaccinees.attendance-update');
// Route::get('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'show'])->name('vaccinees.attendance-show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); //->middleware(['auth'])

require __DIR__ . '/auth.php';
