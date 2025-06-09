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
    use App\Http\Controllers\SubjectController; // Import the SubjectController


    // ... other routes

    Route::middleware(['auth'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('classifications', ClassificationController::class);
          Route::resource('institutions', InstitutionController::class);
         Route::resource('courses', CourseController::class);
        Route::resource('corrections', CorrectionController::class);
         Route::resource('types', TypeController::class);
           Route::resource('subjects', SubjectController::class);
       
    });


    use App\Http\Controllers\Admin\ReportDashboardController;
  Route::middleware(['auth', ])->prefix('admin')->name('admin.')->group(function () {
        // ... existing admin routes
        Route::get('/reports', [ReportDashboardController::class, 'index'])->name('reports.index');
    });

     use App\Http\Controllers\Admin\CorrectionDashboardController;
use App\Http\Controllers\Admin\UploadDashboardController;
use App\Http\Controllers\Admin\UserUploadsController; // 
/*  Route::middleware(['auth', 'can:access-admin-dashboard'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/corrections', [CorrectionDashboardController::class, 'index'])->name('corrections.index');
    }); */
    Route::middleware(['auth', ])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/corrections', [CorrectionDashboardController::class, 'index'])->name('corrections.index');
    });
    Route::middleware(['auth', ])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/uploads-dashboard', [UploadDashboardController::class, 'index'])->name('uploads.dashboard');
    });
Route::middleware(['auth', ])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/user-uploads', [UserUploadsController::class, 'index'])->name('user_uploads.index'); // List all users
        Route::get('/user-uploads/{user}', [UserUploadsController::class, 'show'])->name('user_uploads.show'); // Show uploads for a specific user

    });



   

 use App\Http\Controllers\UserController;


Route::middleware(['auth', ])->group(function () {
    Route::resource('users', UserController::class); // You'd need to scaffold UserController too
});


/* Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [App\Http\Controllers\UserControllerUserController::class, 'index']);
}); */

use App\Http\Controllers\UploadController; // Import the UploadController

Route::middleware(['auth'])->group(function () {
    // Uploads Routes
    Route::resource('uploads', UploadController::class);
});

use App\Http\Controllers\AccountController; 
Route::middleware(['auth'])->group(function () {
    // Accounts Routes
    Route::resource('accounts', AccountController::class);

});

