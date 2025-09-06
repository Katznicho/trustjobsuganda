<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-16 w-16">
                                <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-xl font-medium text-gray-700">
                                        {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $user->full_name }}</h3>
                                <p class="text-sm text-gray-600">{{ ucfirst($user->role) }} User</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Edit User
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Back to Users
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- User Information -->
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">First Name</label>
                                        <p class="text-sm text-gray-900">{{ $user->first_name }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Last Name</label>
                                        <p class="text-sm text-gray-900">{{ $user->last_name }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Email</label>
                                        <p class="text-sm text-gray-900">{{ $user->email }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Phone</label>
                                        <p class="text-sm text-gray-900">{{ $user->phone_e164 }}</p>
                                    </div>
                                </div>
                            </div>

                            @if($user->role === 'worker' && $user->profile)
                            <div class="mt-6 bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Worker Profile</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if($user->profile->bio)
                                    <div class="md:col-span-2">
                                        <label class="text-sm font-medium text-gray-600">Bio</label>
                                        <p class="text-sm text-gray-900">{{ $user->profile->bio }}</p>
                                    </div>
                                    @endif
                                    @if($user->profile->location)
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Location</label>
                                        <p class="text-sm text-gray-900">{{ $user->profile->location }}</p>
                                    </div>
                                    @endif
                                    @if($user->profile->availability)
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Availability</label>
                                        <p class="text-sm text-gray-900">{{ $user->profile->availability }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if($user->role === 'employer')
                            <div class="mt-6 bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Employer Information</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if($user->profile && $user->profile->company_name)
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Company</label>
                                        <p class="text-sm text-gray-900">{{ $user->profile->company_name }}</p>
                                    </div>
                                    @endif
                                    @if($user->profile && $user->profile->location)
                                    <div>
                                        <label class="text-sm font-medium text-gray-600">Location</label>
                                        <p class="text-sm text-gray-900">{{ $user->profile->location }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- User Details Sidebar -->
                        <div class="space-y-6">
                            <!-- Status Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Account Status</h4>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                            @if($user->role === 'admin') bg-red-100 text-red-800
                                            @elseif($user->role === 'employer') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Account Timeline</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Joined:</span>
                                        <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Last Login:</span>
                                        <span class="text-sm text-gray-900">{{ $user->updated_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Email Verified:</span>
                                        <span class="text-sm text-gray-900">
                                            @if($user->email_verified_at)
                                                {{ $user->email_verified_at->format('M d, Y') }}
                                            @else
                                                Not verified
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistics Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Statistics</h4>
                                <div class="space-y-2">
                                    @if($user->role === 'worker')
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Applications:</span>
                                            <span class="text-sm text-gray-900">{{ $user->applications->count() }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Skills:</span>
                                            <span class="text-sm text-gray-900">{{ $user->userSkills->count() }}</span>
                                        </div>
                                    @elseif($user->role === 'employer')
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Jobs Posted:</span>
                                            <span class="text-sm text-gray-900">{{ $user->jobListings->count() }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Total Applications:</span>
                                            <span class="text-sm text-gray-900">{{ $user->jobListings->sum(function($job) { return $job->applications->count(); }) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skills Section (for workers) -->
                    @if($user->role === 'worker' && $user->userSkills->count() > 0)
                    <div class="mt-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Skills ({{ $user->userSkills->count() }})</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($user->userSkills as $userSkill)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <h5 class="font-medium text-gray-900">{{ $userSkill->skill->name }}</h5>
                                    <p class="text-sm text-gray-600">{{ $userSkill->experience_tier }}</p>
                                    @if($userSkill->has_certificate)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 mt-2">
                                            Certified
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Job Listings Section (for employers) -->
                    @if($user->role === 'employer' && $user->jobListings->count() > 0)
                    <div class="mt-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Listings ({{ $user->jobListings->count() }})</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job Title</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Budget</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posted</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($user->jobListings as $job)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $job->title }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($job->description, 50) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                UGX {{ number_format($job->budget) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($job->status === 'open') bg-green-100 text-green-800
                                                    @elseif($job->status === 'in_progress') bg-yellow-100 text-yellow-800
                                                    @elseif($job->status === 'completed') bg-blue-100 text-blue-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $job->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.jobs.show', $job) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
