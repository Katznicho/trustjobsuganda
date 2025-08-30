<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">All Job Listings</h3>
                        <div class="flex space-x-2">
                            <select id="statusFilter" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                                <option value="">All Status</option>
                                <option value="open">Open</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Job
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Employer
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Budget
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Posted
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jobs as $job)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $job->title }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ Str::limit($job->description, 50) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $job->employer->full_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $job->employer->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            UGX {{ number_format($job->budget) }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ ucfirst($job->pay_type) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $job->district }}
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
                                        <div class="flex space-x-2">
                                            <button class="text-indigo-600 hover:text-indigo-900">View</button>
                                            <button class="text-yellow-600 hover:text-yellow-900">Edit</button>
                                            <button class="text-red-600 hover:text-red-900">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($jobs->hasPages())
                    <div class="mt-6">
                        {{ $jobs->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('statusFilter').addEventListener('change', function() {
            const status = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(5) span');
                if (status === '' || statusCell.textContent.toLowerCase().includes(status)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>

