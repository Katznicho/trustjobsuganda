<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TrustJobs Uganda') }} - Register</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="text-center">
                    <div class="mb-4">
                        <a href="/" class="text-3xl font-bold text-blue-600">TrustJobs</a>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Join TrustJobs Uganda</h2>
                    <p class="mt-2 text-gray-600">Create your account and start your professional journey</p>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign in here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Progress Bar -->
                <div class="bg-gray-50 px-8 py-6 border-b">
                    <div class="flex items-center justify-center">
                        <div class="flex items-center space-x-8">
                            <div class="step-indicator active" data-step="1">
                                <div class="step-number">1</div>
                                <div class="step-label">Account</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-indicator" data-step="2">
                                <div class="step-number">2</div>
                                <div class="step-label">Location</div>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-indicator" data-step="3">
                                <div class="step-number">3</div>
                                <div class="step-label">Profile</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form method="POST" action="{{ route('register') }}" id="registrationForm">
                        @csrf

                        <!-- Step 1: Account Information -->
                        <div class="step-content" id="step1">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Create Your Account</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        First Name <span class="text-red-500">*</span>
                                    </label>
                                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Enter your first name" required>
                                    @error('first_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Last Name <span class="text-red-500">*</span>
                                    </label>
                                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Enter your last name" required>
                                    @error('last_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="Enter your email address" required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <label for="phone_e164" class="block text-sm font-medium text-gray-700 mb-2">
                                    WhatsApp Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input id="phone_e164" type="tel" name="phone_e164" value="{{ old('phone_e164') }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="+2567XXXXXXXX" required>
                                <p class="text-sm text-gray-500 mt-1">Format: +2567XXXXXXXX (Uganda number)</p>
                                @error('phone_e164')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                    I want to register as <span class="text-red-500">*</span>
                                </label>
                                <select id="role" name="role" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                    <option value="">Select your role</option>
                                    <option value="worker" {{ old('role') == 'worker' ? 'selected' : '' }}>Worker/Job Seeker</option>
                                    <option value="employer" {{ old('role') == 'employer' ? 'selected' : '' }}>Employer</option>
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <input id="password" type="password" name="password" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Create a strong password" required>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm Password <span class="text-red-500">*</span>
                                    </label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Confirm your password" required>
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end mt-8">
                                <button type="button" onclick="nextStep()" 
                                        class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700 transition font-medium">
                                    Next: Location
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Location Information -->
                        <div class="step-content hidden" id="step2">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Location Information</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                                        District <span class="text-red-500">*</span>
                                    </label>
                                    <input id="district" type="text" name="district" value="{{ old('district') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., Kampala, Wakiso, Mukono" required>
                                    @error('district')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="division" class="block text-sm font-medium text-gray-700 mb-2">
                                        Division/Subcounty
                                    </label>
                                    <input id="division" type="text" name="division" value="{{ old('division') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., Central Division, Kira Division">
                                    @error('division')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="parish" class="block text-sm font-medium text-gray-700 mb-2">
                                        Parish/Ward
                                    </label>
                                    <input id="parish" type="text" name="parish" value="{{ old('parish') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., Nakasero Parish, Kololo Ward">
                                    @error('parish')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="village" class="block text-sm font-medium text-gray-700 mb-2">
                                        Village/LC1
                                    </label>
                                    <input id="village" type="text" name="village" value="{{ old('village') }}" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="e.g., Kireka Village, Ntinda LC1">
                                    @error('village')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-8">
                                <button type="button" onclick="prevStep()" 
                                        class="bg-gray-300 text-gray-700 px-8 py-3 rounded-md hover:bg-gray-400 transition font-medium">
                                    Previous
                                </button>
                                <button type="button" onclick="nextStep()" 
                                        class="bg-blue-600 text-white px-8 py-3 rounded-md hover:bg-blue-700 transition font-medium">
                                    Next: Profile
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Profile Information -->
                        <div class="step-content hidden" id="step3">
                            <h3 class="text-2xl font-semibold text-gray-900 mb-6">Complete Your Profile</h3>
                            
                            <!-- Skills Section (for Workers) -->
                            <div id="skillsSection" class="mb-8 hidden">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Skills & Experience</h4>
                                    <p class="text-sm text-gray-600">Add your skills to get matched with relevant jobs</p>
                                </div>
                                
                                @error('skills')
                                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-md">
                                        <p class="text-red-600 text-sm">{{ $message }}</p>
                                    </div>
                                @enderror
                                
                                <div id="skillsContainer">
                                    <!-- Skills will be added here dynamically -->
                                </div>
                                
                                <button type="button" id="addSkillBtn" 
                                        class="mt-4 bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition text-sm">
                                    + Add Skill
                                </button>
                            </div>

                            <!-- Education Section -->
                            <div class="mb-8">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Education Background</h4>
                                    <p class="text-sm text-gray-600">Tell us about your education</p>
                                </div>
                                
                                <div id="educationContainer">
                                    <div class="education-entry border rounded-lg p-4 mb-4 bg-gray-50">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Education Level</label>
                                                <select name="education[0][level]" 
                                                        class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option value="">Select Level</option>
                                                    <option value="None">None</option>
                                                    <option value="Primary">Primary</option>
                                                    <option value="O-Level">O-Level</option>
                                                    <option value="A-Level">A-Level</option>
                                                    <option value="Certificate">Certificate</option>
                                                    <option value="Diploma">Diploma</option>
                                                    <option value="Degree">Degree</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Institution</label>
                                                <input type="text" name="education[0][institution]" 
                                                       placeholder="e.g., Makerere University, YMCA" 
                                                       class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Field of Study</label>
                                                <input type="text" name="education[0][field_of_study]" 
                                                       placeholder="e.g., Computer Science, Business Administration" 
                                                       class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Year Completed</label>
                                                <input type="number" name="education[0][year_completed]" 
                                                       min="1950" max="{{ date('Y') + 1 }}" 
                                                       class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" id="addEducationBtn" 
                                        class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm">
                                    + Add Education
                                </button>
                            </div>

                            <!-- Languages Section -->
                            <div class="mb-8">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Languages</h4>
                                    <p class="text-sm text-gray-600">Add languages you speak</p>
                                </div>
                                
                                <div id="languagesContainer">
                                    <!-- Languages will be added here dynamically -->
                                </div>
                                
                                <button type="button" id="addLanguageBtn" 
                                        class="mt-4 bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition text-sm">
                                    + Add Language
                                </button>
                            </div>

                            <!-- References Section -->
                            <div class="mb-8">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">References</h4>
                                    <p class="text-sm text-gray-600">Add up to 3 references (optional)</p>
                                </div>
                                
                                <div id="referencesContainer">
                                    <!-- References will be added here dynamically -->
                                </div>
                                
                                <button type="button" id="addReferenceBtn" 
                                        class="mt-4 bg-orange-600 text-white px-4 py-2 rounded-md hover:bg-orange-700 transition text-sm">
                                    + Add Reference
                                </button>
                            </div>

                            <div class="flex justify-between mt-8">
                                <button type="button" onclick="prevStep()" 
                                        class="bg-gray-300 text-gray-700 px-8 py-3 rounded-md hover:bg-gray-400 transition font-medium">
                                    Previous
                                </button>
                                <button type="submit" 
                                        class="bg-green-600 text-white px-8 py-3 rounded-md hover:bg-green-700 transition font-medium">
                                    Create Account
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }
        
        .step-indicator.active {
            opacity: 1;
        }
        
        .step-number {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }
        
        .step-indicator.active .step-number {
            background-color: #3b82f6;
            color: white;
        }
        
        .step-label {
            font-size: 16px;
            font-weight: 500;
            color: #6b7280;
        }
        
        .step-indicator.active .step-label {
            color: #3b82f6;
        }
        
        .step-line {
            width: 80px;
            height: 3px;
            background-color: #e5e7eb;
            margin: 0 24px;
        }
        
        .step-content {
            transition: all 0.3s ease;
        }
        
        .step-content.hidden {
            display: none !important;
        }
    </style>

    <script>
        let currentStep = 1;
        let skillIndex = 0;
        let educationIndex = 1;
        let languageIndex = 0;
        let referenceIndex = 0;

        // Initialize the form
        document.addEventListener('DOMContentLoaded', function() {
            showStep(1);
            initializeDynamicFields();
        });

        // Navigation functions
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Show current step
            const currentStepElement = document.getElementById(`step${step}`);
            if (currentStepElement) {
                currentStepElement.classList.remove('hidden');
            }
            
            // Update indicators
            document.querySelectorAll('.step-indicator').forEach(indicator => {
                indicator.classList.remove('active');
            });
            
            for (let i = 1; i <= step; i++) {
                const indicator = document.querySelector(`[data-step="${i}"]`);
                if (indicator) {
                    indicator.classList.add('active');
                }
            }
        }

        function nextStep() {
            if (validateCurrentStep()) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            currentStep--;
            showStep(currentStep);
        }

        function validateCurrentStep() {
            const currentStepElement = document.getElementById(`step${currentStep}`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            
            for (let field of requiredFields) {
                if (!field.value.trim()) {
                    field.focus();
                    Swal.fire({
                        title: 'Required Field Missing',
                        text: 'Please complete all required fields before proceeding.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
            }
            
            // Additional validation for specific steps
            if (currentStep === 1) {
                // Validate email format
                const email = document.getElementById('email').value;
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire({
                        title: 'Invalid Email',
                        text: 'Please enter a valid email address.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('email').focus();
                    return false;
                }
                
                // Validate phone format
                const phone = document.getElementById('phone_e164').value;
                const phoneRegex = /^\+2567\d{8}$/;
                if (!phoneRegex.test(phone)) {
                    Swal.fire({
                        title: 'Invalid Phone Number',
                        text: 'Please enter a valid Uganda phone number (e.g., +2567XXXXXXXX).',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('phone_e164').focus();
                    return false;
                }
                
                // Validate password match
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                if (password !== confirmPassword) {
                    Swal.fire({
                        title: 'Passwords Don\'t Match',
                        text: 'Please make sure your passwords match.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('password_confirmation').focus();
                    return false;
                }
                
                // Validate role selection
                const role = document.getElementById('role').value;
                if (!role) {
                    Swal.fire({
                        title: 'Role Required',
                        text: 'Please select your role (Worker or Employer).',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('role').focus();
                    return false;
                }
            }
            
            if (currentStep === 2) {
                // Validate district is filled
                const district = document.getElementById('district').value;
                if (!district.trim()) {
                    Swal.fire({
                        title: 'District Required',
                        text: 'Please enter your district.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    document.getElementById('district').focus();
                    return false;
                }
            }
            
            return true;
        }

        function initializeDynamicFields() {
            // Show/hide skills section based on role
            document.getElementById('role').addEventListener('change', function() {
                const skillsSection = document.getElementById('skillsSection');
                if (this.value === 'worker') {
                    skillsSection.classList.remove('hidden');
                } else {
                    skillsSection.classList.add('hidden');
                }
            });

            // Add skill functionality
            document.getElementById('addSkillBtn').addEventListener('click', function() {
                const container = document.getElementById('skillsContainer');
                
                // Check for duplicate skills
                const existingSkills = container.querySelectorAll('select[name*="[skill_id]"]');
                const selectedSkills = Array.from(existingSkills).map(select => select.value).filter(value => value !== '');
                
                if (selectedSkills.length >= 10) {
                    Swal.fire({
                        title: 'Maximum Skills Reached',
                        text: 'You can only add up to 10 skills.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                
                const skillHtml = `
                    <div class="skill-entry border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="font-medium text-gray-900">Skill ${skillIndex + 1}</h5>
                            <button type="button" class="text-red-600 hover:text-red-900 text-sm" onclick="this.parentElement.parentElement.remove()">Remove</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Skill</label>
                                <select name="skills[${skillIndex}][skill_id]" class="skill-select block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required onchange="checkDuplicateSkills(this)">
                                    <option value="">Select Skill</option>
                                    @foreach($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->name }} ({{ $skill->category->name }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Experience Level</label>
                                <select name="skills[${skillIndex}][experience_tier]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Select Experience</option>
                                    <option value="<6 months">Less than 6 months</option>
                                    <option value="6-12 months">6-12 months</option>
                                    <option value="1-2 years">1-2 years</option>
                                    <option value="2-5 years">2-5 years</option>
                                    <option value=">5 years">More than 5 years</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', skillHtml);
                skillIndex++;
            });

            // Add education functionality
            document.getElementById('addEducationBtn').addEventListener('click', function() {
                const container = document.getElementById('educationContainer');
                const educationHtml = `
                    <div class="education-entry border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="font-medium text-gray-900">Education ${educationIndex + 1}</h5>
                            <button type="button" class="text-red-600 hover:text-red-900 text-sm" onclick="this.parentElement.parentElement.remove()">Remove</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Education Level</label>
                                <select name="education[${educationIndex}][level]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Level</option>
                                    <option value="None">None</option>
                                    <option value="Primary">Primary</option>
                                    <option value="O-Level">O-Level</option>
                                    <option value="A-Level">A-Level</option>
                                    <option value="Certificate">Certificate</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Institution</label>
                                <input type="text" name="education[${educationIndex}][institution]" placeholder="e.g., Makerere University, YMCA" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Field of Study</label>
                                <input type="text" name="education[${educationIndex}][field_of_study]" placeholder="e.g., Computer Science, Business Administration" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Year Completed</label>
                                <input type="number" name="education[${educationIndex}][year_completed]" min="1950" max="{{ date('Y') + 1 }}" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', educationHtml);
                educationIndex++;
            });

            // Add language functionality
            document.getElementById('addLanguageBtn').addEventListener('click', function() {
                const container = document.getElementById('languagesContainer');
                const languageHtml = `
                    <div class="language-entry border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="font-medium text-gray-900">Language ${languageIndex + 1}</h5>
                            <button type="button" class="text-red-600 hover:text-red-900 text-sm" onclick="this.parentElement.parentElement.remove()">Remove</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Language</label>
                                <select name="languages[${languageIndex}][language_id]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Language</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Proficiency</label>
                                <select name="languages[${languageIndex}][proficiency]" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select Proficiency</option>
                                    <option value="Basic">Basic</option>
                                    <option value="Conversational">Conversational</option>
                                    <option value="Fluent">Fluent</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', languageHtml);
                languageIndex++;
            });

            // Add reference functionality
            document.getElementById('addReferenceBtn').addEventListener('click', function() {
                if (referenceIndex >= 3) {
                    Swal.fire({
                        title: 'Maximum References Reached',
                        text: 'You can only add up to 3 references.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
                
                const container = document.getElementById('referencesContainer');
                const referenceHtml = `
                    <div class="reference-entry border rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="font-medium text-gray-900">Reference ${referenceIndex + 1}</h5>
                            <button type="button" class="text-red-600 hover:text-red-900 text-sm" onclick="this.parentElement.parentElement.remove()">Remove</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="references[${referenceIndex}][name]" placeholder="e.g., John Doe" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" name="references[${referenceIndex}][phone]" placeholder="+2567XXXXXXXX" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Relationship</label>
                                <input type="text" name="references[${referenceIndex}][relationship]" placeholder="e.g., Former employer, Teacher, Pastor" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            </div>
                            <div class="flex items-center mt-6">
                                <label class="flex items-center">
                                    <input type="checkbox" name="references[${referenceIndex}][can_contact]" value="1" checked class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Can be contacted by employers</span>
                                </label>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', referenceHtml);
                referenceIndex++;
            });
        }

        // Form submission with SweetAlert
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            // Check for duplicate skills before submission
            const skillsContainer = document.getElementById('skillsContainer');
            if (skillsContainer && !skillsContainer.classList.contains('hidden')) {
                const skillSelects = skillsContainer.querySelectorAll('select[name*="[skill_id]"]');
                const selectedSkills = Array.from(skillSelects).map(select => select.value).filter(value => value !== '');
                const uniqueSkills = [...new Set(selectedSkills)];
                
                if (selectedSkills.length !== uniqueSkills.length) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Duplicate Skills Found',
                        text: 'Please remove duplicate skills before submitting.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return;
                }
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Creating Account...';
            submitBtn.disabled = true;
            
            // Show loading state
            Swal.fire({
                title: 'Creating Your Account...',
                text: 'Please wait while we set up your account.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });

        // Function to check for duplicate skills
        function checkDuplicateSkills(selectElement) {
            const selectedValue = selectElement.value;
            if (!selectedValue) return;
            
            const container = document.getElementById('skillsContainer');
            const allSkillSelects = container.querySelectorAll('select[name*="[skill_id]"]');
            let duplicateCount = 0;
            
            allSkillSelects.forEach(select => {
                if (select.value === selectedValue) {
                    duplicateCount++;
                }
            });
            
            if (duplicateCount > 1) {
                Swal.fire({
                    title: 'Duplicate Skill Selected',
                    text: 'You have already selected this skill. Please choose a different one.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                selectElement.value = '';
                return false;
            }
            
            return true;
        }

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
</body>
</html>