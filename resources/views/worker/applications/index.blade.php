<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Job Applications</h3>
                        <div class="flex space-x-2">
                            <select id="statusFilter" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="shortlisted">Shortlisted</option>
                                <option value="hired">Hired</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    @if($applications->count() > 0)
                        <div class="space-y-4">
                            @foreach($applications as $application)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $application->job->title }}</h4>
                                        <p class="text-gray-600">Employer: {{ $application->job->employer->full_name }}</p>
                                    </div>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($application->status === 'shortlisted') bg-blue-100 text-blue-800
                                        @elseif($application->status === 'hired') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <span class="text-sm text-gray-500">Job:</span>
                                        <p class="font-medium">{{ $application->job->title }}</p>
                                        <p class="text-sm text-gray-600">{{ $application->job->district }}</p>
                                        <p class="text-sm text-gray-600">UGX {{ number_format($application->job->budget) }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Employer:</span>
                                        <p class="font-medium">{{ $application->job->employer->full_name }}</p>
                                        <p class="text-sm text-gray-600">{{ $application->job->employer->email }}</p>
                                        <p class="text-sm text-gray-600">{{ $application->job->employer->phone_e164 }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Applied:</span>
                                        <p class="font-medium">{{ $application->created_at->format('M d, Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ $application->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                @if($application->cover_letter)
                                <div class="mb-4">
                                    <span class="text-sm text-gray-500">Your Cover Letter:</span>
                                    <p class="text-gray-900 mt-1">{{ Str::limit($application->cover_letter, 200) }}</p>
                                </div>
                                @endif

                                <div class="flex space-x-2">
                                    <a href="{{ route('worker.jobs.show', $application->job) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">View Job Details</a>
                                    @if($application->status === 'pending')
                                        <a href="{{ route('worker.applications.edit', $application) }}" class="text-yellow-600 hover:text-yellow-900 text-sm">Edit Application</a>
                                        <button onclick="withdrawApplication({{ $application->id }}, '{{ $application->job->title }}')" class="text-red-600 hover:text-red-900 text-sm">Withdraw</button>
                                    @else
                                        <span class="text-gray-400 text-sm cursor-not-allowed">Edit Application</span>
                                        <span class="text-gray-400 text-sm cursor-not-allowed">Withdraw</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($applications->hasPages())
                        <div class="mt-6">
                            {{ $applications->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No applications yet</h3>
                            <p class="text-gray-500 mb-6">Start applying to jobs to see your applications here.</p>
                            <a href="{{ route('worker.jobs.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
                                Browse Jobs
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for withdrawing applications -->
    <form id="withdrawForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function withdrawApplication(applicationId, jobTitle) {
            Swal.fire({
                title: 'Withdraw Application',
                text: `Are you sure you want to withdraw your application for "${jobTitle}"? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, withdraw it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set the form action
                    document.getElementById('withdrawForm').action = `/worker/applications/${applicationId}`;
                    
                    // Show loading
                    Swal.fire({
                        title: 'Withdrawing...',
                        text: 'Please wait while we withdraw your application.',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    
                    // Submit the form
                    document.getElementById('withdrawForm').submit();
                }
            });
        }

        document.getElementById('statusFilter').addEventListener('change', function() {
            const status = this.value;
            const applications = document.querySelectorAll('.border.border-gray-200.rounded-lg');
            
            applications.forEach(app => {
                const statusCell = app.querySelector('span');
                if (status === '' || statusCell.textContent.toLowerCase().includes(status)) {
                    app.style.display = '';
                } else {
                    app.style.display = 'none';
                }
            });
        });

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



