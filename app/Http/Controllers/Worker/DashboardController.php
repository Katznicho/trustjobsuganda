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

    public function showJob(JobListing $job)
    {
        $job->load(['employer', 'applications']);
        return view('worker.jobs.show', compact('job'));
    }

    public function applyToJob(Request $request, JobListing $job)
    {
        $user = Auth::user();

        // Check if user has already applied
        $existingApplication = $user->applications()->where('job_id', $job->id)->first();
        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Check if job is still open
        if ($job->status !== 'open') {
            return redirect()->back()->with('error', 'This job is no longer accepting applications.');
        }

        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:1000',
        ]);

        $user->applications()->create([
            'job_id' => $job->id,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }

    public function editProfile()
    {
        $user = Auth::user();
        $skillCategories = SkillCategory::with('skills')->get();
        $languages = Language::all();
        
        return view('worker.profile.edit', compact('user', 'skillCategories', 'languages'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'availability' => 'nullable|in:available,busy,unavailable',
            'skills' => 'array',
            'skills.*.skill_id' => 'required|exists:skills,id',
            'skills.*.experience_tier' => 'required|in:<6 months,6-12 months,1-2 years,2-5 years,>5 years',
            'skills.*.years_estimate' => 'nullable|numeric|min:0|max:50',
            'skills.*.has_certificate' => 'boolean',
            'skills.*.institution_name' => 'nullable|string|max:255',
            'skills.*.certificate_name' => 'nullable|string|max:255',
            'skills.*.issue_date' => 'nullable|date',
            'languages' => 'array',
            'languages.*.language_id' => 'required|exists:languages,id',
            'languages.*.proficiency' => 'required|in:beginner,intermediate,advanced,native',
        ]);

        // Update user basic info
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        // Update or create profile
        $profile = $user->profile;
        if (!$profile) {
            $profile = $user->profile()->create([]);
        }

        $profile->update([
            'bio' => $validated['bio'],
            'location' => $validated['location'],
            'availability' => $validated['availability'],
        ]);

        // Update skills
        if (isset($validated['skills'])) {
            $user->userSkills()->delete();
            foreach ($validated['skills'] as $skillData) {
                // Provide default value for years_estimate if not provided
                if (!isset($skillData['years_estimate']) || $skillData['years_estimate'] === null) {
                    $skillData['years_estimate'] = $this->getYearsEstimate($skillData['experience_tier']);
                }
                $user->userSkills()->create($skillData);
            }
        }

        // Update languages
        if (isset($validated['languages'])) {
            $user->userLanguages()->delete();
            foreach ($validated['languages'] as $languageData) {
                $user->userLanguages()->create($languageData);
            }
        }

        return redirect()->route('worker.profile')->with('success', 'Profile updated successfully!');
    }

    public function publicProfile()
    {
        $user = Auth::user();
        $user->load(['profile', 'userSkills.skill', 'userLanguages.language', 'educationRecords', 'references']);
        
        return view('worker.profile.public', compact('user'));
    }

    public function downloadCV()
    {
        $user = Auth::user();
        $user->load(['profile', 'userSkills.skill', 'userLanguages.language', 'educationRecords', 'references']);

        // Generate PDF using DomPDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('worker.cv.pdf', compact('user'));
        
        // Set PDF options
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial'
        ]);
        
        $filename = "CV_{$user->first_name}_{$user->last_name}_" . date('Y-m-d') . ".pdf";
        
        return $pdf->download($filename);
    }

    public function editApplication(Application $application)
    {
        // Ensure the application belongs to the current user
        if ($application->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Only allow editing pending applications
        if ($application->status !== 'pending') {
            return redirect()->route('worker.applications.index')
                ->with('error', 'You can only edit pending applications.');
        }

        $application->load(['job.employer']);
        return view('worker.applications.edit', compact('application'));
    }

    public function updateApplication(Request $request, Application $application)
    {
        // Ensure the application belongs to the current user
        if ($application->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Only allow updating pending applications
        if ($application->status !== 'pending') {
            return redirect()->route('worker.applications.index')
                ->with('error', 'You can only edit pending applications.');
        }

        $validated = $request->validate([
            'cover_letter' => 'nullable|string|max:2000',
        ]);

        $application->update([
            'cover_letter' => $validated['cover_letter'],
        ]);

        return redirect()->route('worker.applications.index')
            ->with('success', 'Your application has been updated successfully!');
    }

    public function withdrawApplication(Application $application)
    {
        // Ensure the application belongs to the current user
        if ($application->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Only allow withdrawing pending applications
        if ($application->status !== 'pending') {
            return redirect()->route('worker.applications.index')
                ->with('error', 'You can only withdraw pending applications.');
        }

        $jobTitle = $application->job->title;
        $application->delete();

        return redirect()->route('worker.applications.index')
            ->with('success', "Your application for '{$jobTitle}' has been withdrawn successfully!");
    }

    private function getYearsEstimate($tier): float
    {
        return match($tier) {
            '<6 months' => 0.25,
            '6-12 months' => 0.75,
            '1-2 years' => 1.5,
            '2-5 years' => 3.5,
            '>5 years' => 6.0,
            default => 0.0,
        };
    }
}
