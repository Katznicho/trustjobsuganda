<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\User;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'jobs_posted' => $user->jobListings()->count(),
            'active_jobs' => $user->jobListings()->where('status', 'open')->count(),
            'total_applications' => Application::whereHas('jobListing', function($query) use ($user) {
                $query->where('employer_id', $user->id);
            })->count(),
            'completed_jobs' => $user->jobListings()->where('status', 'completed')->count(),
        ];

        $recentJobs = $user->jobListings()->latest()->take(5)->get();
        $recentApplications = Application::whereHas('jobListing', function($query) use ($user) {
            $query->where('employer_id', $user->id);
        })->with(['user', 'jobListing'])->latest()->take(5)->get();

        return view('employer.dashboard', compact('stats', 'recentJobs', 'recentApplications'));
    }

    public function jobs()
    {
        $jobs = Auth::user()->jobListings()->latest()->paginate(20);
        return view('employer.jobs.index', compact('jobs'));
    }

    public function createJob()
    {
        $skills = Skill::with('category')->get();
        return view('employer.jobs.create', compact('skills'));
    }

    public function storeJob(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_skill_ids' => 'required|array',
            'min_experience_tier' => 'required|in:<6 months,6-12 months,1-2 years,2-5 years,>5 years',
            'district' => 'required|string|max:60',
            'division' => 'nullable|string|max:60',
            'parish' => 'nullable|string|max:60',
            'village' => 'nullable|string|max:60',
            'budget' => 'required|numeric|min:0',
            'pay_type' => 'required|in:daily,hourly,fixed',
            'urgent' => 'boolean',
        ]);

        $validated['employer_id'] = Auth::id();
        $validated['urgent'] = $request->has('urgent');

        JobListing::create($validated);

        return redirect()->route('employer.jobs.index')->with('success', 'Job posted successfully!');
    }

    public function applications()
    {
        $applications = Application::whereHas('jobListing', function($query) {
            $query->where('employer_id', Auth::id());
        })->with(['user', 'jobListing'])->latest()->paginate(20);

        return view('employer.applications.index', compact('applications'));
    }

    public function searchWorkers(Request $request)
    {
        $query = User::where('role', 'worker')->with(['profile', 'userSkills.skill']);

        if ($request->filled('skill_id')) {
            $query->whereHas('userSkills', function($q) use ($request) {
                $q->where('skill_id', $request->skill_id);
            });
        }

        if ($request->filled('district')) {
            $query->whereHas('profile', function($q) use ($request) {
                $q->where('district', $request->district);
            });
        }

        if ($request->filled('min_experience_tier')) {
            $query->whereHas('userSkills', function($q) use ($request) {
                $q->where('experience_tier', $request->min_experience_tier);
            });
        }

        $workers = $query->paginate(20);
        $skills = Skill::with('category')->get();

        return view('employer.workers.search', compact('workers', 'skills'));
    }
}
