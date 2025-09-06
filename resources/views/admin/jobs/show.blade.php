<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $job->title }}</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Edit Job
                            </a>
                            <a href="{{ route('admin.jobs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Back to Jobs
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Job Information -->
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Description</h4>
                                <p class="text-gray-700 leading-relaxed">{{ $job->description }}</p>
                            </div>

                            <div class="mt-6 bg-gray-50 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Requirements</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-600 w-32">Skills Required:</span>
                                        <span class="text-sm text-gray-900">{{ $job->required_skills ?? 'Not specified' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-600 w-32">Experience:</span>
                                        <span class="text-sm text-gray-900">{{ $job->experience_level ?? 'Not specified' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-600 w-32">Duration:</span>
                                        <span class="text-sm text-gray-900">{{ $job->duration ?? 'Not specified' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Details Sidebar -->
                        <div class="space-y-6">
                            <!-- Status Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Job Status</h4>
                                <div class="flex items-center">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                        @if($job->status === 'open') bg-green-100 text-green-800
                                        @elseif($job->status === 'in_progress') bg-yellow-100 text-yellow-800
                                        @elseif($job->status === 'completed') bg-blue-100 text-blue-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $job->status)) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Budget Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Budget</h4>
                                <div class="space-y-2">
                                    <div class="text-2xl font-bold text-gray-900">
                                        UGX {{ number_format($job->budget) }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ ucfirst($job->pay_type) }} Payment
                                    </div>
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Location</h4>
                                <div class="space-y-2">
                                    <div class="text-sm text-gray-900">{{ $job->district }}</div>
                                    @if($job->specific_location)
                                        <div class="text-sm text-gray-600">{{ $job->specific_location }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Employer Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Employer</h4>
                                <div class="space-y-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $job->employer->full_name }}</div>
                                    <div class="text-sm text-gray-600">{{ $job->employer->email }}</div>
                                    @if($job->employer->phone_e164)
                                        <div class="text-sm text-gray-600">{{ $job->employer->phone_e164 }}</div>
                                    @endif
                                </div>
                            </div>

                            <!-- Timeline Card -->
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Timeline</h4>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Posted:</span>
                                        <span class="text-sm text-gray-900">{{ $job->created_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($job->deadline)
                                        <div class="flex justify-between">
                                            <span class="text-sm text-gray-600">Deadline:</span>
                                            <span class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Last Updated:</span>
                                        <span class="text-sm text-gray-900">{{ $job->updated_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Applications Section -->
                    @if($job->applications && $job->applications->count() > 0)
                    <div class="mt-8">
                        <div class="bg-white border border-gray-200 rounded-lg p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Applications ({{ $job->applications->count() }})</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worker</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($job->applications as $application)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $application->worker->full_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $application->worker->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $application->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($application->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($application->status === 'accepted') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">View Details</a>
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

