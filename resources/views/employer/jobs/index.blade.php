<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Job Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Job Listings</h3>
                        <a href="{{ route('employer.jobs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Post New Job
                        </a>
                    </div>

                    @if($jobs->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($jobs as $job)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $job->title }}</h4>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($job->status === 'open') bg-green-100 text-green-800
                                        @elseif($job->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @elseif($job->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-600 mb-4">{{ Str::limit($job->description, 100) }}</p>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Budget:</span>
                                        <span class="font-medium">UGX {{ number_format($job->budget) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Pay Type:</span>
                                        <span class="font-medium">{{ ucfirst($job->pay_type) }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Location:</span>
                                        <span class="font-medium">{{ $job->district }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Applications:</span>
                                        <span class="font-medium">{{ $job->applications->count() }}</span>
                                    </div>
                                </div>

                                @if($job->urgent)
                                <div class="mb-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Urgent
                                    </span>
                                </div>
                                @endif

                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('employer.jobs.show', $job) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">View Details</a>
                                    <a href="{{ route('employer.jobs.edit', $job) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">Edit</a>
                                    
                                    @if($job->status === 'open')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'in_progress', 'Mark as Taken')" class="text-green-600 hover:text-green-900 text-sm">Mark as Taken</button>
                                        <button onclick="updateJobStatus({{ $job->id }}, 'cancelled', 'Mark as Unavailable')" class="text-orange-600 hover:text-orange-900 text-sm">Mark as Unavailable</button>
                                    @elseif($job->status === 'in_progress')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'completed', 'Mark as Completed')" class="text-blue-600 hover:text-blue-900 text-sm">Mark as Completed</button>
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="text-green-600 hover:text-green-900 text-sm">Reopen</button>
                                    @elseif($job->status === 'completed')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="text-green-600 hover:text-green-900 text-sm">Reopen</button>
                                    @elseif($job->status === 'cancelled')
                                        <button onclick="updateJobStatus({{ $job->id }}, 'open', 'Reopen Job')" class="text-green-600 hover:text-green-900 text-sm">Reopen</button>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('employer.jobs.destroy', $job) }}" class="inline" onsubmit="return confirmDeleteJob({{ $job->id }}, '{{ $job->title }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($jobs->hasPages())
                        <div class="mt-6">
                            {{ $jobs->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs posted yet</h3>
                            <p class="text-gray-500 mb-6">Get started by posting your first job listing.</p>
                            <a href="{{ route('employer.jobs.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
                                Post Your First Job
                            </a>
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
        function confirmDeleteJob(jobId, jobTitle) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the job "${jobTitle}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // The form will submit automatically
                    return true;
                }
                return false;
            });
        }

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

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        // Show error message if exists
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



