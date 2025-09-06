<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button onclick="confirmDeleteAccount()">
        {{ __('Delete Account') }}
    </x-danger-button>

    <form id="delete-account-form" method="post" action="{{ route('profile.destroy') }}" class="hidden">
        @csrf
        @method('delete')
        <input type="password" name="password" id="delete-password" required>
    </form>

    <script>
        function confirmDeleteAccount() {
            Swal.fire({
                title: 'Are you sure you want to delete your account?',
                text: 'Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone!',
                icon: 'warning',
                input: 'password',
                inputPlaceholder: 'Enter your password to confirm',
                inputAttributes: {
                    required: true
                },
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete my account!',
                cancelButtonText: 'Cancel',
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('Password is required');
                        return false;
                    }
                    return password;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Set the password in the form and submit
                    document.getElementById('delete-password').value = result.value;
                    document.getElementById('delete-account-form').submit();
                }
            });
        }

        // Show validation errors if any
        @if($errors->userDeletion->any())
            Swal.fire({
                title: 'Validation Error!',
                text: '{{ $errors->userDeletion->first() }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</section>
