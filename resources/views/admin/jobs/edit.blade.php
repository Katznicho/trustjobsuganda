<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Edit Job: {{ $job->title }}</h3>
                        <a href="{{ route('admin.jobs.show', $job) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Back to Job
                        </a>
                    </div>

                    <form method="POST" action="{{ route('admin.jobs.update', $job) }}" id="editJobForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Job Information -->
                            <div class="space-y-6">
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                                            <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('title') border-red-300 @enderror">
                                            @error('title')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea name="description" id="description" rows="4" 
                                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-300 @enderror">{{ old('description', $job->description) }}</textarea>
                                            @error('description')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="budget" class="block text-sm font-medium text-gray-700">Budget (UGX)</label>
                                                <input type="number" name="budget" id="budget" value="{{ old('budget', $job->budget) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('budget') border-red-300 @enderror">
                                                @error('budget')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="pay_type" class="block text-sm font-medium text-gray-700">Payment Type</label>
                                                <select name="pay_type" id="pay_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('pay_type') border-red-300 @enderror">
                                                    <option value="fixed" {{ old('pay_type', $job->pay_type) === 'fixed' ? 'selected' : '' }}>Fixed</option>
                                                    <option value="hourly" {{ old('pay_type', $job->pay_type) === 'hourly' ? 'selected' : '' }}>Hourly</option>
                                                    <option value="daily" {{ old('pay_type', $job->pay_type) === 'daily' ? 'selected' : '' }}>Daily</option>
                                                </select>
                                                @error('pay_type')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Location Information -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Location Information</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                                            <input type="text" name="district" id="district" value="{{ old('district', $job->district) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('district') border-red-300 @enderror">
                                            @error('district')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="specific_location" class="block text-sm font-medium text-gray-700">Specific Location (Optional)</label>
                                            <input type="text" name="specific_location" id="specific_location" value="{{ old('specific_location', $job->specific_location) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('specific_location') border-red-300 @enderror">
                                            @error('specific_location')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Details -->
                            <div class="space-y-6">
                                <!-- Status and Requirements -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Status & Requirements</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700">Job Status</label>
                                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-300 @enderror">
                                                <option value="open" {{ old('status', $job->status) === 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in_progress" {{ old('status', $job->status) === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ old('status', $job->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('status', $job->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            @error('status')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="required_skills" class="block text-sm font-medium text-gray-700">Required Skills</label>
                                            <textarea name="required_skills" id="required_skills" rows="2" 
                                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('required_skills') border-red-300 @enderror">{{ old('required_skills', $job->required_skills) }}</textarea>
                                            @error('required_skills')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="experience_level" class="block text-sm font-medium text-gray-700">Experience Level</label>
                                            <input type="text" name="experience_level" id="experience_level" value="{{ old('experience_level', $job->experience_level) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('experience_level') border-red-300 @enderror">
                                            @error('experience_level')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                                            <input type="text" name="duration" id="duration" value="{{ old('duration', $job->duration) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('duration') border-red-300 @enderror">
                                            @error('duration')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline (Optional)</label>
                                            <input type="date" name="deadline" id="deadline" value="{{ old('deadline', $job->deadline) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('deadline') border-red-300 @enderror">
                                            @error('deadline')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Employer Information -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Employer Information</h4>
                                    
                                    <div class="space-y-2">
                                        <div class="text-sm text-gray-900 font-medium">{{ $job->employer->full_name }}</div>
                                        <div class="text-sm text-gray-600">{{ $job->employer->email }}</div>
                                        <div class="text-sm text-gray-600">{{ $job->employer->phone_e164 }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('admin.jobs.show', $job) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Update Job
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editJobForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Updating Job...',
                text: 'Please wait while we update the job information.',
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

