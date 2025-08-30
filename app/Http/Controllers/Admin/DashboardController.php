<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JobListing;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_workers' => User::where('role', 'worker')->count(),
            'total_employers' => User::where('role', 'employer')->count(),
            'total_jobs' => JobListing::count(),
            'active_jobs' => JobListing::where('status', 'open')->count(),
            'completed_jobs' => JobListing::where('status', 'completed')->count(),
            'total_applications' => Application::count(),
        ];

        $recentUsers = User::latest()->take(5)->get();
        $recentJobs = JobListing::with('employer')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentJobs'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function jobs()
    {
        $jobs = JobListing::with('employer')->latest()->paginate(20);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function skills()
    {
        $skillCategories = SkillCategory::with('skills')->get();
        $skills = Skill::with(['category', 'userSkills'])->latest()->paginate(20);
        return view('admin.skills.index', compact('skillCategories', 'skills'));
    }

    public function createAdmin()
    {
        return view('admin.users.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone_e164' => ['required', 'string', 'regex:/^\+256\d{9}$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_e164' => $request->phone_e164,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin user created successfully!');
    }

    // Skills Management
    public function createSkill()
    {
        $skillCategories = SkillCategory::all();
        return view('admin.skills.create', compact('skillCategories'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'skill_category_id' => ['required', 'exists:skill_categories,id'],
        ]);

        Skill::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->skill_category_id,
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill created successfully!');
    }

    public function editSkill(Skill $skill)
    {
        $skillCategories = SkillCategory::all();
        return view('admin.skills.edit', compact('skill', 'skillCategories'));
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'skill_category_id' => ['required', 'exists:skill_categories,id'],
        ]);

        $skill->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->skill_category_id,
        ]);

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted successfully!');
    }

    // Skill Categories Management
    public function createSkillCategory()
    {
        return view('admin.skill-categories.create');
    }

    public function storeSkillCategory(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
        ]);

        SkillCategory::create($request->all());

        return redirect()->route('admin.skills.index')->with('success', 'Skill category created successfully!');
    }

    public function editSkillCategory(SkillCategory $skillCategory)
    {
        return view('admin.skill-categories.edit', compact('skillCategory'));
    }

    public function updateSkillCategory(Request $request, SkillCategory $skillCategory)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
        ]);

        $skillCategory->update($request->all());

        return redirect()->route('admin.skills.index')->with('success', 'Skill category updated successfully!');
    }

    public function destroySkillCategory(SkillCategory $skillCategory)
    {
        $skillCategory->delete();

        return redirect()->route('admin.skills.index')->with('success', 'Skill category deleted successfully!');
    }
}
