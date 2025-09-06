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
                        <a href="{{ route('employer.jobs.show', $job) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Back to Job
                        </a>
                    </div>

                    <form method="POST" action="{{ route('employer.jobs.update', $job) }}" id="editJobForm">
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
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="district" class="block text-sm font-medium text-gray-700">District</label>
                                                <input type="text" name="district" id="district" value="{{ old('district', $job->district) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('district') border-red-300 @enderror">
                                                @error('district')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="division" class="block text-sm font-medium text-gray-700">Division/Subcounty</label>
                                                <input type="text" name="division" id="division" value="{{ old('division', $job->division) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('division') border-red-300 @enderror">
                                                @error('division')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="parish" class="block text-sm font-medium text-gray-700">Parish/Ward</label>
                                                <input type="text" name="parish" id="parish" value="{{ old('parish', $job->parish) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('parish') border-red-300 @enderror">
                                                @error('parish')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="village" class="block text-sm font-medium text-gray-700">Village/LC1</label>
                                                <input type="text" name="village" id="village" value="{{ old('village', $job->village) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('village') border-red-300 @enderror">
                                                @error('village')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Details -->
                            <div class="space-y-6">
                                <!-- Skills and Requirements -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Required Skills</h4>
                                    <p class="text-sm text-gray-600 mb-4">Select the skills required for this job. You can choose multiple skills from different categories.</p>
                                    
                                    <div class="border border-gray-300 rounded-lg p-4 max-h-96 overflow-y-auto skills-container">
                                        @foreach($skillCategories as $category)
                                            <div class="mb-6 last:mb-0">
                                                <h4 class="text-sm font-semibold text-gray-900 mb-3 flex items-center skill-category-header">
                                                    <span class="mr-2">{{ $category->icon ?? '📋' }}</span>
                                                    {{ $category->name }}
                                                </h4>
                                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 ml-6">
                                                    @foreach($category->skills as $skill)
                                                        <label class="flex items-center p-2 rounded-md cursor-pointer skill-checkbox-container">
                                                            <input type="checkbox" 
                                                                   name="required_skill_ids[]" 
                                                                   value="{{ $skill->id }}"
                                                                   {{ in_array($skill->id, old('required_skill_ids', $job->required_skill_ids ?? [])) ? 'checked' : '' }}
                                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mr-2">
                                                            <span class="text-sm text-gray-700">{{ $skill->name }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="mt-2 flex items-center justify-between">
                                        <div class="flex space-x-2">
                                            <button type="button" onclick="selectAllSkills()" class="text-sm text-indigo-600 hover:text-indigo-800">Select All</button>
                                            <button type="button" onclick="clearAllSkills()" class="text-sm text-gray-600 hover:text-gray-800">Clear All</button>
                                        </div>
                                        <span id="selected-count" class="text-sm text-gray-500">0 skills selected</span>
                                    </div>
                                    
                                    @error('required_skill_ids')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Experience and Status -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Requirements & Status</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="min_experience_tier" class="block text-sm font-medium text-gray-700">Minimum Experience Required</label>
                                            <select name="min_experience_tier" id="min_experience_tier" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('min_experience_tier') border-red-300 @enderror">
                                                <option value="">Select Experience Level</option>
                                                <option value="<6 months" {{ old('min_experience_tier', $job->min_experience_tier) === '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                                <option value="6-12 months" {{ old('min_experience_tier', $job->min_experience_tier) === '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                                <option value="1-2 years" {{ old('min_experience_tier', $job->min_experience_tier) === '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                                <option value="2-5 years" {{ old('min_experience_tier', $job->min_experience_tier) === '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                                <option value=">5 years" {{ old('min_experience_tier', $job->min_experience_tier) === '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                                            </select>
                                            @error('min_experience_tier')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

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

                                        <div class="flex items-center">
                                            <input id="urgent" type="checkbox" name="urgent" value="1" {{ old('urgent', $job->urgent) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <label for="urgent" class="ml-2 text-sm text-gray-600">
                                                Mark as Urgent Job
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('employer.jobs.show', $job) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
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

    <style>
        .skill-checkbox-container {
            transition: all 0.2s ease;
        }
        
        .skill-checkbox-container:hover {
            background-color: #f9fafb;
            transform: translateY(-1px);
        }
        
        .skill-checkbox-container input[type="checkbox"]:checked + span {
            color: #1f2937;
            font-weight: 500;
        }
        
        .skill-category-header {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .skills-container {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }
        
        .skills-container::-webkit-scrollbar {
            width: 6px;
        }
        
        .skills-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        
        .skills-container::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        .skills-container::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <script>
        // Update selected skills counter
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('input[name="required_skill_ids[]"]');
            const checkedBoxes = document.querySelectorAll('input[name="required_skill_ids[]"]:checked');
            const countElement = document.getElementById('selected-count');
            
            countElement.textContent = `${checkedBoxes.length} skill${checkedBoxes.length !== 1 ? 's' : ''} selected`;
        }

        // Select all skills
        function selectAllSkills() {
            const checkboxes = document.querySelectorAll('input[name="required_skill_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
        }

        // Clear all skills
        function clearAllSkills() {
            const checkboxes = document.querySelectorAll('input[name="required_skill_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
        }

        // Add event listeners to all skill checkboxes
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[name="required_skill_ids[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSelectedCount);
            });
            
            // Initialize counter
            updateSelectedCount();
        });

        // Form submission with SweetAlert
        document.getElementById('editJobForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const checkedBoxes = document.querySelectorAll('input[name="required_skill_ids[]"]:checked');
            
            if (checkedBoxes.length === 0) {
                e.preventDefault();
                Swal.fire({
                    title: 'No Skills Selected',
                    text: 'Please select at least one skill required for this job.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            // Show loading state
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

