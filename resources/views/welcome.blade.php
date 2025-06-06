<x-layouts.site :title="__('Welcome to Laravel Uganda')">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-red-600 to-red-800 text-white">
        <div class="container mx-auto px-6 py-20">
            <h1 class="text-5xl font-bold mb-4">Laravel Uganda Community</h1>
            <p class="text-xl mb-8">Join the largest Laravel community in Uganda. Learn, share, and grow together.</p>
            <div class="flex gap-4">
                <a href="/register" class="bg-white text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Join Community</a>
                <a href="/meetups" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition">Upcoming Meetups</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">What We Offer</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Monthly Meetups</h3>
                    <p class="text-gray-600">Regular community gatherings to share knowledge, experiences, and network with fellow Laravel developers.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Learning Resources</h3>
                    <p class="text-gray-600">Access to curated learning materials, workshops, and hands-on coding sessions.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Job Opportunities</h3>
                    <p class="text-gray-600">Connect with companies hiring Laravel developers in Uganda and East Africa.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Stats -->
    <div class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Our Growing Community</h2>
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-red-600 mb-2">500+</div>
                    <div class="text-gray-600">Members</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-red-600 mb-2">50+</div>
                    <div class="text-gray-600">Meetups Held</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-red-600 mb-2">100+</div>
                    <div class="text-gray-600">Projects</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-red-600 mb-2">20+</div>
                    <div class="text-gray-600">Partners</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="bg-red-600 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Join Our Community?</h2>
            <p class="mb-8 text-lg">Connect with fellow Laravel developers in Uganda and start your journey today.</p>
            <a href="/register" class="bg-white text-red-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition inline-block">Get Started</a>
        </div>
    </div>
</x-layouts.site>
