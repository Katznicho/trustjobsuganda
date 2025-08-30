<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'applications_submitted' => $user->applications()->count(),
            'jobs_shortlisted' => $user->applications()->where('status', 'shortlisted')->count(),
            'jobs_hired' => $user->applications()->where('status', 'hired')->count(),
            'average_rating' => $user->ratingsReceived()->avg('stars') ?? 0,
        ];

        $recentApplications = $user->applications()->with('jobListing')->latest()->take(5)->get();
        $recommendedJobs = JobListing::where('status', 'open')
            ->latest()
            ->take(5)
            ->get();

        return view('worker.dashboard', compact('stats', 'recentApplications', 'recommendedJobs'));
    }

    public function profile()
    {
        $user = Auth::user();
        $skillCategories = SkillCategory::with('skills')->get();
        $languages = Language::all();
        
        return view('worker.profile', compact('user', 'skillCategories', 'languages'));
    }

    public function jobs()
    {
        $jobs = JobListing::where('status', 'open')
            ->with('employer')
            ->latest()
            ->paginate(20);

        $skills = Skill::with('category')->get();
        
        return view('worker.jobs.index', compact('jobs', 'skills'));
    }

    public function applications()
    {
        $applications = Auth::user()->applications()
            ->with('jobListing')
            ->latest()
            ->paginate(20);

        return view('worker.applications.index', compact('applications'));
    }

    public function searchJobs(Request $request)
    {
        $query = JobListing::where('status', 'open')->with('employer');

        if ($request->filled('skill_id')) {
            $query->whereJsonContains('required_skill_ids', $request->skill_id);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        if ($request->filled('min_experience_tier')) {
            $query->where('min_experience_tier', $request->min_experience_tier);
        }

        $jobs = $query->latest()->paginate(20);
        $skills = Skill::with('category')->get();

        return view('worker.jobs.search', compact('jobs', 'skills'));
    }
}
