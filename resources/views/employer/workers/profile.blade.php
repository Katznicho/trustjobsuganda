<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Worker Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center mr-6">
                                <span class="text-xl font-medium text-gray-700">
                                    {{ substr($worker->first_name, 0, 1) }}{{ substr($worker->last_name, 0, 1) }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900">{{ $worker->full_name }}</h3>
                                <p class="text-sm text-gray-600">{{ $worker->profile->location ?? 'Location not specified' }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="openContactModal({{ $worker->id }}, '{{ $worker->full_name }}')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Contact Worker
                            </button>
                            <button onclick="openInviteModal({{ $worker->id }}, '{{ $worker->full_name }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Invite to Job
                            </button>
                            <a href="{{ route('employer.workers.search') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Back to Search
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Worker Information -->
                        <div class="lg:col-span-2">
                            <!-- Bio Section -->
                            @if($worker->profile && $worker->profile->bio)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">About</h4>
                                <p class="text-gray-700 leading-relaxed">{{ $worker->profile->bio }}</p>
                            </div>
                            @endif

                            <!-- Skills Section -->
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Skills & Experience</h4>
                                @if($worker->userSkills->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($worker->userSkills as $userSkill)
                                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                                            <div class="flex justify-between items-start mb-2">
                                                <h5 class="font-medium text-gray-900">{{ $userSkill->skill->name }}</h5>
                                                @if($userSkill->has_certificate)
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        Certified
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-600 mb-2">{{ $userSkill->experience_tier }}</p>
                                            @if($userSkill->years_estimate)
                                                <p class="text-sm text-gray-500">~{{ $userSkill->years_estimate }} years experience</p>
                                            @endif
                                            @if($userSkill->institution_name)
                                                <p class="text-sm text-gray-500 mt-1">
                                                    <span class="font-medium">Institution:</span> {{ $userSkill->institution_name }}
                                                </p>
                                            @endif
                                            @if($userSkill->certificate_name)
                                                <p class="text-sm text-gray-500">
                                                    <span class="font-medium">Certificate:</span> {{ $userSkill->certificate_name }}
                                                </p>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500">No skills listed yet.</p>
                                @endif
                            </div>

                            <!-- Education Section -->
                            @if($worker->educationRecords->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Education</h4>
                                <div class="space-y-4">
                                    @foreach($worker->educationRecords as $education)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h5 class="font-medium text-gray-900">{{ $education->institution_name }}</h5>
                                                <p class="text-sm text-gray-600">{{ $education->degree }} in {{ $education->field_of_study }}</p>
                                                @if($education->graduation_year)
                                                    <p class="text-sm text-gray-500">Graduated: {{ $education->graduation_year }}</p>
                                                @endif
                                            </div>
                                            @if($education->is_completed)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Completed
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    In Progress
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Languages Section -->
                            @if($worker->userLanguages->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Languages</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($worker->userLanguages as $userLanguage)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h5 class="font-medium text-gray-900">{{ $userLanguage->language->name }}</h5>
                                        <p class="text-sm text-gray-600">{{ ucfirst($userLanguage->proficiency_level) }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- References Section -->
                            @if($worker->references->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">References</h4>
                                <div class="space-y-4">
                                    @foreach($worker->references as $reference)
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h5 class="font-medium text-gray-900">{{ $reference->name }}</h5>
                                        <p class="text-sm text-gray-600">{{ $reference->relationship }}</p>
                                        @if($reference->phone)
                                            <p class="text-sm text-gray-500">Phone: {{ $reference->phone }}</p>
                                        @endif
                                        @if($reference->email)
                                            <p class="text-sm text-gray-500">Email: {{ $reference->email }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Contact Information -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $worker->email }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $worker->phone_e164 }}</span>
                                    </div>
                                    @if($worker->profile && $worker->profile->location)
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-900">{{ $worker->profile->location }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Statistics -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Profile Statistics</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Skills:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->userSkills->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Certificates:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->userSkills->where('has_certificate', true)->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Languages:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->userLanguages->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Education:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->educationRecords->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">References:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->references->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Applications:</span>
                                        <span class="text-sm text-gray-900">{{ $worker->applications->count() }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Availability -->
                            @if($worker->profile && $worker->profile->availability)
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Availability</h4>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                    @if($worker->profile->availability === 'available') bg-green-100 text-green-800
                                    @elseif($worker->profile->availability === 'busy') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($worker->profile->availability) }}
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Contact Worker</h3>
                    <button onclick="closeContactModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="contactForm" method="POST" action="{{ route('employer.workers.contact') }}">
                    @csrf
                    <input type="hidden" id="contact_worker_id" name="worker_id">
                    
                    <div class="mb-4">
                        <label for="contact_subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="contact_subject" name="subject" required 
                               class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="contact_message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="contact_message" name="message" rows="4" required 
                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeContactModal()" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Invite to Job Modal -->
    <div id="inviteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Invite to Job</h3>
                    <button onclick="closeInviteModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="inviteForm" method="POST" action="{{ route('employer.workers.invite') }}">
                    @csrf
                    <input type="hidden" id="invite_worker_id" name="worker_id">
                    
                    <div class="mb-4">
                        <label for="invite_job_id" class="block text-sm font-medium text-gray-700 mb-1">Select Job</label>
                        <select id="invite_job_id" name="job_id" required 
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Choose a job...</option>
                            @foreach(Auth::user()->jobListings()->where('status', 'open')->get() as $job)
                                <option value="{{ $job->id }}">{{ $job->title }} - UGX {{ number_format($job->budget) }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="invite_message" class="block text-sm font-medium text-gray-700 mb-1">Personal Message (Optional)</label>
                        <textarea id="invite_message" name="message" rows="3" 
                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Add a personal message to your invitation..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeInviteModal()" 
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Send Invitation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Contact Modal Functions
        function openContactModal(workerId, workerName) {
            document.getElementById('contact_worker_id').value = workerId;
            document.getElementById('contact_subject').value = `Job Opportunity - ${workerName}`;
            document.getElementById('contactModal').classList.remove('hidden');
        }

        function closeContactModal() {
            document.getElementById('contactModal').classList.add('hidden');
            document.getElementById('contactForm').reset();
        }

        // Invite Modal Functions
        function openInviteModal(workerId, workerName) {
            document.getElementById('invite_worker_id').value = workerId;
            document.getElementById('inviteModal').classList.remove('hidden');
        }

        function closeInviteModal() {
            document.getElementById('inviteModal').classList.add('hidden');
            document.getElementById('inviteForm').reset();
        }

        // Form submissions with SweetAlert
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Sending Message...',
                text: 'Please wait while we send your message.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            this.submit();
        });

        document.getElementById('inviteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Sending Invitation...',
                text: 'Please wait while we send your job invitation.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            this.submit();
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

        // Close modals when clicking outside
        window.onclick = function(event) {
            const contactModal = document.getElementById('contactModal');
            const inviteModal = document.getElementById('inviteModal');
            
            if (event.target === contactModal) {
                closeContactModal();
            }
            if (event.target === inviteModal) {
                closeInviteModal();
            }
        }
    </script>
</x-app-layout>

