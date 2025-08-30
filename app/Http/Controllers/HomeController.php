<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use App\Models\SkillCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_workers' => User::where('role', 'worker')->count(),
            'total_employers' => User::where('role', 'employer')->count(),
            'active_jobs' => JobListing::where('status', 'open')->count(),
            'completed_jobs' => JobListing::where('status', 'completed')->count(),
        ];

        $featuredJobs = JobListing::where('status', 'open')
            ->where('urgent', true)
            ->with('employer')
            ->latest()
            ->take(6)
            ->get();

        $skillCategories = SkillCategory::with('skills')->take(6)->get();

        return view('home', compact('stats', 'featuredJobs', 'skillCategories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function howItWorks()
    {
        return view('how-it-works');
    }
}
