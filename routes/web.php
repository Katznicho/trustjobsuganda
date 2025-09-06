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

// Public profile route (accessible without authentication)
Route::get('/profile/{user}', [App\Http\Controllers\PublicProfileController::class, 'show'])->name('profile.public');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how-it-works');

// Navigation menu routes
Route::get('/discover', function () {
    return view('discover');
})->name('discover');
Route::get('/people', function () {
    return view('people');
})->name('people');
Route::get('/learning', function () {
    return view('learning');
})->name('learning');
Route::get('/jobs', function () {
    return view('jobs');
})->name('jobs');
Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');

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
        Route::get('/users/{user}', [AdminDashboard::class, 'showUser'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminDashboard::class, 'editUser'])->name('users.edit');
        Route::put('/users/{user}', [AdminDashboard::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminDashboard::class, 'destroyUser'])->name('users.destroy');
        Route::get('/jobs', [AdminDashboard::class, 'jobs'])->name('jobs.index');
        Route::get('/jobs/{job}', [AdminDashboard::class, 'showJob'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [AdminDashboard::class, 'editJob'])->name('jobs.edit');
        Route::put('/jobs/{job}', [AdminDashboard::class, 'updateJob'])->name('jobs.update');
        Route::delete('/jobs/{job}', [AdminDashboard::class, 'destroyJob'])->name('jobs.destroy');
        
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
        Route::get('/profile/edit', [WorkerDashboard::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile', [WorkerDashboard::class, 'updateProfile'])->name('profile.update');
        Route::get('/profile/public', [WorkerDashboard::class, 'publicProfile'])->name('profile.public');
        Route::get('/cv/download', [WorkerDashboard::class, 'downloadCV'])->name('cv.download');
        Route::get('/jobs', [WorkerDashboard::class, 'jobs'])->name('jobs.index');
        Route::get('/jobs/search', [WorkerDashboard::class, 'searchJobs'])->name('jobs.search');
        Route::get('/jobs/{job}', [WorkerDashboard::class, 'showJob'])->name('jobs.show');
        Route::post('/jobs/{job}/apply', [WorkerDashboard::class, 'applyToJob'])->name('jobs.apply');
        Route::get('/applications', [WorkerDashboard::class, 'applications'])->name('applications.index');
        Route::get('/applications/{application}/edit', [WorkerDashboard::class, 'editApplication'])->name('applications.edit');
        Route::put('/applications/{application}', [WorkerDashboard::class, 'updateApplication'])->name('applications.update');
        Route::delete('/applications/{application}', [WorkerDashboard::class, 'withdrawApplication'])->name('applications.withdraw');
    });

    // Employer routes
    Route::middleware(['auth', 'role:employer'])->prefix('employer')->name('employer.')->group(function () {
        Route::get('/', [EmployerDashboard::class, 'index'])->name('dashboard');
        Route::get('/jobs', [EmployerDashboard::class, 'jobs'])->name('jobs.index');
        Route::get('/jobs/create', [EmployerDashboard::class, 'createJob'])->name('jobs.create');
        Route::post('/jobs', [EmployerDashboard::class, 'storeJob'])->name('jobs.store');
        Route::get('/jobs/{job}', [EmployerDashboard::class, 'showJob'])->name('jobs.show');
        Route::get('/jobs/{job}/edit', [EmployerDashboard::class, 'editJob'])->name('jobs.edit');
        Route::put('/jobs/{job}', [EmployerDashboard::class, 'updateJob'])->name('jobs.update');
        Route::delete('/jobs/{job}', [EmployerDashboard::class, 'destroyJob'])->name('jobs.destroy');
        Route::patch('/jobs/{job}/status', [EmployerDashboard::class, 'updateJobStatus'])->name('jobs.status');
        Route::get('/applications', [EmployerDashboard::class, 'applications'])->name('applications.index');
        Route::get('/applications/{application}/worker-profile', [EmployerDashboard::class, 'viewWorkerProfile'])->name('applications.worker-profile');
        Route::patch('/applications/{application}/shortlist', [EmployerDashboard::class, 'shortlistApplication'])->name('applications.shortlist');
        Route::patch('/applications/{application}/hire', [EmployerDashboard::class, 'hireApplication'])->name('applications.hire');
        Route::patch('/applications/{application}/reject', [EmployerDashboard::class, 'rejectApplication'])->name('applications.reject');
        Route::get('/workers/search', [EmployerDashboard::class, 'searchWorkers'])->name('workers.search');
        Route::get('/workers/{worker}/profile', [EmployerDashboard::class, 'showWorkerProfile'])->name('workers.profile');
        Route::post('/workers/contact', [EmployerDashboard::class, 'contactWorker'])->name('workers.contact');
        Route::post('/workers/invite', [EmployerDashboard::class, 'inviteWorker'])->name('workers.invite');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
