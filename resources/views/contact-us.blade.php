<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us | TrustJobs Uganda</title>
    <meta name="description" content="Get in touch with TrustJobs Uganda. Contact us for support, partnerships, or any inquiries about our job platform.">
    <meta name="keywords" content="contact TrustJobs, support, help, Uganda job platform, customer service">
    
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
                    <a href="{{ route('jobs') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Jobs</a>
                    <a href="{{ route('contact-us') }}" class="text-indigo-600 font-medium px-3 py-2 rounded-md text-sm">Contact</a>
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
                    Get in
                    <span class="block text-yellow-300">Touch</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    We're here to help! Contact us for support, partnerships, or any questions about TrustJobs Uganda.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Contact Information
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Reach out to us through any of the following channels. We're here to assist you.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Office Address -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Office Address</h3>
                    <p class="text-gray-600 mb-2">
                        Mpererwe, Vero Plaza
                    </p>
                    <p class="text-gray-600 mb-2">
                        Above offices of National Water
                    </p>
                    <p class="text-gray-600">
                        Kampala, Uganda
                    </p>
                </div>

                <!-- Phone -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Phone</h3>
                    <p class="text-gray-600 mb-2">
                        <a href="tel:+256790205056" class="hover:text-indigo-600 transition">
                            +256 790 205 056
                        </a>
                    </p>
                    <p class="text-sm text-gray-500">
                        Mon - Fri: 8:00 AM - 6:00 PM
                    </p>
                </div>

                <!-- Email -->
                <div class="bg-white border border-gray-200 rounded-xl p-8 text-center card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Email</h3>
                    <p class="text-gray-600 mb-2">
                        <a href="mailto:info@risidev.com" class="hover:text-indigo-600 transition">
                            info@risidev.com
                        </a>
                    </p>
                    <p class="text-sm text-gray-500">
                        We respond within 24 hours
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Send us a Message
                </h2>
                <p class="text-xl text-gray-600">
                    Have a question or need support? Fill out the form below and we'll get back to you.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Your full name">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500" placeholder="your.email@example.com">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500" placeholder="+256 XXX XXX XXX">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <select id="subject" name="subject" required class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="partnership">Partnership</option>
                                <option value="feedback">Feedback</option>
                                <option value="complaint">Complaint</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea id="message" name="message" rows="6" required class="w-full border-gray-300 rounded-lg px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tell us how we can help you..."></textarea>
                    </div>
                    
                    <div class="flex items-center">
                        <input id="newsletter" name="newsletter" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                            I would like to receive updates about TrustJobs Uganda
                        </label>
                    </div>
                    
                    <div class="text-center">
                        <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Frequently Asked Questions
                </h2>
                <p class="text-xl text-gray-600">
                    Find answers to common questions about TrustJobs Uganda.
                </p>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">How do I create an account?</h3>
                    <p class="text-gray-600">
                        Click on the "Register" button in the top navigation, fill out the registration form with your details, and verify your email address. You can choose to register as a worker or employer.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Is TrustJobs free to use?</h3>
                    <p class="text-gray-600">
                        Yes! Creating an account and browsing jobs is completely free. We offer premium features for employers who want enhanced visibility and additional tools.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">How do I apply for jobs?</h3>
                    <p class="text-gray-600">
                        Once you're logged in as a worker, browse available jobs, click on a job that interests you, and use the "Apply Now" button. You can customize your cover letter for each application.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">How do I post a job as an employer?</h3>
                    <p class="text-gray-600">
                        Register as an employer, complete your company profile, and use the "Post Job" feature to create detailed job listings. You can specify required skills, location, and other requirements.
                    </p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">What if I need help with my account?</h3>
                    <p class="text-gray-600">
                        Contact our support team through the contact form above, email us at info@risidev.com, or call us at +256 790 205 056. We're here to help!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Visit Our Office
                </h2>
                <p class="text-xl text-gray-600">
                    Come and meet us in person at our office in Kampala.
                </p>
            </div>

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                <div class="h-96 bg-gray-200 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">TrustJobs Uganda Office</h3>
                        <p class="text-gray-600 mb-2">Mpererwe, Vero Plaza</p>
                        <p class="text-gray-600 mb-2">Above offices of National Water</p>
                        <p class="text-gray-600">Kampala, Uganda</p>
                        <div class="mt-4">
                            <a href="https://maps.google.com/?q=Mpererwe+Vero+Plaza+Kampala+Uganda" target="_blank" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                                Get Directions
                            </a>
                        </div>
                    </div>
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
                Join TrustJobs Uganda today and start your journey towards finding the perfect job or the best talent.
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

