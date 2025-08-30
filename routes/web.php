<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Worker\DashboardController as WorkerDashboard;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');

// Authentication routes
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect based on user role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isWorker()) {
            return redirect()->route('worker.dashboard');
        } elseif ($user->isEmployer()) {
            return redirect()->route('employer.dashboard');
        }
        
        return redirect()->route('home');
    })->name('dashboard');

    // Admin routes
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/users', [AdminDashboard::class, 'users'])->name('users.index');
        Route::get('/users/create', [AdminDashboard::class, 'createAdmin'])->name('users.create');
        Route::post('/users', [AdminDashboard::class, 'storeAdmin'])->name('users.store');
        Route::get('/jobs', [AdminDashboard::class, 'jobs'])->name('jobs.index');
        
        // Skills management
        Route::get('/skills', [AdminDashboard::class, 'skills'])->name('skills.index');
        Route::get('/skills/create', [AdminDashboard::class, 'createSkill'])->name('skills.create');
        Route::post('/skills', [AdminDashboard::class, 'storeSkill'])->name('skills.store');
        Route::get('/skills/{skill}/edit', [AdminDashboard::class, 'editSkill'])->name('skills.edit');
        Route::put('/skills/{skill}', [AdminDashboard::class, 'updateSkill'])->name('skills.update');
        Route::delete('/skills/{skill}', [AdminDashboard::class, 'destroySkill'])->name('skills.destroy');
        
        // Skill categories management
        Route::get('/skill-categories/create', [AdminDashboard::class, 'createSkillCategory'])->name('skill-categories.create');
        Route::post('/skill-categories', [AdminDashboard::class, 'storeSkillCategory'])->name('skill-categories.store');
        Route::get('/skill-categories/{skillCategory}/edit', [AdminDashboard::class, 'editSkillCategory'])->name('skill-categories.edit');
        Route::put('/skill-categories/{skillCategory}', [AdminDashboard::class, 'updateSkillCategory'])->name('skill-categories.update');
        Route::delete('/skill-categories/{skillCategory}', [AdminDashboard::class, 'destroySkillCategory'])->name('skill-categories.destroy');
    });

    // Worker routes
    Route::middleware(['auth', 'role:worker'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/', [WorkerDashboard::class, 'index'])->name('dashboard');
        Route::get('/profile', [WorkerDashboard::class, 'profile'])->name('profile');
        Route::get('/jobs', [WorkerDashboard::class, 'jobs'])->name('jobs.index');
        Route::get('/jobs/search', [WorkerDashboard::class, 'searchJobs'])->name('jobs.search');
        Route::get('/applications', [WorkerDashboard::class, 'applications'])->name('applications.index');
    });

    // Employer routes
    Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {
        Route::get('/', [EmployerDashboard::class, 'index'])->name('dashboard');
        Route::get('/jobs', [EmployerDashboard::class, 'jobs'])->name('jobs.index');
        Route::get('/jobs/create', [EmployerDashboard::class, 'createJob'])->name('jobs.create');
        Route::post('/jobs', [EmployerDashboard::class, 'storeJob'])->name('jobs.store');
        Route::get('/applications', [EmployerDashboard::class, 'applications'])->name('applications.index');
        Route::get('/workers/search', [EmployerDashboard::class, 'searchWorkers'])->name('workers.search');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
