<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('profile.public', $user) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition" target="_blank">
                                View Public Profile
                            </a>
                            <a href="{{ route('worker.cv.download') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Download CV
                            </a>
                            <a href="{{ route('worker.profile.edit') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h4 class="text-md font-semibold text-gray-900 mb-4">Personal Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->full_name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->phone_e164 }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $user->profile->district ?? 'Not specified' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-md font-semibold text-gray-900">Skills & Experience</h4>
                            <button class="text-blue-600 hover:text-blue-900 text-sm">Add Skill</button>
                        </div>
                        
                        @if($user->userSkills->count() > 0)
                            <div class="space-y-4">
                                @foreach($user->userSkills as $userSkill)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h5 class="font-medium text-gray-900">{{ $userSkill->skill->name }}</h5>
                                            <p class="text-sm text-gray-600">{{ $userSkill->skill->category->name }}</p>
                                            <div class="mt-2 flex items-center space-x-4">
                                                <span class="text-sm text-gray-500">Experience: {{ $userSkill->experience_tier }}</span>
                                                @if($userSkill->has_certificate)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Certified
                                                </span>
                                                @endif
                                            </div>
                                            @if($userSkill->has_certificate)
                                            <div class="mt-2 text-sm text-gray-600">
                                                <p><strong>Institution:</strong> {{ $userSkill->institution_name }}</p>
                                                <p><strong>Certificate:</strong> {{ $userSkill->certificate_name }}</p>
                                                @if($userSkill->issue_date)
                                                <p><strong>Issue Date:</strong> {{ $userSkill->issue_date }}</p>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</button>
                                            <button class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No skills added</h3>
                                <p class="mt-1 text-sm text-gray-500">Add your skills to get matched with relevant jobs.</p>
                                <div class="mt-6">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                        Add Your First Skill
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Education Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-md font-semibold text-gray-900">Education</h4>
                            <button class="text-blue-600 hover:text-blue-900 text-sm">Add Education</button>
                        </div>
                        
                        @if($user->educationRecords->count() > 0)
                            <div class="space-y-4">
                                @foreach($user->educationRecords as $education)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h5 class="font-medium text-gray-900">{{ $education->level }}</h5>
                                            @if($education->institution)
                                            <p class="text-sm text-gray-600">{{ $education->institution }}</p>
                                            @endif
                                            @if($education->field_of_study)
                                            <p class="text-sm text-gray-600">{{ $education->field_of_study }}</p>
                                            @endif
                                            @if($education->year_completed)
                                            <p class="text-sm text-gray-500">Completed: {{ $education->year_completed }}</p>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</button>
                                            <button class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 border-2 border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No education records</h3>
                                <p class="mt-1 text-sm text-gray-500">Add your education background.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Languages Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-md font-semibold text-gray-900">Languages</h4>
                            <button class="text-blue-600 hover:text-blue-900 text-sm">Add Language</button>
                        </div>
                        
                        @if($user->userLanguages->count() > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($user->userLanguages as $userLanguage)
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    {{ $userLanguage->language->name }}
                                    <span class="ml-2 text-xs text-blue-600">({{ $userLanguage->proficiency }})</span>
                                    <button class="ml-2 text-blue-600 hover:text-blue-900">×</button>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 border-2 border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No languages added</h3>
                                <p class="mt-1 text-sm text-gray-500">Add the languages you speak.</p>
                            </div>
                        @endif
                    </div>

                    <!-- References Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-md font-semibold text-gray-900">References</h4>
                            <button class="text-blue-600 hover:text-blue-900 text-sm">Add Reference</button>
                        </div>
                        
                        @if($user->references->count() > 0)
                            <div class="space-y-4">
                                @foreach($user->references as $reference)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h5 class="font-medium text-gray-900">{{ $reference->name }}</h5>
                                            <p class="text-sm text-gray-600">{{ $reference->relationship }}</p>
                                            <p class="text-sm text-gray-600">{{ $reference->phone }}</p>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $reference->can_contact ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $reference->can_contact ? 'Can Contact' : 'Do Not Contact' }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</button>
                                            <button class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6 border-2 border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No references added</h3>
                                <p class="mt-1 text-sm text-gray-500">Add references to build trust with employers.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Profile Completion -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="text-md font-semibold text-blue-900 mb-2">Profile Completion</h4>
                        <div class="w-full bg-blue-200 rounded-full h-2 mb-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="text-sm text-blue-700">Your profile is 65% complete. Add more information to increase your chances of getting hired.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



