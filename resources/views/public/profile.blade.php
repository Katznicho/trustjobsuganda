<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->full_name }} - Professional Profile | TrustJobs Uganda</title>
    <meta name="description" content="View {{ $user->full_name }}'s professional profile on TrustJobs Uganda. {{ $user->profile->bio ?? 'Experienced professional with diverse skills and expertise.' }}">
    <meta name="keywords" content="professional profile, {{ $user->full_name }}, TrustJobs Uganda, skilled worker, job seeker">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $user->full_name }} - Professional Profile">
    <meta property="og:description" content="{{ $user->profile->bio ?? 'Experienced professional with diverse skills and expertise.' }}">
    <meta property="og:type" content="profile">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="TrustJobs Uganda">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $user->full_name }} - Professional Profile">
    <meta name="twitter:description" content="{{ $user->profile->bio ?? 'Experienced professional with diverse skills and expertise.' }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <div class="gradient-bg text-white px-3 py-2 rounded-lg font-bold text-xl">
                            TrustJobs
                        </div>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="{{ route('jobs') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Jobs</a>
                    <a href="{{ route('contact-us') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Profile Header -->
                    <div class="text-center mb-8">
                        <div class="flex justify-center mb-4">
                            <div class="h-24 w-24 rounded-full bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center">
                                <span class="text-3xl font-bold text-white">
                                    {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $user->full_name }}</h1>
                        <p class="text-gray-600 mb-4">{{ $user->email }}</p>
                        @if($user->phone)
                            <p class="text-gray-600 mb-4">{{ $user->phone }}</p>
                        @endif
                        @if($user->profile && $user->profile->location)
                            <p class="text-gray-600 mb-4">📍 {{ $user->profile->location }}</p>
                        @endif
                        @if($user->profile && $user->profile->availability)
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($user->profile->availability === 'available') bg-green-100 text-green-800
                                @elseif($user->profile->availability === 'busy') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($user->profile->availability) }} for Work
                            </span>
                        @endif
                    </div>

                    <!-- Share Profile Section -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-blue-900">Share This Profile</h3>
                                <p class="text-sm text-blue-700">Share this professional profile with employers or colleagues</p>
                            </div>
                            <div class="flex space-x-2">
                                <button onclick="copyProfileLink()" class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">
                                    Copy Link
                                </button>
                                <button onclick="shareProfile()" class="bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-green-700">
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Main Content -->
                        <div class="lg:col-span-2">
                            @if($user->profile && $user->profile->bio)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">About Me</h2>
                                <p class="text-gray-700 leading-relaxed">{{ $user->profile->bio }}</p>
                            </div>
                            @endif

                            @if($user->userSkills && $user->userSkills->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Skills & Experience</h2>
                                <div class="space-y-4">
                                    @foreach($user->userSkills as $userSkill)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <h3 class="font-semibold text-gray-900">{{ $userSkill->skill->name }}</h3>
                                                <p class="text-sm text-gray-600">{{ $userSkill->skill->category->name ?? 'General' }}</p>
                                                <div class="mt-2 flex items-center space-x-4">
                                                    <span class="text-sm text-gray-500">Experience: {{ $userSkill->experience_tier }}</span>
                                                    @if($userSkill->has_certificate)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Certified
                                                    </span>
                                                    @endif
                                                </div>
                                                @if($userSkill->has_certificate && $userSkill->certificate_name && $userSkill->institution_name)
                                                <div class="mt-2 text-sm text-gray-600">
                                                    <p><strong>Certificate:</strong> {{ $userSkill->certificate_name }}</p>
                                                    <p><strong>Institution:</strong> {{ $userSkill->institution_name }}</p>
                                                    @if($userSkill->issue_date)
                                                        <p><strong>Issued:</strong> {{ \Carbon\Carbon::parse($userSkill->issue_date)->format('M Y') }}</p>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($user->educationRecords && $user->educationRecords->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">Education</h2>
                                <div class="space-y-4">
                                    @foreach($user->educationRecords as $education)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-semibold text-gray-900">{{ $education->institution_name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $education->degree }} in {{ $education->field_of_study }}</p>
                                        <p class="text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - 
                                            {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('Y') : 'Present' }}
                                        </p>
                                        @if($education->description)
                                            <p class="text-sm text-gray-600 mt-2">{{ $education->description }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($user->references && $user->references->count() > 0)
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">References</h2>
                                <div class="space-y-4">
                                    @foreach($user->references as $reference)
                                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                                        <h3 class="font-semibold text-gray-900">{{ $reference->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $reference->position }} at {{ $reference->company }}</p>
                                        <p class="text-sm text-gray-500">{{ $reference->phone }}</p>
                                        @if($reference->email)
                                            <p class="text-sm text-gray-500">{{ $reference->email }}</p>
                                        @endif
                                        @if($reference->relationship)
                                            <p class="text-sm text-gray-600 mt-2"><strong>Relationship:</strong> {{ $reference->relationship }}</p>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            @if($user->userLanguages && $user->userLanguages->count() > 0)
                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Languages</h3>
                                <div class="space-y-3">
                                    @foreach($user->userLanguages as $userLanguage)
                                    <div class="flex justify-between items-center">
                                        <span class="font-medium text-gray-900">{{ $userLanguage->language->name }}</span>
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            @if($userLanguage->proficiency === 'native') bg-blue-100 text-blue-800
                                            @elseif($userLanguage->proficiency === 'advanced') bg-green-100 text-green-800
                                            @elseif($userLanguage->proficiency === 'intermediate') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($userLanguage->proficiency) }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="bg-white border border-gray-200 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $user->applications->count() }}</div>
                                        <div class="text-sm text-gray-600">Applications</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $user->userSkills->count() }}</div>
                                        <div class="text-sm text-gray-600">Skills</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ $user->userLanguages->count() }}</div>
                                        <div class="text-sm text-gray-600">Languages</div>
                                    </div>
                                    @if($user->ratingsReceived->count() > 0)
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-indigo-600">{{ number_format($user->ratingsReceived->avg('stars'), 1) }}</div>
                                        <div class="text-sm text-gray-600">Rating</div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-6 text-white text-center">
                                <h3 class="text-lg font-semibold mb-2">Looking for Work?</h3>
                                <p class="text-sm opacity-90 mb-4">Connect with {{ $user->first_name }} for professional opportunities</p>
                                @auth
                                    @if(Auth::user()->role === 'employer')
                                        <a href="{{ route('employer.workers.profile', $user) }}" class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                                            View Full Profile
                                        </a>
                                    @else
                                        <a href="{{ route('worker.profile.public') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                                            View My Profile
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-gray-100">
                                        Join TrustJobs
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="gradient-bg text-white px-3 py-2 rounded-lg font-bold text-xl inline-block mb-4">
                    TrustJobs Uganda
                </div>
                <p class="text-gray-400">Connecting skilled workers with opportunities across Uganda</p>
                <p class="text-gray-500 text-sm mt-2">© {{ date('Y') }} TrustJobs Uganda. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function copyProfileLink() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                // Show success message
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.classList.add('bg-green-600');
                button.classList.remove('bg-blue-600');
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.classList.remove('bg-green-600');
                    button.classList.add('bg-blue-600');
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
                alert('Could not copy link. Please copy manually: ' + url);
            });
        }

        function shareProfile() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $user->full_name }} - Professional Profile',
                    text: 'Check out {{ $user->full_name }}\'s professional profile on TrustJobs Uganda',
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback to copying link
                copyProfileLink();
            }
        }
    </script>
</body>
</html>

