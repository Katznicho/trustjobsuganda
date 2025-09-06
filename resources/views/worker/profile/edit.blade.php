<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Edit Your Profile</h3>
                        <a href="{{ route('worker.profile') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Back to Profile
                        </a>
                    </div>

                    <form method="POST" action="{{ route('worker.profile.update') }}" id="profileForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-6">
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h4>
                                    
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $user->first_name) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('first_name') border-red-300 @enderror">
                                                @error('first_name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $user->last_name) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('last_name') border-red-300 @enderror">
                                                @error('last_name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-300 @enderror">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('phone') border-red-300 @enderror">
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Information -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Profile Information</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                            <textarea name="bio" id="bio" rows="4" 
                                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('bio') border-red-300 @enderror"
                                                      placeholder="Tell employers about yourself, your experience, and what makes you unique...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                                            @error('bio')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                            <input type="text" name="location" id="location" value="{{ old('location', $user->profile->location ?? '') }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('location') border-red-300 @enderror"
                                                   placeholder="e.g., Kampala, Uganda">
                                            @error('location')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                                            <select name="availability" id="availability" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('availability') border-red-300 @enderror">
                                                <option value="">Select Availability</option>
                                                <option value="available" {{ old('availability', $user->profile->availability ?? '') === 'available' ? 'selected' : '' }}>Available</option>
                                                <option value="busy" {{ old('availability', $user->profile->availability ?? '') === 'busy' ? 'selected' : '' }}>Busy</option>
                                                <option value="unavailable" {{ old('availability', $user->profile->availability ?? '') === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                            </select>
                                            @error('availability')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Skills and Languages -->
                            <div class="space-y-6">
                                <!-- Skills -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Skills</h4>
                                    <p class="text-sm text-gray-600 mb-4">Add your skills and experience levels. This helps employers find you for relevant jobs.</p>
                                    
                                    <div id="skills-container">
                                        @if(old('skills'))
                                            @foreach(old('skills') as $index => $skill)
                                                <div class="skill-item border border-gray-200 rounded-lg p-4 mb-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Skill</label>
                                                            <select name="skills[{{ $index }}][skill_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select a skill</option>
                                                                @foreach($skillCategories as $category)
                                                                    <optgroup label="{{ $category->name }}">
                                                                        @foreach($category->skills as $skillOption)
                                                                            <option value="{{ $skillOption->id }}" {{ $skill['skill_id'] == $skillOption->id ? 'selected' : '' }}>
                                                                                {{ $skillOption->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Experience Level</label>
                                                            <select name="skills[{{ $index }}][experience_tier]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select experience</option>
                                                                <option value="<6 months" {{ $skill['experience_tier'] == '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                                                <option value="6-12 months" {{ $skill['experience_tier'] == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                                                <option value="1-2 years" {{ $skill['experience_tier'] == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                                                <option value="2-5 years" {{ $skill['experience_tier'] == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                                                <option value=">5 years" {{ $skill['experience_tier'] == '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex justify-end">
                                                        <button type="button" onclick="removeSkill(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Skill</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach($user->userSkills as $index => $userSkill)
                                                <div class="skill-item border border-gray-200 rounded-lg p-4 mb-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Skill</label>
                                                            <select name="skills[{{ $index }}][skill_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select a skill</option>
                                                                @foreach($skillCategories as $category)
                                                                    <optgroup label="{{ $category->name }}">
                                                                        @foreach($category->skills as $skillOption)
                                                                            <option value="{{ $skillOption->id }}" {{ $userSkill->skill_id == $skillOption->id ? 'selected' : '' }}>
                                                                                {{ $skillOption->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </optgroup>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Experience Level</label>
                                                            <select name="skills[{{ $index }}][experience_tier]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select experience</option>
                                                                <option value="<6 months" {{ $userSkill->experience_tier == '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                                                <option value="6-12 months" {{ $userSkill->experience_tier == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                                                <option value="1-2 years" {{ $userSkill->experience_tier == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                                                <option value="2-5 years" {{ $userSkill->experience_tier == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                                                <option value=">5 years" {{ $userSkill->experience_tier == '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex justify-end">
                                                        <button type="button" onclick="removeSkill(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Skill</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    
                                    <button type="button" onclick="addSkill()" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm">
                                        Add Skill
                                    </button>
                                </div>

                                <!-- Languages -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Languages</h4>
                                    <p class="text-sm text-gray-600 mb-4">Add languages you speak and your proficiency level.</p>
                                    
                                    <div id="languages-container">
                                        @if(old('languages'))
                                            @foreach(old('languages') as $index => $language)
                                                <div class="language-item border border-gray-200 rounded-lg p-4 mb-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Language</label>
                                                            <select name="languages[{{ $index }}][language_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select a language</option>
                                                                @foreach($languages as $languageOption)
                                                                    <option value="{{ $languageOption->id }}" {{ $language['language_id'] == $languageOption->id ? 'selected' : '' }}>
                                                                        {{ $languageOption->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Proficiency</label>
                                                            <select name="languages[{{ $index }}][proficiency]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select proficiency</option>
                                                                <option value="beginner" {{ $language['proficiency'] == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                                <option value="intermediate" {{ $language['proficiency'] == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                                <option value="advanced" {{ $language['proficiency'] == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                                                <option value="native" {{ $language['proficiency'] == 'native' ? 'selected' : '' }}>Native</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex justify-end">
                                                        <button type="button" onclick="removeLanguage(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Language</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach($user->userLanguages as $index => $userLanguage)
                                                <div class="language-item border border-gray-200 rounded-lg p-4 mb-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Language</label>
                                                            <select name="languages[{{ $index }}][language_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select a language</option>
                                                                @foreach($languages as $languageOption)
                                                                    <option value="{{ $languageOption->id }}" {{ $userLanguage->language_id == $languageOption->id ? 'selected' : '' }}>
                                                                        {{ $languageOption->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Proficiency</label>
                                                            <select name="languages[{{ $index }}][proficiency]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <option value="">Select proficiency</option>
                                                                <option value="beginner" {{ $userLanguage->proficiency == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                                <option value="intermediate" {{ $userLanguage->proficiency == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                                <option value="advanced" {{ $userLanguage->proficiency == 'advanced' ? 'selected' : '' }}>Advanced</option>
                                                                <option value="native" {{ $userLanguage->proficiency == 'native' ? 'selected' : '' }}>Native</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4 flex justify-end">
                                                        <button type="button" onclick="removeLanguage(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Language</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    
                                    <button type="button" onclick="addLanguage()" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition text-sm">
                                        Add Language
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('worker.profile') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let skillIndex = {{ old('skills') ? count(old('skills')) : $user->userSkills->count() }};
        let languageIndex = {{ old('languages') ? count(old('languages')) : $user->userLanguages->count() }};

        function addSkill() {
            const container = document.getElementById('skills-container');
            const skillItem = document.createElement('div');
            skillItem.className = 'skill-item border border-gray-200 rounded-lg p-4 mb-4';
            skillItem.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Skill</label>
                        <select name="skills[${skillIndex}][skill_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a skill</option>
                            @foreach($skillCategories as $category)
                                <optgroup label="{{ $category->name }}">
                                    @foreach($category->skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Experience Level</label>
                        <select name="skills[${skillIndex}][experience_tier]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select experience</option>
                            <option value="<6 months">Less than 6 months</option>
                            <option value="6-12 months">6-12 months</option>
                            <option value="1-2 years">1-2 years</option>
                            <option value="2-5 years">2-5 years</option>
                            <option value=">5 years">More than 5 years</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="removeSkill(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Skill</button>
                </div>
            `;
            container.appendChild(skillItem);
            skillIndex++;
        }

        function removeSkill(button) {
            button.closest('.skill-item').remove();
        }

        function addLanguage() {
            const container = document.getElementById('languages-container');
            const languageItem = document.createElement('div');
            languageItem.className = 'language-item border border-gray-200 rounded-lg p-4 mb-4';
            languageItem.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Language</label>
                        <select name="languages[${languageIndex}][language_id]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a language</option>
                            @foreach($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Proficiency</label>
                        <select name="languages[${languageIndex}][proficiency]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select proficiency</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                            <option value="native">Native</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="removeLanguage(this)" class="text-red-600 hover:text-red-800 text-sm">Remove Language</button>
                </div>
            `;
            container.appendChild(languageItem);
            languageIndex++;
        }

        function removeLanguage(button) {
            button.closest('.language-item').remove();
        }

        // Form submission with SweetAlert
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            Swal.fire({
                title: 'Updating Profile...',
                text: 'Please wait while we update your profile.',
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

