<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ClassificationController;
    use App\Http\Controllers\InstitutionController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\CorrectionController;
    use App\Http\Controllers\TypeController; // Import the TypeController


    // ... other routes

    Route::middleware(['auth'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('classifications', ClassificationController::class);
          Route::resource('institutions', InstitutionController::class);
         Route::resource('courses', CourseController::class);
        Route::resource('corrections', CorrectionController::class);
         Route::resource('types', TypeController::class);
       
    });


    use App\Http\Controllers\Admin\ReportDashboardController;
  Route::middleware(['auth', 'can:access-admin-dashboard'])->prefix('admin')->name('admin.')->group(function () {
        // ... existing admin routes
        Route::get('/reports', [ReportDashboardController::class, 'index'])->name('reports.index');
    });

