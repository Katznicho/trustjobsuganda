<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Skills Categories Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Skill Categories</h3>
                        <a href="{{ route('admin.skill-categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Add Category
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($skillCategories as $category)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="font-medium text-gray-900">{{ $category->name }}</h4>
                                                            <div class="flex space-x-1">
                                <a href="{{ route('admin.skill-categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">Edit</a>
                                <button onclick="confirmDeleteCategory({{ $category->id }}, '{{ $category->name }}')" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                <form id="delete-category-form-{{ $category->id }}" action="{{ route('admin.skill-categories.destroy', $category) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            </div>
                            <p class="text-sm text-gray-600 mb-3">{{ $category->description ?? 'No description' }}</p>
                            <div class="text-xs text-gray-500">
                                {{ $category->skills->count() }} skills in this category
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">All Skills</h3>
                        <div class="flex space-x-2">
                            <select id="categoryFilter" class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                                <option value="">All Categories</option>
                                @foreach($skillCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('admin.skills.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                                Add Skill
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Skill Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Workers with Skill
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($skills as $skill)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $skill->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $skill->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ Str::limit($skill->description, 60) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $skill->userSkills->count() }} workers
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.skills.edit', $skill) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            <button onclick="confirmDeleteSkill({{ $skill->id }}, '{{ $skill->name }}')" class="text-red-600 hover:text-red-900">Delete</button>
                                            <form id="delete-skill-form-{{ $skill->id }}" action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($skills->hasPages())
                    <div class="mt-6">
                        {{ $skills->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Category filter functionality
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const categoryId = this.value;
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const categoryCell = row.querySelector('td:nth-child(2) span');
                if (categoryId === '' || categoryCell.textContent.trim() === this.options[this.selectedIndex].text) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // SweetAlert confirmation for deleting skills
        function confirmDeleteSkill(skillId, skillName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to delete the skill "${skillName}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-skill-form-${skillId}`).submit();
                }
            });
        }

        // SweetAlert confirmation for deleting skill categories
        function confirmDeleteCategory(categoryId, categoryName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to delete the category "${categoryName}"? This will also delete all skills in this category.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-category-form-${categoryId}`).submit();
                }
            });
        }

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>

