<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Skill Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.skill-categories.update', $skillCategory) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $skillCategory->name) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon (Emoji)</label>
                            <input type="text" name="icon" id="icon" value="{{ old('icon', $skillCategory->icon) }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="🔧">
                            <p class="text-sm text-gray-500 mt-1">Enter an emoji or icon character (e.g., 🔧, 🏗️, 🎨)</p>
                            @error('icon')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $skillCategory->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.skills.index') }}" 
                               class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Updating...';
            submitBtn.disabled = true;
            
            // Show loading state
            Swal.fire({
                title: 'Updating Category...',
                text: 'Please wait while we update your category.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Show error messages if any
        @if($errors->any())
            Swal.fire({
                title: 'Validation Error!',
                html: `
                    <ul class="text-left">
                        @foreach($errors->all() as $error)
                            <li class="text-red-600">• {{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-app-layout>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
