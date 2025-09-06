<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Workers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Search Filters</h3>
                    <form method="GET" action="{{ route('employer.workers.search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="skill" class="block text-sm font-medium text-gray-700 mb-1">Skill</label>
                            <select id="skill" name="skill_id" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Skills</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ request('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }} ({{ $skill->category->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Experience</label>
                            <select id="experience" name="min_experience" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Any Experience</option>
                                <option value="<6 months" {{ request('min_experience') == '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                <option value="6-12 months" {{ request('min_experience') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                <option value="1-2 years" {{ request('min_experience') == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                <option value="2-5 years" {{ request('min_experience') == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                <option value=">5 years" {{ request('min_experience') == '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                            </select>
                        </div>
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                            <input type="text" id="district" name="district" value="{{ request('district') }}" placeholder="Enter district" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Results -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            @if(request()->hasAny(['skill_id', 'min_experience', 'district']))
                                Search Results ({{ $workers->total() }} workers found)
                            @else
                                All Available Workers
                            @endif
                        </h3>
                    </div>

                    @if($workers->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($workers as $worker)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center mr-4">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ substr($worker->first_name, 0, 1) }}{{ substr($worker->last_name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900">{{ $worker->full_name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $worker->district ?? 'Location not specified' }}</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h5 class="font-medium text-gray-900 mb-2">Skills:</h5>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($worker->userSkills->take(3) as $userSkill)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $userSkill->skill->name }}
                                        </span>
                                        @endforeach
                                        @if($worker->userSkills->count() > 3)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            +{{ $worker->userSkills->count() - 3 }} more
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Experience:</span>
                                        <span class="font-medium">{{ $worker->userSkills->count() }} skills</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Certificates:</span>
                                        <span class="font-medium">{{ $worker->userSkills->where('has_certificate', true)->count() }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Languages:</span>
                                        <span class="font-medium">{{ $worker->userLanguages->count() }}</span>
                                    </div>
                                </div>

                                <div class="flex space-x-2">
                                    <a href="{{ route('employer.workers.profile', $worker) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">View Profile</a>
                                    <button onclick="openContactModal({{ $worker->id }}, '{{ $worker->full_name }}')" class="text-green-600 hover:text-green-900 text-sm">Contact</button>
                                    <button onclick="openInviteModal({{ $worker->id }}, '{{ $worker->full_name }}')" class="text-blue-600 hover:text-blue-900 text-sm">Invite to Job</button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($workers->hasPages())
                        <div class="mt-6">
                            {{ $workers->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No workers found</h3>
                            <p class="text-gray-500 mb-6">Try adjusting your search criteria to find more workers.</p>
                        </div>
                    @endif
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



