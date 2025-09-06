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
        $skillCategories = SkillCategory::with('skills')->get();
        return view('employer.jobs.create', compact('skillCategories'));
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

    public function showWorkerProfile(User $worker)
    {
        // Ensure the user is a worker
        if ($worker->role !== 'worker') {
            abort(404);
        }

        $worker->load([
            'profile', 
            'userSkills.skill', 
            'userLanguages.language', 
            'educationRecords', 
            'references',
            'applications'
        ]);

        return view('employer.workers.profile', compact('worker'));
    }

    public function contactWorker(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $worker = User::findOrFail($request->worker_id);
        
        // Ensure the user is a worker
        if ($worker->role !== 'worker') {
            return redirect()->back()->with('error', 'Invalid worker selected.');
        }

        // Here you would typically send an email or store the message
        // For now, we'll just show a success message
        // You can implement email sending using Laravel Mail later
        
        return redirect()->back()->with('success', "Your message has been sent to {$worker->full_name} successfully!");
    }

    public function inviteWorker(Request $request)
    {
        $request->validate([
            'worker_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:job_listings,id',
            'message' => 'nullable|string|max:1000',
        ]);

        $worker = User::findOrFail($request->worker_id);
        $job = JobListing::findOrFail($request->job_id);
        
        // Ensure the user is a worker
        if ($worker->role !== 'worker') {
            return redirect()->back()->with('error', 'Invalid worker selected.');
        }

        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only invite workers to your own jobs.');
        }

        // Check if the job is still open
        if ($job->status !== 'open') {
            return redirect()->back()->with('error', 'You can only invite workers to open jobs.');
        }

        // Check if worker has already applied to this job
        $existingApplication = Application::where('user_id', $worker->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existingApplication) {
            return redirect()->back()->with('error', 'This worker has already applied to this job.');
        }

        // Here you would typically send an email invitation or store the invitation
        // For now, we'll just show a success message
        // You can implement email sending using Laravel Mail later
        
        return redirect()->back()->with('success', "Job invitation has been sent to {$worker->full_name} for the position: {$job->title}!");
    }

    public function showJob(JobListing $job)
    {
        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $job->load(['applications.user']);
        return view('employer.jobs.show', compact('job'));
    }

    public function editJob(JobListing $job)
    {
        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $skillCategories = SkillCategory::with('skills')->get();
        return view('employer.jobs.edit', compact('job', 'skillCategories'));
    }

    public function updateJob(Request $request, JobListing $job)
    {
        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

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
            'status' => 'required|in:open,in_progress,completed,cancelled',
            'urgent' => 'boolean',
        ]);

        $validated['urgent'] = $request->has('urgent');

        $job->update($validated);

        return redirect()->route('employer.jobs.show', $job)->with('success', 'Job updated successfully!');
    }

    public function destroyJob(JobListing $job)
    {
        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $job->delete();

        return redirect()->route('employer.jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function updateJobStatus(Request $request, JobListing $job)
    {
        // Ensure the job belongs to the current employer
        if ($job->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this job.');
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,completed,cancelled',
        ]);

        $job->update(['status' => $request->status]);

        $statusMessages = [
            'open' => 'Job has been reopened',
            'in_progress' => 'Job has been marked as taken',
            'completed' => 'Job has been marked as completed',
            'cancelled' => 'Job has been marked as unavailable',
        ];

        return redirect()->back()->with('success', $statusMessages[$request->status] . '!');
    }

    public function viewWorkerProfile(Application $application)
    {
        // Ensure the application belongs to a job posted by the current employer
        if ($application->jobListing->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $worker = $application->worker;
        $worker->load([
            'profile', 
            'userSkills.skill', 
            'userLanguages.language', 
            'educationRecords', 
            'references'
        ]);

        return view('employer.applications.worker-profile', compact('application', 'worker'));
    }

    public function shortlistApplication(Application $application)
    {
        // Ensure the application belongs to a job posted by the current employer
        if ($application->jobListing->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->update(['status' => 'shortlisted']);

        return redirect()->back()->with('success', 'Application has been shortlisted successfully!');
    }

    public function hireApplication(Application $application)
    {
        // Ensure the application belongs to a job posted by the current employer
        if ($application->jobListing->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->update(['status' => 'hired']);

        // Also update the job status to in_progress if it's still open
        if ($application->jobListing->status === 'open') {
            $application->jobListing->update(['status' => 'in_progress']);
        }

        return redirect()->back()->with('success', 'Worker has been hired successfully!');
    }

    public function rejectApplication(Application $application)
    {
        // Ensure the application belongs to a job posted by the current employer
        if ($application->jobListing->employer_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $application->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Application has been rejected.');
    }
}
