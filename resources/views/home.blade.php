<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">Skillfy Jobs Uganda</h1>
                <p class="text-xl mb-8">Connecting skilled workers with opportunities across Uganda</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get Started
                    </a>
                    <a href="{{ route('how-it-works') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                        How It Works
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ number_format($stats['total_workers']) }}</div>
                    <div class="text-gray-600">Skilled Workers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ number_format($stats['total_employers']) }}</div>
                    <div class="text-gray-600">Employers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ number_format($stats['active_jobs']) }}</div>
                    <div class="text-gray-600">Active Jobs</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-orange-600 mb-2">{{ number_format($stats['completed_jobs']) }}</div>
                    <div class="text-gray-600">Completed Jobs</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Featured Jobs</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($featuredJobs as $job)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-500">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-semibold">{{ $job->title }}</h3>
                        @if($job->urgent)
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Urgent</span>
                        @endif
                    </div>
                    <p class="text-gray-600 mb-4">{{ Str::limit($job->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-green-600 font-semibold">UGX {{ number_format($job->budget) }}</span>
                        <span class="text-gray-500 text-sm">{{ $job->district }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    View All Jobs
                </a>
            </div>
        </div>
    </section>

    <!-- Skill Categories Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Popular Skill Categories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($skillCategories as $category)
                <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-4">{{ $category->icon }}</div>
                    <h3 class="text-xl font-semibold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                    <div class="text-sm text-gray-500">{{ $category->skills_count }} skills available</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Create Your Profile</h3>
                    <p class="text-gray-600">Workers showcase their skills and experience. Employers post job opportunities.</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-purple-600">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Find Your Match</h3>
                    <p class="text-gray-600">Our smart matching system connects workers with suitable jobs and employers with qualified workers.</p>
                </div>
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-green-600">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Get Hired</h3>
                    <p class="text-gray-600">Connect, negotiate, and complete jobs successfully with our secure platform.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl mb-8">Join thousands of workers and employers already using Skillfy Jobs</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                    Sign Up Now
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
</x-app-layout>

