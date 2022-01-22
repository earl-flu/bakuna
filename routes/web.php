<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LotNumberController;
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

//public - remove the auth
Route::get('/registration', [VaccineeController::class, 'onlineVaccineeCreate'])->name('registration')->middleware(['auth']);
Route::post('/registration', [VaccineeController::class, 'onlineVaccineeStore'])->name('registration.store')->middleware(['auth']);

//superadmin only
Route::group([
    'prefix' => 'vaccinees',
    'middleware' => 'auth',
    'as' => 'vaccinees.'
], function () {
    Route::get('/import', [VaccineeImportController::class, 'show'])->name('import');
    Route::post('/import', [VaccineeImportController::class, 'store'])->name('import-store');
    Route::get('/export', [VaccineeExportController::class, 'show'])->name('export');
    Route::post('/export', [VaccineeExportController::class, 'export'])->name('export-store');
});

Route::get('vaccinees/verify/{vaccinee:uuid}', [VaccineeController::class, 'verify'])->name('vaccinees.verify');


//should be admin
// Route::get('/vaccinees/create', [VaccineeController::class, 'create'])->name('vaccinees.create');
// Route::post('/vaccinees/create', [VaccineeController::class, 'store'])->name('vaccinees.store');
// Route::get('/vaccinees', [VaccineeController::class, 'index'])->name('vaccinees.index');
// Route::get('/vaccinees/{vaccinee}/edit', [VaccineeController::class, 'edit'])->name('vaccinees.edit');
// Route::get('/vaccinees/{vaccinee}', [VaccineeController::class, 'show'])->name('vaccinees.show');
// Route::put('/vaccinees/{vaccinee}', [VaccineeController::class, 'update'])->name('vaccinees.update');

//admin
Route::middleware(['auth'])->group(function () {
    Route::resource('vaccinees', VaccineeController::class);
    Route::resource('vaccinees.bakunas', VaccineeBakunaController::class);

    Route::get('account', [ChangePasswordController::class, 'index'])->name('edit.account');
    Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');

    //superadmin only
    Route::resource('vaccinators', VaccinatorController::class);
    Route::resource('lot-numbers', LotNumberController::class);
});
//remove the auth - review this code
Route::put('/vaccinees/{vaccinee}/edit-schedule', [VaccineeController::class, 'updateSchedule'])->name('vaccinees.updateSchedule')->middleware(['auth']);


// Route::get('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'show'])->name('vaccinees.attendace-show');
// Route::get('/vaccinees/attendance', [VaccineeAttendanceController::class, 'index'])->name('vaccinees.attendace-index');
// Route::get('/vaccinees/attendance/{vaccinee}/edit', [VaccineeAttendanceController::class, 'edit'])->name('vaccinees.attendance-edit');
// Route::put('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'update'])->name('vaccinees.attendance-update');
// Route::get('/vaccinees/attendance/{vaccinee}', [VaccineeAttendanceController::class, 'show'])->name('vaccinees.attendance-show');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard'); //->middleware(['auth'])

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth']);

require __DIR__ . '/auth.php';
