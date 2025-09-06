<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Find Skilled Professionals | TrustJobs Uganda</title>
    <meta name="description" content="Discover skilled professionals and talented workers across Uganda. Browse verified profiles, skills, and connect with the best talent for your projects.">
    <meta name="keywords" content="skilled workers Uganda, professionals, talent, verified workers, skilled labor">
    
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
                    <a href="{{ route('discover') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Discover</a>
                    <a href="{{ route('people') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md text-sm">People</a>
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
                    Find the Best
                    <span class="block text-yellow-300">Talent</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Connect with verified skilled professionals across Uganda. Browse profiles, check skills, and hire the perfect match for your project.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#search" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Browse Professionals
                    </a>
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Join as Professional
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div id="search" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Find the Right Professional
                </h2>
                <p class="text-xl text-gray-600">
                    Search by skills, location, experience level, and more
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Category</label>
                        <select class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option>All Categories</option>
                            <option>Construction & Building</option>
                            <option>Agriculture & Farming</option>
                            <option>Technology & IT</option>
                            <option>Healthcare & Medical</option>
                            <option>Education & Training</option>
                            <option>Business & Finance</option>
                            <option>Creative & Design</option>
                            <option>Services & Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" placeholder="Enter district or city" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                        <select class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option>Any Experience</option>
                            <option>Less than 6 months</option>
                            <option>6-12 months</option>
                            <option>1-2 years</option>
                            <option>2-5 years</option>
                            <option>More than 5 years</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button class="w-full bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Search Professionals
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Professionals -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Featured Professionals
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Meet some of our top-rated skilled professionals who are ready to take on your next project.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Professional Card 1 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">JM</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">John Mukasa</h3>
                            <p class="text-gray-600">Construction Specialist</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (127 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Masonry</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Concrete Work</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Tiling</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Experienced construction professional with 8+ years in masonry, concrete work, and building projects across Kampala.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Kampala</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>

                <!-- Professional Card 2 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">SN</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Sarah Nakato</h3>
                            <p class="text-gray-600">Agricultural Expert</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.8 (89 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Crop Farming</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Livestock</span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Irrigation</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Agricultural specialist with expertise in modern farming techniques, crop management, and sustainable agriculture practices.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Jinja</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>

                <!-- Professional Card 3 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">DK</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">David Kato</h3>
                            <p class="text-gray-600">IT Specialist</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (156 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Web Development</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Database</span>
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Mobile Apps</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Full-stack developer with 6+ years experience in web and mobile application development, database management.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Entebbe</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>

                <!-- Professional Card 4 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">MN</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Mary Nalubega</h3>
                            <p class="text-gray-600">Healthcare Professional</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (203 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Nursing</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">First Aid</span>
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Health Education</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Registered nurse with 10+ years experience in patient care, health education, and emergency medical services.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Mukono</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>

                <!-- Professional Card 5 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">PO</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Peter Okello</h3>
                            <p class="text-gray-600">Education Specialist</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.8 (94 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Mathematics</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Science</span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Tutoring</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Experienced teacher and tutor specializing in mathematics and science education for primary and secondary students.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Masaka</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>

                <!-- Professional Card 6 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">AK</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900">Alice Kirabo</h3>
                            <p class="text-gray-600">Business Consultant</p>
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (78 reviews)</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Business Planning</span>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Marketing</span>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Finance</span>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Business consultant with expertise in strategic planning, marketing, and financial management for SMEs.
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">📍 Gulu</span>
                        <span class="text-sm font-semibold text-green-600">Available</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    View All Professionals
                </a>
            </div>
        </div>
    </div>

    <!-- Why Choose Our Professionals -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Why Choose Our Professionals?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Every professional on our platform is carefully vetted and verified to ensure quality and reliability.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Verified & Trusted</h3>
                    <p class="text-gray-600">
                        All professionals undergo background checks, skill verification, and reference validation to ensure quality and trustworthiness.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Matching</h3>
                    <p class="text-gray-600">
                        Our smart matching system connects you with the most suitable professionals based on your specific requirements and location.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quality Guaranteed</h3>
                    <p class="text-gray-600">
                        We guarantee the quality of work through our rating system, reviews, and satisfaction guarantee policy.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ready to Find Your Perfect Match?
            </h2>
            <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                Join thousands of satisfied clients who have found the right professionals for their projects.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    @if(Auth::user()->role === 'employer')
                        <a href="{{ route('employer.workers.search') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Search Professionals
                        </a>
                    @else
                        <a href="{{ route('worker.profile.public') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Create Profile
                        </a>
                    @endif
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
