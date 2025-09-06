<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Find Jobs & Opportunities | TrustJobs Uganda</title>
    <meta name="description" content="Discover thousands of job opportunities across Uganda. Find your next career move with verified employers and competitive positions.">
    <meta name="keywords" content="jobs Uganda, employment opportunities, career, work, hiring, job search">
    
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
                    <a href="{{ route('people') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">People</a>
                    <a href="{{ route('learning') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Learning</a>
                    <a href="{{ route('jobs') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md text-sm">Jobs</a>
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
                    Find Your Dream
                    <span class="block text-yellow-300">Job Today</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Discover thousands of job opportunities from verified employers across Uganda. Your next career move starts here.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#search" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Search Jobs
                    </a>
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Post a Job
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Search Section -->
    <div id="search" class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Find the Perfect Job
                </h2>
                <p class="text-xl text-gray-600">
                    Search by location, category, salary, and more
                </p>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" placeholder="e.g. Software Developer" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" placeholder="Enter district or city" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
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
                    <div class="flex items-end">
                        <button class="w-full bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Search Jobs
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Jobs -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Featured Job Opportunities
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Discover exciting career opportunities from top employers across Uganda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Job Card 1 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">TC</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Senior Construction Manager</h3>
                                <p class="text-gray-600">TechCorp Uganda</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Full-time</span>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Kampala, Uganda
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            UGX 2,500,000 - 3,500,000
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Posted 2 days ago
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        We're looking for an experienced construction manager to oversee large-scale building projects. Must have 5+ years experience in construction management.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Construction</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Management</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Project Management</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">15 applicants</span>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">AF</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Agricultural Specialist</h3>
                                <p class="text-gray-600">AgriFarm Solutions</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Full-time</span>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Jinja, Uganda
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            UGX 1,800,000 - 2,200,000
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Posted 1 day ago
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Join our team as an agricultural specialist to help farmers improve crop yields and implement sustainable farming practices.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Agriculture</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Crop Management</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Sustainability</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">8 applicants</span>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">IT</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Full Stack Developer</h3>
                                <p class="text-gray-600">InnovateTech Uganda</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm rounded-full">Remote</span>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Remote / Kampala
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            UGX 3,000,000 - 4,500,000
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Posted 3 days ago
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        We're seeking a talented full-stack developer to join our growing tech team. Experience with React, Node.js, and cloud technologies required.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">React</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Node.js</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">AWS</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">23 applicants</span>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                            Apply Now
                        </a>
                    </div>
                </div>

                <!-- Job Card 4 -->
                <div class="bg-white rounded-xl p-6 card-hover">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-red-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold">HC</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Registered Nurse</h3>
                                <p class="text-gray-600">HealthCare Plus</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Full-time</span>
                    </div>
                    <div class="mb-4">
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Mukono, Uganda
                        </div>
                        <div class="flex items-center text-gray-600 mb-2">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            UGX 1,500,000 - 2,000,000
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Posted 4 days ago
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Join our healthcare team as a registered nurse. Provide quality patient care and support in our modern medical facility.
                    </p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Nursing</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Patient Care</span>
                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Medical</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">12 applicants</span>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    View All Jobs
                </a>
            </div>
        </div>
    </div>

    <!-- Job Categories -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Browse Jobs by Category
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Find opportunities in your field of expertise or explore new career paths.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🏗️</div>
                    <h3 class="font-semibold mb-2">Construction</h3>
                    <p class="text-sm opacity-90">Building & Engineering</p>
                    <div class="mt-3 text-sm opacity-75">150+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🌾</div>
                    <h3 class="font-semibold mb-2">Agriculture</h3>
                    <p class="text-sm opacity-90">Farming & Agribusiness</p>
                    <div class="mt-3 text-sm opacity-75">200+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">💻</div>
                    <h3 class="font-semibold mb-2">Technology</h3>
                    <p class="text-sm opacity-90">IT & Digital</p>
                    <div class="mt-3 text-sm opacity-75">300+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🏥</div>
                    <h3 class="font-semibold mb-2">Healthcare</h3>
                    <p class="text-sm opacity-90">Medical & Wellness</p>
                    <div class="mt-3 text-sm opacity-75">120+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🎓</div>
                    <h3 class="font-semibold mb-2">Education</h3>
                    <p class="text-sm opacity-90">Teaching & Training</p>
                    <div class="mt-3 text-sm opacity-75">180+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">💼</div>
                    <h3 class="font-semibold mb-2">Business</h3>
                    <p class="text-sm opacity-90">Management & Finance</p>
                    <div class="mt-3 text-sm opacity-75">250+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🎨</div>
                    <h3 class="font-semibold mb-2">Creative</h3>
                    <p class="text-sm opacity-90">Design & Arts</p>
                    <div class="mt-3 text-sm opacity-75">80+ Jobs</div>
                </div>
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🔧</div>
                    <h3 class="font-semibold mb-2">Services</h3>
                    <p class="text-sm opacity-90">Technical & Repair</p>
                    <div class="mt-3 text-sm opacity-75">100+ Jobs</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose TrustJobs -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Why Choose TrustJobs?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We connect you with verified employers and quality job opportunities across Uganda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Verified Employers</h3>
                    <p class="text-gray-600">
                        All employers on our platform are verified and legitimate, ensuring you apply to real job opportunities.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Quick Applications</h3>
                    <p class="text-gray-600">
                        Apply to multiple jobs with just a few clicks. Our streamlined process saves you time and effort.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Career Support</h3>
                    <p class="text-gray-600">
                        Get career advice, resume tips, and interview preparation resources to help you land your dream job.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ready to Find Your Next Job?
            </h2>
            <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                Join thousands of professionals who have found their dream jobs through TrustJobs Uganda.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    @if(Auth::user()->role === 'worker')
                        <a href="{{ route('worker.jobs.index') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Browse Jobs
                        </a>
                    @else
                        <a href="{{ route('employer.jobs.create') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Post a Job
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

