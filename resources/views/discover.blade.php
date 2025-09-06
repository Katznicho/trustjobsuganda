<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Discover Opportunities | TrustJobs Uganda</title>
    <meta name="description" content="Discover amazing job opportunities, skilled workers, and professional services across Uganda. Find your next career move or hire the best talent.">
    <meta name="keywords" content="jobs Uganda, skilled workers, professional services, career opportunities, employment">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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
                    <a href="{{ route('discover') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md text-sm">Discover</a>
                    <a href="{{ route('people') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">People</a>
                    <a href="{{ route('learning') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Learning</a>
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

    <!-- Hero Section -->
    <div class="hero-bg text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Discover Your Next
                    <span class="block text-yellow-300">Opportunity</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Connect with skilled professionals, find amazing job opportunities, and build your career with Uganda's most trusted job platform.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('jobs') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Find Jobs
                    </a>
                    <a href="{{ route('people') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Find Talent
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">10,000+</div>
                    <div class="text-gray-600">Active Jobs</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">50,000+</div>
                    <div class="text-gray-600">Skilled Workers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">5,000+</div>
                    <div class="text-gray-600">Companies</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">95%</div>
                    <div class="text-gray-600">Success Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Why Choose TrustJobs?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We're revolutionizing the job market in Uganda with innovative features and trusted connections.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Verified Professionals</h3>
                    <p class="text-gray-600">
                        All our workers are verified with skills assessments, references, and background checks to ensure quality and reliability.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Instant Matching</h3>
                    <p class="text-gray-600">
                        Our AI-powered matching system connects you with the most relevant opportunities and candidates in seconds.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fair Pricing</h3>
                    <p class="text-gray-600">
                        Transparent pricing with no hidden fees. Pay only for what you use with flexible payment options.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Explore by Category
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Find opportunities in your field of expertise or discover new areas to grow your career.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🏗️</div>
                    <h3 class="font-semibold mb-2">Construction</h3>
                    <p class="text-sm opacity-90">Builders, Engineers, Architects</p>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🌾</div>
                    <h3 class="font-semibold mb-2">Agriculture</h3>
                    <p class="text-sm opacity-90">Farmers, Agronomists, Technicians</p>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">💻</div>
                    <h3 class="font-semibold mb-2">Technology</h3>
                    <p class="text-sm opacity-90">Developers, Designers, Analysts</p>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🏥</div>
                    <h3 class="font-semibold mb-2">Healthcare</h3>
                    <p class="text-sm opacity-90">Doctors, Nurses, Technicians</p>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🎓</div>
                    <h3 class="font-semibold mb-2">Education</h3>
                    <p class="text-sm opacity-90">Teachers, Trainers, Administrators</p>
                </div>
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">💼</div>
                    <h3 class="font-semibold mb-2">Business</h3>
                    <p class="text-sm opacity-90">Managers, Consultants, Analysts</p>
                </div>
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🎨</div>
                    <h3 class="font-semibold mb-2">Creative</h3>
                    <p class="text-sm opacity-90">Designers, Artists, Writers</p>
                </div>
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-3xl mb-3">🔧</div>
                    <h3 class="font-semibold mb-2">Services</h3>
                    <p class="text-sm opacity-90">Technicians, Repair, Maintenance</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                Join thousands of professionals who have found their dream jobs and built successful careers through TrustJobs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="gradient-bg text-white px-3 py-2 rounded-lg font-bold text-xl mb-4">
                        TrustJobs Uganda
                    </div>
                    <p class="text-gray-400 mb-4">
                        Connecting skilled workers with opportunities across Uganda.
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">For Workers</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('jobs') }}" class="hover:text-white">Find Jobs</a></li>
                        <li><a href="{{ route('people') }}" class="hover:text-white">Browse Profiles</a></li>
                        <li><a href="{{ route('learning') }}" class="hover:text-white">Skill Development</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">For Employers</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('people') }}" class="hover:text-white">Find Talent</a></li>
                        <li><a href="{{ route('jobs') }}" class="hover:text-white">Post Jobs</a></li>
                        <li><a href="{{ route('contact-us') }}" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Mpererwe, Vero Plaza</li>
                        <li>Above offices of National Water</li>
                        <li>0790205056</li>
                        <li>info@risidev.com</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} TrustJobs Uganda. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>