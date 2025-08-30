<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post New Job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('employer.jobs.store') }}" class="space-y-6">
                        @csrf

                        <!-- Job Title -->
                        <div>
                            <x-input-label for="title" :value="__('Job Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Job Description -->
                        <div>
                            <x-input-label for="description" :value="__('Job Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Required Skills -->
                        <div>
                            <x-input-label for="required_skills" :value="__('Required Skills')" />
                            <select id="required_skills" name="required_skill_ids[]" multiple class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->name }} ({{ $skill->category->name }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('required_skill_ids')" class="mt-2" />
                        </div>

                        <!-- Minimum Experience -->
                        <div>
                            <x-input-label for="min_experience_tier" :value="__('Minimum Experience Required')" />
                            <select id="min_experience_tier" name="min_experience_tier" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select Experience Level</option>
                                <option value="<6 months" {{ old('min_experience_tier') == '<6 months' ? 'selected' : '' }}>Less than 6 months</option>
                                <option value="6-12 months" {{ old('min_experience_tier') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                                <option value="1-2 years" {{ old('min_experience_tier') == '1-2 years' ? 'selected' : '' }}>1-2 years</option>
                                <option value="2-5 years" {{ old('min_experience_tier') == '2-5 years' ? 'selected' : '' }}>2-5 years</option>
                                <option value=">5 years" {{ old('min_experience_tier') == '>5 years' ? 'selected' : '' }}>More than 5 years</option>
                            </select>
                            <x-input-error :messages="$errors->get('min_experience_tier')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="district" :value="__('District')" />
                                <x-text-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required />
                                <x-input-error :messages="$errors->get('district')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="division" :value="__('Division/Subcounty')" />
                                <x-text-input id="division" class="block mt-1 w-full" type="text" name="division" :value="old('division')" />
                                <x-input-error :messages="$errors->get('division')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="parish" :value="__('Parish/Ward')" />
                                <x-text-input id="parish" class="block mt-1 w-full" type="text" name="parish" :value="old('parish')" />
                                <x-input-error :messages="$errors->get('parish')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="village" :value="__('Village/LC1')" />
                                <x-text-input id="village" class="block mt-1 w-full" type="text" name="village" :value="old('village')" />
                                <x-input-error :messages="$errors->get('village')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Budget and Pay Type -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="budget" :value="__('Budget (UGX)')" />
                                <x-text-input id="budget" class="block mt-1 w-full" type="number" name="budget" :value="old('budget')" required min="0" step="0.01" />
                                <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="pay_type" :value="__('Pay Type')" />
                                <select id="pay_type" name="pay_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Pay Type</option>
                                    <option value="daily" {{ old('pay_type') == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="hourly" {{ old('pay_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                    <option value="fixed" {{ old('pay_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                </select>
                                <x-input-error :messages="$errors->get('pay_type')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Urgent Job -->
                        <div class="flex items-center">
                            <input id="urgent" type="checkbox" name="urgent" value="1" {{ old('urgent') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            <label for="urgent" class="ml-2 text-sm text-gray-600">
                                {{ __('Mark as Urgent Job') }}
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('employer.jobs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition mr-2">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Post Job') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

