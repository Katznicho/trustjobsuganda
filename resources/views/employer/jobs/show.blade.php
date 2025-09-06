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
                            <a href="{{ route('employer.jobs.edit', $job) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Edit Job
                            </a>
                            <a href="{{ route('employer.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Back to Jobs
                            </a>
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
                                
                                <!-- Status Update Buttons -->
                                <div class="mt-4 space-y-2">
                                    @if($job->status === 'open')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'in_progress', 'Mark as Taken')" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Mark as Taken
                                        </button>
                                        <button onclick="updateJobStatus({{ $job->id }}, 'cancelled', 'Mark as Unavailable')" class="w-full bg-orange-600 hover:bg-orange-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Mark as Unavailable
                                        </button>
                                    @elseif($job->status === 'in_progress')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'completed', 'Mark as Completed')" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Mark as Completed
                                        </button>
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Reopen Job
                                        </button>
                                    @elseif($job->status === 'completed')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Reopen Job
                                        </button>
                                    @elseif($job->status === 'cancelled')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium">
                                            Reopen Job
                                        </button>
                                    @endif
                                </div>
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

                            <!-- Job Options -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Options</h4>
                                <div class="space-y-2">
                                    @if($job->urgent)
                                        <div class="flex items-center">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Urgent Job
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applications Section -->
                    @if($job->applications && $job->applications->count() > 0)
                    <div class="mt-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Applications ({{ $job->applications->count() }})</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($job->applications as $application)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-gray-700">
                                                                {{ substr($application->user->first_name, 0, 1) }}{{ substr($application->user->last_name, 0, 1) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $application->user->full_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $application->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $application->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($application->status === 'accepted') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('employer.workers.profile', $application->user) }}" class="text-indigo-600 hover:text-indigo-900">View Profile</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mt-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <div class="text-center py-8">
                                <div class="text-gray-400 mb-4">
                                    <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
                                <p class="text-gray-500">This job hasn't received any applications yet.</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for status updates -->
    <form id="statusUpdateForm" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" id="status_job_id" name="job_id">
        <input type="hidden" id="status_new_status" name="status">
    </form>

    <script>
        function updateJobStatus(jobId, newStatus, actionText) {
            Swal.fire({
                title: 'Update Job Status',
                text: `Are you sure you want to ${actionText.toLowerCase()}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Update the hidden form
                    document.getElementById('status_job_id').value = jobId;
                    document.getElementById('status_new_status').value = newStatus;
                    
                    // Set the form action
                    document.getElementById('statusUpdateForm').action = `/employer/jobs/${jobId}/status`;
                    
                    // Show loading
                    Swal.fire({
                        title: 'Updating...',
                        text: 'Please wait while we update the job status.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    document.getElementById('statusUpdateForm').submit();
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

