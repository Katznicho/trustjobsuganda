<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('worker.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Back to Jobs
                            </a>
                            @php
                                $hasApplied = Auth::user()->applications()->where('job_id', $job->id)->exists();
                            @endphp
                            @if($hasApplied)
                                <span class="bg-gray-500 text-white px-4 py-2 rounded-md text-sm cursor-not-allowed">
                                    Already Applied
                                </span>
                            @else
                                <button onclick="applyToJob({{ $job->id }}, '{{ $job->title }}')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Apply Now
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Job Information -->
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Description</h4>
                                <p class="text-gray-700 leading-relaxed">{{ $job->description }}</p>
                            </div>

                            <div class="mt-6 bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Requirements</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-600 w-32">Experience Level:</span>
                                        <span class="text-sm text-gray-900">{{ $job->min_experience_tier ?? 'Not specified' }}</span>
                                    </div>
                                    @if($job->required_skill_ids && count($job->required_skill_ids) > 0)
                                    <div class="flex items-start">
                                        <span class="text-sm font-medium text-gray-600 w-32">Required Skills:</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($job->required_skill_ids as $skillId)
                                                @php
                                                    $skill = \App\Models\Skill::find($skillId);
                                                @endphp
                                                @if($skill)
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $skill->name }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Employer Information -->
                            <div class="mt-6 bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Employer Information</h4>
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-lg font-medium text-gray-700">
                                                {{ substr($job->employer->first_name, 0, 1) }}{{ substr($job->employer->last_name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-lg font-medium text-gray-900">{{ $job->employer->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $job->employer->email }}</div>
                                        @if($job->employer->profile && $job->employer->profile->company_name)
                                            <div class="text-sm text-gray-600">{{ $job->employer->profile->company_name }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Details Sidebar -->
                        <div class="space-y-6">
                            <!-- Status Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Status</h4>
                                <div class="flex items-center">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                        @if($job->status === 'open') bg-green-100 text-green-800
                                        @elseif($job->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @elseif($job->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                    </span>
                                </div>
                                
                                @if($job->urgent)
                                <div class="mt-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Urgent Job
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Budget Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Budget</h4>
                                <div class="space-y-2">
                                    <div class="text-2xl font-bold text-gray-900">
                                        UGX {{ number_format($job->budget) }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ ucfirst($job->pay_type) }} Payment
                                    </div>
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Location</h4>
                                <div class="space-y-2">
                                    <div class="text-sm text-gray-900">{{ $job->district }}</div>
                                    @if($job->division)
                                        <div class="text-sm text-gray-600">{{ $job->division }}</div>
                                    @endif
                                    @if($job->parish)
                                        <div class="text-sm text-gray-600">{{ $job->parish }}</div>
                                    @endif
                                    @if($job->village)
                                        <div class="text-sm text-gray-600">{{ $job->village }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Timeline Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Posted:</span>
                                        <span class="text-sm text-gray-900">{{ $job->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Last Updated:</span>
                                        <span class="text-sm text-gray-900">{{ $job->updated_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Application Stats -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Application Stats</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Total Applications:</span>
                                        <span class="text-sm text-gray-900">{{ $job->applications->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for job applications -->
    <form id="applicationForm" method="POST" style="display: none;">
        @csrf
        <input type="hidden" id="application_job_id" name="job_id">
        <textarea id="cover_letter" name="cover_letter" placeholder="Write your cover letter here..."></textarea>
    </form>

    <script>
        function applyToJob(jobId, jobTitle) {
            Swal.fire({
                title: 'Apply to Job',
                text: `Apply for "${jobTitle}"?`,
                input: 'textarea',
                inputLabel: 'Cover Letter (Optional)',
                inputPlaceholder: 'Write a brief cover letter explaining why you\'re suitable for this job...',
                inputAttributes: {
                    'aria-label': 'Type your cover letter here'
                },
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Apply Now',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    // Cover letter is optional, so no validation needed
                    return Promise.resolve();
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update the hidden form
                    document.getElementById('application_job_id').value = jobId;
                    document.getElementById('cover_letter').value = result.value || '';
                    
                    // Set the form action
                    document.getElementById('applicationForm').action = `/worker/jobs/${jobId}/apply`;
                    
                    // Show loading
                    Swal.fire({
                        title: 'Applying...',
                        text: 'Please wait while we submit your application.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    document.getElementById('applicationForm').submit();
                }
            });
        }

        // Show success/error messages
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-app-layout>

