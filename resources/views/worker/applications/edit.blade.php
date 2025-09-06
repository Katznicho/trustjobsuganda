<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Application') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Edit Application</h3>
                        <a href="{{ route('worker.applications.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Back to Applications
                        </a>
                    </div>

                    <!-- Job Information -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Job Title:</span>
                                <p class="font-medium text-gray-900">{{ $application->job->title }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Employer:</span>
                                <p class="font-medium text-gray-900">{{ $application->job->employer->full_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Location:</span>
                                <p class="font-medium text-gray-900">{{ $application->job->district }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Budget:</span>
                                <p class="font-medium text-gray-900">UGX {{ number_format($application->job->budget) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Application Form -->
                    <form method="POST" action="{{ route('worker.applications.update', $application) }}" id="editApplicationForm">
                        @csrf
                        @method('PUT')

                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Application Details</h4>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">
                                        Cover Letter
                                    </label>
                                    <textarea 
                                        name="cover_letter" 
                                        id="cover_letter" 
                                        rows="8" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('cover_letter') border-red-300 @enderror"
                                        placeholder="Write a compelling cover letter explaining why you're the best fit for this job..."
                                    >{{ old('cover_letter', $application->cover_letter) }}</textarea>
                                    <p class="mt-1 text-sm text-gray-500">
                                        A well-written cover letter can significantly improve your chances of getting hired. 
                                        Explain your relevant experience, skills, and why you're interested in this position.
                                    </p>
                                    @error('cover_letter')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Application Status Info -->
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div>
                                            <h5 class="text-sm font-medium text-blue-900">Application Status</h5>
                                            <p class="text-sm text-blue-700">
                                                Your application is currently 
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($application->status === 'shortlisted') bg-blue-100 text-blue-800
                                                    @elseif($application->status === 'hired') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Application Timeline -->
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="text-sm font-medium text-gray-900 mb-2">Application Timeline</h5>
                                    <div class="space-y-1 text-sm text-gray-600">
                                        <p><strong>Applied:</strong> {{ $application->created_at->format('F d, Y \a\t g:i A') }}</p>
                                        <p><strong>Last Updated:</strong> {{ $application->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('worker.applications.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Update Application
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with SweetAlert
        document.getElementById('editApplicationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const coverLetter = document.getElementById('cover_letter').value.trim();
            
            if (coverLetter.length < 10) {
                Swal.fire({
                    title: 'Cover Letter Too Short',
                    text: 'Please write a more detailed cover letter (at least 10 characters).',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            // Show loading state
            Swal.fire({
                title: 'Updating Application...',
                text: 'Please wait while we update your application.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit the form
            this.submit();
        });

        // Show validation errors if any
        @if($errors->any())
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please check the form for errors and try again.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-app-layout>

