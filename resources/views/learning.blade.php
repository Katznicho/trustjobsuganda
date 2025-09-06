<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Skill Development & Learning | TrustJobs Uganda</title>
    <meta name="description" content="Enhance your skills with professional training courses, certifications, and learning resources. Advance your career with TrustJobs Uganda's learning platform.">
    <meta name="keywords" content="skill development, professional training, certifications, career advancement, learning Uganda">
    
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
                    <a href="{{ route('learning') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md text-sm">Learning</a>
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
                    Learn & Grow
                    <span class="block text-yellow-300">Your Skills</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Advance your career with professional training courses, certifications, and skill development programs designed for the modern workforce.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#courses" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Browse Courses
                    </a>
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-indigo-600 transition">
                        Start Learning
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Stats -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">500+</div>
                    <div class="text-gray-600">Training Courses</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">15,000+</div>
                    <div class="text-gray-600">Students Enrolled</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">200+</div>
                    <div class="text-gray-600">Expert Instructors</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-indigo-600 mb-2">95%</div>
                    <div class="text-gray-600">Completion Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div id="courses" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Featured Courses
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Choose from our comprehensive selection of professional development courses designed to boost your career.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <div class="text-6xl">🏗️</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Construction</span>
                            <span class="ml-2 text-sm text-gray-500">Beginner</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Modern Construction Techniques</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Learn the latest construction methods, safety protocols, and project management skills for the construction industry.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.8 (124)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 150,000</span>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                        <div class="text-6xl">🌾</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Agriculture</span>
                            <span class="ml-2 text-sm text-gray-500">Intermediate</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Sustainable Farming Practices</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Master sustainable agriculture techniques, crop rotation, organic farming, and modern irrigation systems.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (89)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 120,000</span>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                        <div class="text-6xl">💻</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Technology</span>
                            <span class="ml-2 text-sm text-gray-500">Advanced</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Web Development Bootcamp</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Complete web development course covering HTML, CSS, JavaScript, and modern frameworks for full-stack development.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (156)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 300,000</span>
                        </div>
                    </div>
                </div>

                <!-- Course Card 4 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                        <div class="text-6xl">🏥</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Healthcare</span>
                            <span class="ml-2 text-sm text-gray-500">Beginner</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Healthcare Fundamentals</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Essential healthcare skills including first aid, patient care, medical terminology, and healthcare ethics.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.8 (203)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 200,000</span>
                        </div>
                    </div>
                </div>

                <!-- Course Card 5 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-yellow-500 to-yellow-600 flex items-center justify-center">
                        <div class="text-6xl">🎓</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Education</span>
                            <span class="ml-2 text-sm text-gray-500">Intermediate</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Teaching Excellence</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Advanced teaching methodologies, classroom management, curriculum development, and student assessment techniques.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.7 (94)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 180,000</span>
                        </div>
                    </div>
                </div>

                <!-- Course Card 6 -->
                <div class="bg-white rounded-xl overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                        <div class="text-6xl">💼</div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs rounded-full">Business</span>
                            <span class="ml-2 text-sm text-gray-500">Advanced</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Business Management</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            Strategic business planning, financial management, marketing strategies, and leadership development for entrepreneurs.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    <span>★★★★★</span>
                                </div>
                                <span class="ml-2 text-sm text-gray-600">4.9 (78)</span>
                            </div>
                            <span class="text-lg font-semibold text-indigo-600">UGX 250,000</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    View All Courses
                </a>
            </div>
        </div>
    </div>

    <!-- Learning Categories -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Learn by Category
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Explore our comprehensive learning categories designed to meet your professional development needs.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🏗️</div>
                    <h3 class="font-semibold mb-2">Construction</h3>
                    <p class="text-sm opacity-90">Building & Engineering</p>
                    <div class="mt-3 text-sm opacity-75">25+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🌾</div>
                    <h3 class="font-semibold mb-2">Agriculture</h3>
                    <p class="text-sm opacity-90">Farming & Agribusiness</p>
                    <div class="mt-3 text-sm opacity-75">30+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">💻</div>
                    <h3 class="font-semibold mb-2">Technology</h3>
                    <p class="text-sm opacity-90">IT & Digital Skills</p>
                    <div class="mt-3 text-sm opacity-75">40+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🏥</div>
                    <h3 class="font-semibold mb-2">Healthcare</h3>
                    <p class="text-sm opacity-90">Medical & Wellness</p>
                    <div class="mt-3 text-sm opacity-75">20+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🎓</div>
                    <h3 class="font-semibold mb-2">Education</h3>
                    <p class="text-sm opacity-90">Teaching & Training</p>
                    <div class="mt-3 text-sm opacity-75">35+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">💼</div>
                    <h3 class="font-semibold mb-2">Business</h3>
                    <p class="text-sm opacity-90">Management & Finance</p>
                    <div class="mt-3 text-sm opacity-75">45+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🎨</div>
                    <h3 class="font-semibold mb-2">Creative</h3>
                    <p class="text-sm opacity-90">Design & Arts</p>
                    <div class="mt-3 text-sm opacity-75">15+ Courses</div>
                </div>
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl p-6 text-white text-center card-hover">
                    <div class="text-4xl mb-3">🔧</div>
                    <h3 class="font-semibold mb-2">Services</h3>
                    <p class="text-sm opacity-90">Technical & Repair</p>
                    <div class="mt-3 text-sm opacity-75">25+ Courses</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Learn With Us -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Why Learn With TrustJobs?
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    We provide industry-leading education with practical, job-ready skills that employers value.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Industry Experts</h3>
                    <p class="text-gray-600">
                        Learn from certified professionals and industry experts with years of real-world experience in their fields.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Certified Programs</h3>
                    <p class="text-gray-600">
                        Earn recognized certificates upon completion that enhance your professional credibility and job prospects.
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Flexible Learning</h3>
                    <p class="text-gray-600">
                        Study at your own pace with flexible schedules, online resources, and practical hands-on training sessions.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="hero-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
                Ready to Advance Your Career?
            </h2>
            <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
                Join thousands of professionals who have enhanced their skills and advanced their careers through our learning programs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Access Learning
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Start Learning Free
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

