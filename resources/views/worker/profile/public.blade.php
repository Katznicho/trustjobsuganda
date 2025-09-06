<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Public Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Your Public Profile</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('worker.cv.download') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Download CV
                            </a>
                            <a href="{{ route('worker.profile.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Edit Profile
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Profile Information -->
                        <div class="lg:col-span-2">
                            <!-- Personal Information -->
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <div class="flex items-center mb-6">
                                    <div class="flex-shrink-0 h-20 w-20">
                                        <div class="h-20 w-20 rounded-full bg-indigo-300 flex items-center justify-center">
                                            <span class="text-2xl font-bold text-indigo-800">
                                                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-6">
                                        <h4 class="text-2xl font-bold text-gray-900">{{ $user->full_name }}</h4>
                                        <p class="text-gray-600">{{ $user->email }}</p>
                                        @if($user->phone)
                                            <p class="text-gray-600">{{ $user->phone }}</p>
                                        @endif
                                        @if($user->profile && $user->profile->location)
                                            <p class="text-gray-600">{{ $user->profile->location }}</p>
                                        @endif
                                    </div>
                                </div>

                                @if($user->profile && $user->profile->bio)
                                <div class="mb-4">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-2">About Me</h5>
                                    <p class="text-gray-700 leading-relaxed">{{ $user->profile->bio }}</p>
                                </div>
                                @endif

                                @if($user->profile && $user->profile->availability)
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-600 mr-2">Availability:</span>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($user->profile->availability === 'available') bg-green-100 text-green-800
                                        @elseif($user->profile->availability === 'busy') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($user->profile->availability) }}
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Skills -->
                            @if($user->userSkills && $user->userSkills->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Skills & Experience</h4>
                                <div class="space-y-4">
                                    @foreach($user->userSkills as $userSkill)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h5 class="font-medium text-gray-900">{{ $userSkill->skill->name }}</h5>
                                                <p class="text-sm text-gray-600">{{ $userSkill->experience_tier }}</p>
                                                @if($userSkill->years_estimate)
                                                    <p class="text-sm text-gray-500">{{ $userSkill->years_estimate }} years experience</p>
                                                @endif
                                            </div>
                                            @if($userSkill->has_certificate)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Certified
                                            </span>
                                            @endif
                                        </div>
                                        @if($userSkill->certificate_name && $userSkill->institution_name)
                                        <div class="mt-2 text-sm text-gray-600">
                                            <p><strong>Certificate:</strong> {{ $userSkill->certificate_name }}</p>
                                            <p><strong>Institution:</strong> {{ $userSkill->institution_name }}</p>
                                            @if($userSkill->issue_date)
                                                <p><strong>Issued:</strong> {{ \Carbon\Carbon::parse($userSkill->issue_date)->format('M Y') }}</p>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Languages -->
                            @if($user->userLanguages && $user->userLanguages->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Languages</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($user->userLanguages as $userLanguage)
                                    <div class="flex justify-between items-center p-3 bg-white rounded-lg border">
                                        <span class="font-medium text-gray-900">{{ $userLanguage->language->name }}</span>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($userLanguage->proficiency === 'native') bg-blue-100 text-blue-800
                                            @elseif($userLanguage->proficiency === 'advanced') bg-green-100 text-green-800
                                            @elseif($userLanguage->proficiency === 'intermediate') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($userLanguage->proficiency) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Education -->
                            @if($user->educationRecords && $user->educationRecords->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Education</h4>
                                <div class="space-y-4">
                                    @foreach($user->educationRecords as $education)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-medium text-gray-900">{{ $education->institution_name }}</h5>
                                        <p class="text-sm text-gray-600">{{ $education->degree }} in {{ $education->field_of_study }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - 
                                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }}
                                        </p>
                                        @if($education->description)
                                            <p class="text-sm text-gray-600 mt-2">{{ $education->description }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- References -->
                            @if($user->references && $user->references->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">References</h4>
                                <div class="space-y-4">
                                    @foreach($user->references as $reference)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <h5 class="font-medium text-gray-900">{{ $reference->name }}</h5>
                                        <p class="text-sm text-gray-600">{{ $reference->position }} at {{ $reference->company }}</p>
                                        <p class="text-sm text-gray-500">{{ $reference->phone }}</p>
                                        @if($reference->email)
                                            <p class="text-sm text-gray-500">{{ $reference->email }}</p>
                                        @endif
                                        @if($reference->relationship)
                                            <p class="text-sm text-gray-600 mt-2"><strong>Relationship:</strong> {{ $reference->relationship }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Quick Stats -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Applications:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $user->applications->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Skills:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $user->userSkills->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Languages:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $user->userLanguages->count() }}</span>
                                    </div>
                                    @if($user->ratingsReceived->count() > 0)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Average Rating:</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ number_format($user->ratingsReceived->avg('stars'), 1) }}/5
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $user->email }}</span>
                                    </div>
                                    @if($user->phone)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $user->phone }}</span>
                                    </div>
                                    @endif
                                    @if($user->profile && $user->profile->location)
                                    <div class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $user->profile->location }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Profile Completion -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Profile Completion</h4>
                                @php
                                    $completion = 0;
                                    $total = 6;
                                    
                                    if ($user->profile && $user->profile->bio) $completion++;
                                    if ($user->profile && $user->profile->location) $completion++;
                                    if ($user->userSkills->count() > 0) $completion++;
                                    if ($user->userLanguages->count() > 0) $completion++;
                                    if ($user->educationRecords->count() > 0) $completion++;
                                    if ($user->references->count() > 0) $completion++;
                                    
                                    $percentage = ($completion / $total) * 100;
                                @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Completion</span>
                                        <span class="font-medium text-gray-900">{{ round($percentage) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <p class="text-xs text-gray-500">Complete your profile to get more job opportunities</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

