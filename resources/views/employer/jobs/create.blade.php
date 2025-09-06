<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post New Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('employer.jobs.store') }}" class="space-y-6">
                        @csrf

                        <!-- Job Title -->
                        <div>
                            <x-input-label for="title" :value="__('Job Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Job Description -->
                        <div>
                            <x-input-label for="description" :value="__('Job Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Required Skills -->
                        <div>
                            <x-input-label for="required_skills" :value="__('Required Skills')" />
                            <p class="text-sm text-gray-600 mt-1 mb-4">Select the skills required for this job. You can choose multiple skills from different categories.</p>
                            
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
                                                           {{ in_array($skill->id, old('required_skill_ids', [])) ? 'checked' : '' }}
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
                            
                            <x-input-error :messages="$errors->get('required_skill_ids')" class="mt-2" />
                        </div>

                        <!-- Minimum Experience -->
                        <div>
                            <x-input-label for="min_experience_tier" :value="__('Minimum Experience Required')" />
                            <select id="min_experience_tier" name="min_experience_tier" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Experience Level</option>
                                <option value="<6 months" {{ old('min_experience_tier') == '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                <option value="6-12 months" {{ old('min_experience_tier') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                <option value="1-2 years" {{ old('min_experience_tier') == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                <option value="2-5 years" {{ old('min_experience_tier') == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                <option value=">5 years" {{ old('min_experience_tier') == '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                            </select>
                            <x-input-error :messages="$errors->get('min_experience_tier')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="district" :value="__('District')" />
                                <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required />
                                <x-input-error :messages="$errors->get('district')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="division" :value="__('Division/Subcounty')" />
                                <x-text-input id="division" class="block mt-1 w-full" type="text" name="division" :value="old('division')" />
                                <x-input-error :messages="$errors->get('division')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="parish" :value="__('Parish/Ward')" />
                                <x-text-input id="parish" class="block mt-1 w-full" type="text" name="parish" :value="old('parish')" />
                                <x-input-error :messages="$errors->get('parish')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="village" :value="__('Village/LC1')" />
                                <x-text-input id="village" class="block mt-1 w-full" type="text" name="village" :value="old('village')" />
                                <x-input-error :messages="$errors->get('village')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Budget and Pay Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="budget" :value="__('Budget (UGX)')" />
                                <x-text-input id="budget" class="block mt-1 w-full" type="number" name="budget" :value="old('budget')" required min="0" step="0.01" />
                                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="pay_type" :value="__('Pay Type')" />
                                <select id="pay_type" name="pay_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Pay Type</option>
                                    <option value="daily" {{ old('pay_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="hourly" {{ old('pay_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                    <option value="fixed" {{ old('pay_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                </select>
                                <x-input-error :messages="$errors->get('pay_type')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Urgent Job -->
                        <div class="flex items-center">
                            <input id="urgent" type="checkbox" name="urgent" value="1" {{ old('urgent') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="urgent" class="ml-2 text-sm text-gray-600">
                                {{ __('Mark as Urgent Job') }}
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('employer.jobs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Post Job') }}
                            </x-primary-button>
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
        document.querySelector('form').addEventListener('submit', function(e) {
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
                title: 'Posting Job...',
                text: 'Please wait while we create your job listing.',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
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



