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

    // Job Management
    public function showJob(JobListing $job)
    {
        $job->load(['employer', 'applications.worker']);
        return view('admin.jobs.show', compact('job'));
    }

    public function editJob(JobListing $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function updateJob(Request $request, JobListing $job)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'budget' => ['required', 'numeric', 'min:0'],
            'pay_type' => ['required', 'in:fixed,hourly,daily'],
            'district' => ['required', 'string', 'max:255'],
            'specific_location' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:open,in_progress,completed,cancelled'],
            'required_skills' => ['nullable', 'string'],
            'experience_level' => ['nullable', 'string'],
            'duration' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date'],
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.show', $job)->with('success', 'Job updated successfully!');
    }

    public function destroyJob(JobListing $job)
    {
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted successfully!');
    }

    // User Management
    public function showUser(User $user)
    {
        $user->load(['profile', 'userSkills.skill', 'applications', 'jobListings.applications']);
        return view('admin.users.show', compact('user'));
    }

    public function editUser(User $user)
    {
        $user->load('profile');
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone_e164' => ['required', 'string', 'regex:/^\+256\d{9}$/', 'unique:users,phone_e164,' . $user->id],
            'role' => ['required', 'in:admin,worker,employer'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'bio' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'availability' => ['nullable', 'in:available,busy,unavailable'],
            'company_name' => ['nullable', 'string', 'max:255'],
        ]);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_e164' => $request->phone_e164,
            'role' => $request->role,
        ];

        // Handle email verification
        if ($request->email_verified_at === '1' && !$user->email_verified_at) {
            $userData['email_verified_at'] = now();
        } elseif ($request->email_verified_at === '0' && $user->email_verified_at) {
            $userData['email_verified_at'] = null;
        }

        // Update password if provided
        if ($request->new_password) {
            $userData['password'] = Hash::make($request->new_password);
        }

        $user->update($userData);

        // Update profile if exists
        if ($user->profile) {
            $profileData = [];
            
            if ($user->role === 'worker') {
                $profileData = [
                    'bio' => $request->bio,
                    'location' => $request->location,
                    'availability' => $request->availability,
                ];
            } elseif ($user->role === 'employer') {
                $profileData = [
                    'company_name' => $request->company_name,
                    'location' => $request->location,
                ];
            }

            $user->profile->update(array_filter($profileData));
        }

        return redirect()->route('admin.users.show', $user)->with('success', 'User updated successfully!');
    }

    public function destroyUser(User $user)
    {
        // Prevent deletion of admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete admin users!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}
