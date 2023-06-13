<?php

use App\Http\Controllers\FileUpload;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokenController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/get-token-whatever', [TokenController::class, 'getToken']);

//Route::middleware(['auth', 'verified'])->group(function ()
//{
//    Route::get('/dashboard', function (){
//        return Inertia::render('Dashboard');
//    })->name('dashboard');
//});

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact-send');
//Route::get('/dashboard', [\App\Http\Controllers\WelcomeController::class, 'welcome'])->name('welcome');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/skills', \App\Http\Controllers\SkillController::class);
    Route::resource('/projects',\App\Http\Controllers\ProjectController::class);
    Route::get('/get-projects',[\App\Http\Controllers\ProjectController::class, 'getProjects']);
    Route::resource('/applications',\App\Http\Controllers\ApplicationsController::class);
//    Route::resource('/reports',\App\Http\Controllers\ReportsController::class);
    Route::get('/skills-report', [\App\Http\Controllers\ReportsController::class, 'skillsReport'])->name('Reports.SkillsReport');
    Route::get('/reports/get-skills', [\App\Http\Controllers\ReportsController::class, 'getSkills']);
    Route::get('/projects-report', [\App\Http\Controllers\ReportsController::class, 'projectReport'])->name('Reports.ProjectsReport');
    Route::get('/reports/get-projects', [\App\Http\Controllers\ReportsController::class, 'getProjects']);
    Route::get('/applications-report', [\App\Http\Controllers\ReportsController::class, 'applicationsReport'])->name('Reports.ApplicationsReport');
    Route::get('/reports/get-applications', [\App\Http\Controllers\ReportsController::class, 'getApplications']);
    Route::get('/applications-jobs',[\App\Http\Controllers\ApplicationsController::class, 'applicationsJobs'])->name('applications-jobs');
    Route::get('/download',[\App\Http\Controllers\StorageController::class, 'download']);

//    Route::get('/applications', [\App\Http\Controllers\ApplicationsController::class, 'applications'])->name('applications.index');

    Route::get('/upload-file', [FileUpload::class, 'createForm']);
    Route::post('/upload-file', [FileUpload::class, 'fileUpload'])->name('fileUpload');
});

require __DIR__.'/auth.php';
