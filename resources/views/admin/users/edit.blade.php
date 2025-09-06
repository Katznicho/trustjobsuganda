<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Edit User: {{ $user->full_name }}</h3>
                        <a href="{{ route('admin.users.show', $user) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Back to User
                        </a>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" id="editUserForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Personal Information -->
                            <div class="space-y-6">
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h4>
                                    
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

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-300 @enderror">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="phone_e164" class="block text-sm font-medium text-gray-700">Phone</label>
                                            <input type="text" name="phone_e164" id="phone_e164" value="{{ old('phone_e164', $user->phone_e164) }}" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('phone_e164') border-red-300 @enderror">
                                            @error('phone_e164')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Role and Status -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Account Settings</h4>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                            <select name="role" id="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('role') border-red-300 @enderror">
                                                <option value="worker" {{ old('role', $user->role) === 'worker' ? 'selected' : '' }}>Worker</option>
                                                <option value="employer" {{ old('role', $user->role) === 'employer' ? 'selected' : '' }}>Employer</option>
                                                @if($user->role === 'admin')
                                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                                @endif
                                            </select>
                                            @error('role')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email_verified_at" class="block text-sm font-medium text-gray-700">Email Verification</label>
                                            <select name="email_verified_at" id="email_verified_at" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                <option value="1" {{ $user->email_verified_at ? 'selected' : '' }}>Verified</option>
                                                <option value="0" {{ !$user->email_verified_at ? 'selected' : '' }}>Not Verified</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Information -->
                            <div class="space-y-6">
                                @if($user->profile)
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Profile Information</h4>
                                    
                                    <div class="space-y-4">
                                        @if($user->role === 'worker')
                                            <div>
                                                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                                <textarea name="bio" id="bio" rows="3" 
                                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('bio') border-red-300 @enderror">{{ old('bio', $user->profile->bio) }}</textarea>
                                                @error('bio')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                                <input type="text" name="location" id="location" value="{{ old('location', $user->profile->location) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('location') border-red-300 @enderror">
                                                @error('location')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="availability" class="block text-sm font-medium text-gray-700">Availability</label>
                                                <select name="availability" id="availability" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option value="available" {{ old('availability', $user->profile->availability) === 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="busy" {{ old('availability', $user->profile->availability) === 'busy' ? 'selected' : '' }}>Busy</option>
                                                    <option value="unavailable" {{ old('availability', $user->profile->availability) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                </select>
                                            </div>
                                        @elseif($user->role === 'employer')
                                            <div>
                                                <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
                                                <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->profile->company_name) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('company_name') border-red-300 @enderror">
                                                @error('company_name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                                <input type="text" name="location" id="location" value="{{ old('location', $user->profile->location) }}" 
                                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('location') border-red-300 @enderror">
                                                @error('location')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- Password Reset -->
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Password Reset</h4>
                                    
                                    <div class="space-y-4">
                                        <div>
                                            <label for="new_password" class="block text-sm font-medium text-gray-700">New Password (optional)</label>
                                            <input type="password" name="new_password" id="new_password" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('new_password') border-red-300 @enderror">
                                            @error('new_password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('new_password_confirmation') border-red-300 @enderror">
                                            @error('new_password_confirmation')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('admin.users.show', $user) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editUserForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Updating User...',
                text: 'Please wait while we update the user information.',
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

