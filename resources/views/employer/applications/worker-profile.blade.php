<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Worker Profile') }}
            </h2>
            <a href="{{ route('employer.applications.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                ← Back to Applications
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Application Status Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $application->jobListing->title }}</h3>
                            <p class="text-gray-600">Application from {{ $worker->full_name }}</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($application->status === 'shortlisted') bg-blue-100 text-blue-800
                                @elseif($application->status === 'hired') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($application->status) }}
                            </span>
                            <p class="text-sm text-gray-500 mt-1">Applied {{ $application->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    @if($application->cover_letter)
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Cover Letter:</h4>
                        <p class="text-gray-700">{{ $application->cover_letter }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Worker Profile Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Profile Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Personal Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm text-gray-500">Full Name</label>
                                    <p class="font-medium">{{ $worker->full_name }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Email</label>
                                    <p class="font-medium">{{ $worker->email }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Phone</label>
                                    <p class="font-medium">{{ $worker->phone_e164 }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Date of Birth</label>
                                    <p class="font-medium">{{ $worker->profile->date_of_birth ? $worker->profile->date_of_birth->format('M d, Y') : 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Gender</label>
                                    <p class="font-medium">{{ $worker->profile->gender ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Nationality</label>
                                    <p class="font-medium">{{ $worker->profile->nationality ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Location</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-sm text-gray-500">District</label>
                                    <p class="font-medium">{{ $worker->profile->district ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Division</label>
                                    <p class="font-medium">{{ $worker->profile->division ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Parish</label>
                                    <p class="font-medium">{{ $worker->profile->parish ?? 'Not provided' }}</p>
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Village</label>
                                    <p class="font-medium">{{ $worker->profile->village ?? 'Not provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    @if($worker->userSkills->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Skills</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($worker->userSkills as $userSkill)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900">{{ $userSkill->skill->name }}</h4>
                                    <div class="mt-2 space-y-1">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Experience:</span> {{ $userSkill->experience_tier }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Years:</span> {{ $userSkill->years_estimate }}
                                        </p>
                                        @if($userSkill->has_certificate)
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Certificate:</span> {{ $userSkill->certificate_name }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Institution:</span> {{ $userSkill->institution_name }}
                                        </p>
                                        @if($userSkill->issue_date)
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Issue Date:</span> {{ $userSkill->issue_date->format('M d, Y') }}
                                        </p>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Education -->
                    @if($worker->educationRecords->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Education</h3>
                            <div class="space-y-4">
                                @foreach($worker->educationRecords as $education)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900">{{ $education->institution_name }}</h4>
                                    <p class="text-gray-600">{{ $education->degree }} in {{ $education->field_of_study }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $education->start_date->format('Y') }} - 
                                        {{ $education->end_date ? $education->end_date->format('Y') : 'Present' }}
                                    </p>
                                    @if($education->description)
                                    <p class="text-sm text-gray-600 mt-2">{{ $education->description }}</p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Languages -->
                    @if($worker->userLanguages->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Languages</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($worker->userLanguages as $userLanguage)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900">{{ $userLanguage->language->name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium">Proficiency:</span> {{ ucfirst($userLanguage->proficiency_level) }}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- References -->
                    @if($worker->references->count() > 0)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">References</h3>
                            <div class="space-y-4">
                                @foreach($worker->references as $reference)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <h4 class="font-medium text-gray-900">{{ $reference->name }}</h4>
                                    <p class="text-gray-600">{{ $reference->position }} at {{ $reference->company }}</p>
                                    <p class="text-sm text-gray-600">{{ $reference->phone }}</p>
                                    <p class="text-sm text-gray-600">{{ $reference->email }}</p>
                                    @if($reference->relationship)
                                    <p class="text-sm text-gray-500 mt-2">
                                        <span class="font-medium">Relationship:</span> {{ $reference->relationship }}
                                    </p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Sidebar Actions -->
                <div class="space-y-6">
                    <!-- Action Buttons -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                            <div class="space-y-3">
                                @if($application->status === 'pending')
                                    <button onclick="shortlistApplication({{ $application->id }})" 
                                            class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                                        Shortlist Application
                                    </button>
                                    <button onclick="hireApplication({{ $application->id }})" 
                                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                        Hire Worker
                                    </button>
                                    <button onclick="rejectApplication({{ $application->id }})" 
                                            class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                                        Reject Application
                                    </button>
                                @elseif($application->status === 'shortlisted')
                                    <button onclick="hireApplication({{ $application->id }})" 
                                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                        Hire Worker
                                    </button>
                                    <button onclick="rejectApplication({{ $application->id }})" 
                                            class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                                        Reject Application
                                    </button>
                                @elseif($application->status === 'hired')
                                    <div class="text-center py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            ✓ Worker Hired
                                        </span>
                                    </div>
                                @elseif($application->status === 'rejected')
                                    <div class="text-center py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            ✗ Application Rejected
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Worker</h3>
                            <div class="space-y-3">
                                <a href="mailto:{{ $worker->email }}" 
                                   class="block w-full bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition text-center">
                                    Send Email
                                </a>
                                <a href="tel:{{ $worker->phone_e164 }}" 
                                   class="block w-full bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition text-center">
                                    Call Worker
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Information -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Details</h3>
                            <div class="space-y-2">
                                <p class="text-sm">
                                    <span class="font-medium">Title:</span> {{ $application->jobListing->title }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium">Location:</span> {{ $application->jobListing->district }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium">Budget:</span> UGX {{ number_format($application->jobListing->budget) }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium">Pay Type:</span> {{ ucfirst($application->jobListing->pay_type) }}
                                </p>
                                <p class="text-sm">
                                    <span class="font-medium">Status:</span> 
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($application->jobListing->status === 'open') bg-green-100 text-green-800
                                        @elseif($application->jobListing->status === 'in_progress') bg-blue-100 text-blue-800
                                        @elseif($application->jobListing->status === 'completed') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($application->jobListing->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function shortlistApplication(applicationId) {
            Swal.fire({
                title: 'Shortlist Application?',
                text: 'Are you sure you want to shortlist this application?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Shortlist',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/employer/applications/${applicationId}/shortlist`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function hireApplication(applicationId) {
            Swal.fire({
                title: 'Hire Worker?',
                text: 'Are you sure you want to hire this worker? This will mark the job as in progress.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Hire',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/employer/applications/${applicationId}/hire`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function rejectApplication(applicationId) {
            Swal.fire({
                title: 'Reject Application?',
                text: 'Are you sure you want to reject this application? This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, Reject',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/employer/applications/${applicationId}/reject`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH';
                    form.appendChild(methodField);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
</x-app-layout>
