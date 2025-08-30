<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Search Jobs</h3>
                    <form method="GET" action="{{ route('worker.jobs.search') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                            <input type="text" id="district" name="district" value="{{ request('district') }}" placeholder="Enter district" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="pay_type" class="block text-sm font-medium text-gray-700 mb-1">Pay Type</label>
                            <select id="pay_type" name="pay_type" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Types</option>
                                <option value="daily" {{ request('pay_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="hourly" {{ request('pay_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                <option value="fixed" {{ request('pay_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
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
                            @if(request()->hasAny(['skill_id', 'district', 'pay_type']))
                                Search Results ({{ $jobs->total() }} jobs found)
                            @else
                                All Available Jobs
                            @endif
                        </h3>
                        <a href="{{ route('worker.jobs.index') }}" class="text-blue-600 hover:text-blue-900 text-sm">View All Jobs</a>
                    </div>

                    @if($jobs->count() > 0)
                        <div class="space-y-6">
                            @foreach($jobs as $job)
                            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="text-xl font-semibold text-gray-900">{{ $job->title }}</h4>
                                        <p class="text-gray-600">{{ $job->employer->full_name }}</p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @if($job->urgent)
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Urgent
                                        </span>
                                        @endif
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-700 mb-4">{{ Str::limit($job->description, 200) }}</p>
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <span class="text-sm text-gray-500">Budget:</span>
                                        <p class="font-medium">UGX {{ number_format($job->budget) }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Pay Type:</span>
                                        <p class="font-medium">{{ ucfirst($job->pay_type) }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Location:</span>
                                        <p class="font-medium">{{ $job->district }}</p>
                                    </div>
                                    <div>
                                        <span class="text-sm text-gray-500">Experience:</span>
                                        <p class="font-medium">{{ $job->min_experience_tier }}</p>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <span class="text-sm text-gray-500">Required Skills:</span>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @if(is_array($job->required_skill_ids))
                                            @foreach($job->required_skill_ids as $skillId)
                                                @php
                                                    $skill = $skills->firstWhere('id', $skillId);
                                                @endphp
                                                @if($skill)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ $skill->name }}
                                                </span>
                                                @endif
                                            @endforeach
                                        @else
                                            <span class="text-sm text-gray-500">Skills not specified</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</span>
                                    <div class="flex space-x-2">
                                        <button class="text-indigo-600 hover:text-indigo-900 text-sm">View Details</button>
                                        <button class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition text-sm">
                                            Apply Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @if($jobs->hasPages())
                        <div class="mt-6">
                            {{ $jobs->links() }}
                        </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs found</h3>
                            <p class="text-gray-500 mb-6">Try adjusting your search criteria to find more jobs.</p>
                            <a href="{{ route('worker.jobs.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">
                                View All Jobs
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

