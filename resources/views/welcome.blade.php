<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Uganda</title> <!-- Updated title -->

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure Vite handles CSS -->
        <!-- Removed large inline style block -->
    </head>
    <body class="font-sans antialiased bg-white dark:bg-neutral-900 text-neutral-700 dark:text-neutral-300">
        <header class="bg-white dark:bg-neutral-800 shadow-sm">
            <div class="container mx-auto px-4 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-2xl font-semibold text-red-500 dark:text-red-500">
                            Laravel Uganda
                        </a>
                    </div>

                    <!-- Desktop Navigation Links -->
                    <nav class="hidden md:flex space-x-8 items-center">
                        <a href="{{ route('home') }}" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">Home</a>
                        <a href="{{ route('meetups.public.index') }}" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">Meetups</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">#Blog</a>
                        <a href="#" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">#About</a>
                    </nav>

                    <!-- Auth Links & Social Icons -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-base font-medium text-gray-500 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500">Register</a>
                            @endif
                        @endauth
                        <a href="https://discord.gg/7FWvfABUwz" target="_blank" aria-label="Discord">
                            <svg class="h-6 w-6 text-gray-600 hover:text-red-500 dark:text-gray-400 dark:hover:text-red-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M20.29,3.09C19.23,2.38,18.09,1.76,16.88,1.26C16.73,1.21,16.57,1.17,16.41,1.14C16.22,1.1,16.03,1.08,15.83,1.07C15.79,1.07,15.75,1.07,15.71,1.07C14.6,1.07,13.5,1.22,12.44,1.52C12.41,1.53,12.38,1.54,12.35,1.55C10.02,2.25,7.96,3.68,6.23,5.72C6.03,5.95,5.84,6.19,5.66,6.43C4.38,8.13,3.53,10.08,3.16,12.15C3.14,12.27,3.12,12.39,3.11,12.51C3.07,12.77,3.05,13.03,3.05,13.29C3.05,13.45,3.05,13.61,3.06,13.77C3.09,14.18,3.14,14.58,3.2,14.98C3.21,15.02,3.21,15.06,3.22,15.1C3.73,18.39,5.63,21.25,8.54,23.01C8.69,23.1,8.84,23.18,9,23.26C9.05,23.29,9.1,23.32,9.15,23.35C9.18,23.37,9.21,23.39,9.24,23.41C10.46,24.06,11.76,24.4,13.1,24.49C13.19,24.5,13.28,24.5,13.37,24.51C13.53,24.52,13.69,24.53,13.85,24.53C13.97,24.53,14.09,24.53,14.21,24.53C16.68,24.53,19.04,23.75,21.04,22.33C21.23,22.19,21.41,22.04,21.58,21.88C22.82,20.71,23.75,19.31,24.29,17.76C24.31,17.7,24.33,17.64,24.35,17.58C24.81,16.12,25,14.58,25,12.99C25,12.92,25,12.85,25,12.78C24.94,10.21,24.08,7.8,22.58,5.74C22.16,5.17,21.7,4.64,21.2,4.15C21.14,4.09,21.08,4.03,21.02,3.97C20.83,3.74,20.63,3.51,20.42,3.29C20.37,3.23,20.32,3.18,20.29,3.09L20.29,3.09ZM10.57,18.1C9.62,18.1,8.84,17.32,8.84,16.37C8.84,15.42,9.62,14.64,10.57,14.64C11.52,14.64,12.3,15.42,12.3,16.37C12.31,17.32,11.53,18.1,10.57,18.1ZM16.43,18.1C15.48,18.1,14.7,17.32,14.7,16.37C14.7,15.42,15.48,14.64,16.43,14.64C17.38,14.64,18.16,15.42,18.16,16.37C18.16,17.32,17.38,18.1,16.43,18.1Z"/>
                            </svg>
                        </a>
                        <a href="https://chat.whatsapp.com/Gl6OT8i4DWyGnVv93Cjx1Y" target="_blank" aria-label="WhatsApp">
                            <svg class="h-6 w-6 text-gray-600 hover:text-green-500 dark:text-gray-400 dark:hover:text-green-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.04,2A10.02,10.02,0,0,0,2,12.04a10.02,10.02,0,0,0,10.04,10.02A10.02,10.02,0,0,0,22.06,12.04,10.02,10.02,0,0,0,12.04,2Zm0,18.1A8.07,8.07,0,0,1,3.96,12.04,8.07,8.07,0,0,1,12.04,3.96,8.07,8.07,0,0,1,20.12,12.04,8.07,8.07,0,0,1,12.04,20.12ZM17.46,14.85A4.54,4.54,0,0,0,16.65,14c-.27-.14-1.53-.75-1.76-.84s-.39-.13-.56.13-.67.84-.82,1-.29.19-.55,0a6.49,6.49,0,0,1-1.77-.93,7.13,7.13,0,0,1-1.26-1.52c-.14-.24,0-.38.11-.51s.24-.29.36-.43a1.69,1.69,0,0,0,.24-.42.41.41,0,0,0-.05-.38c-.06-.13-.56-1.34-.76-1.84s-.39-.42-.56-.43h-.48a.93.93,0,0,0-.67.31,2.84,2.84,0,0,0-.9,2.1,4.9,4.9,0,0,0,1,2.95,7.76,7.76,0,0,0,3.52,3.09,6.72,6.72,0,0,0,1.19.42,2.61,2.61,0,0,0,1.3.08,2.09,2.09,0,0,0,1.39-.94c.22-.29.22-.55.16-.84S17.73,15,17.46,14.85Z"/>
                            </svg>
                        </a>
                    </div>
                    <!-- Mobile Menu Button (simple version, no JS for full functionality in this step) -->
                    <div class="md:hidden flex items-center">
                        <button type="button" class="text-gray-500 dark:text-gray-400 hover:text-red-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Mobile Navigation (very basic, shown/hidden with CSS or future JS) -->
                <div class="md:hidden hidden" id="mobile-menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700 hover:text-red-500">Home</a>
                        <a href="{{ route('meetups.public.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700 hover:text-red-500">Meetups</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700 hover:text-red-500">#Blog</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700 hover:text-red-500">#About</a>
                    </div>
                </div>
            </div>
        </header>

        <main class="w-full">
            <!-- Hero Section -->
            <section class="py-12 bg-white dark:bg-neutral-800">
                <div class="container mx-auto px-4 lg:px-8 text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-5xl md:text-6xl">
                        Welcome to the <span class="text-red-500">Laravel Uganda</span> Community!
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-neutral-600 dark:text-neutral-300">
                        Your hub to connect, learn, and grow with Laravel developers across Uganda.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="https://discord.gg/7FWvfABUwz" target="_blank" class="rounded-md bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">
                            Join our Discord
                        </a>
                        <a href="{{ route('meetups.public.index') }}" class="text-sm font-semibold leading-6 text-neutral-900 dark:text-white hover:text-red-500">
                            View Upcoming Meetups <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </section>

            <!-- About Us Snippet -->
            <section class="py-12 bg-gray-50 dark:bg-neutral-800/50">
                <div class="container mx-auto px-4 lg:px-8">
                    <div class="mx-auto max-w-2xl lg:text-center">
                        <h2 class="text-base font-semibold leading-7 text-red-500">About Us</h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-neutral-900 dark:text-white sm:text-4xl">
                            Laravel Uganda Community
                        </p>
                        <p class="mt-6 text-lg leading-8 text-neutral-600 dark:text-neutral-300">
                            We are a vibrant community of Laravel developers in Uganda, focused on knowledge sharing, networking, technical resources, and organizing regular meetups and events. Our goal is to foster growth and collaboration among developers of all levels.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Upcoming Meetups Section -->
            <section class="py-12 bg-white dark:bg-neutral-800">
                <div class="container mx-auto px-4 lg:px-8">
                    <h2 class="text-3xl font-bold text-center text-neutral-900 dark:text-white mb-8">Upcoming Meetups & Events</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Static Placeholder Meetup 1 -->
                        <div class="p-6 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-sm bg-gray-50 dark:bg-neutral-800/50">
                            <h3 class="text-xl font-semibold text-red-500">Laracon UG Lite</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Date: 2024-12-15 | Location: Online</p>
                            <p class="mt-3 text-neutral-700 dark:text-neutral-300">A mini-conference packed with great talks and networking opportunities for the Laravel Uganda community. Don't miss out!</p>
                            <a href="{{ route('meetups.public.index') }}" class="text-red-500 hover:underline mt-4 inline-block font-semibold">View Details &rarr;</a>
                        </div>
                        <!-- Static Placeholder Meetup 2 (Optional) -->
                        <div class="p-6 border border-gray-200 dark:border-neutral-700 rounded-lg shadow-sm bg-gray-50 dark:bg-neutral-800/50">
                            <h3 class="text-xl font-semibold text-red-500">Monthly UG Tech Meetup</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Date: Every last Thursday | Location: The Innovation Village</p>
                            <p class="mt-3 text-neutral-700 dark:text-neutral-300">Join us for our regular meetup covering various tech topics, including Laravel, Livewire, and more.</p>
                            <a href="{{ route('meetups.public.index') }}" class="text-red-500 hover:underline mt-4 inline-block font-semibold">View All Meetups &rarr;</a>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        <a href="{{ route('meetups.public.index') }}" class="rounded-md bg-red-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">
                            View All Meetups
                        </a>
                    </div>
                </div>
            </section>

            <!-- Community/Social Links Section -->
            <section class="py-12 bg-gray-50 dark:bg-neutral-800/50">
                <div class="container mx-auto px-4 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-6">Join the Conversation</h2>
                    <p class="mb-8 text-lg text-neutral-600 dark:text-neutral-300">Connect with fellow developers, ask questions, share your knowledge, and stay updated with the latest happenings.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                        <a href="https://discord.gg/7FWvfABUwz" target="_blank" class="flex items-center justify-center gap-3 px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md transition-transform transform hover:scale-105 w-full sm:w-auto">
                            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> <!-- Slightly larger icon -->
                                <path d="M20.29,3.09C19.23,2.38,18.09,1.76,16.88,1.26C16.73,1.21,16.57,1.17,16.41,1.14C16.22,1.1,16.03,1.08,15.83,1.07C15.79,1.07,15.75,1.07,15.71,1.07C14.6,1.07,13.5,1.22,12.44,1.52C12.41,1.53,12.38,1.54,12.35,1.55C10.02,2.25,7.96,3.68,6.23,5.72C6.03,5.95,5.84,6.19,5.66,6.43C4.38,8.13,3.53,10.08,3.16,12.15C3.14,12.27,3.12,12.39,3.11,12.51C3.07,12.77,3.05,13.03,3.05,13.29C3.05,13.45,3.05,13.61,3.06,13.77C3.09,14.18,3.14,14.58,3.2,14.98C3.21,15.02,3.21,15.06,3.22,15.1C3.73,18.39,5.63,21.25,8.54,23.01C8.69,23.1,8.84,23.18,9,23.26C9.05,23.29,9.1,23.32,9.15,23.35C9.18,23.37,9.21,23.39,9.24,23.41C10.46,24.06,11.76,24.4,13.1,24.49C13.19,24.5,13.28,24.5,13.37,24.51C13.53,24.52,13.69,24.53,13.85,24.53C13.97,24.53,14.09,24.53,14.21,24.53C16.68,24.53,19.04,23.75,21.04,22.33C21.23,22.19,21.41,22.04,21.58,21.88C22.82,20.71,23.75,19.31,24.29,17.76C24.31,17.7,24.33,17.64,24.35,17.58C24.81,16.12,25,14.58,25,12.99C25,12.92,25,12.85,25,12.78C24.94,10.21,24.08,7.8,22.58,5.74C22.16,5.17,21.7,4.64,21.2,4.15C21.14,4.09,21.08,4.03,21.02,3.97C20.83,3.74,20.63,3.51,20.42,3.29C20.37,3.23,20.32,3.18,20.29,3.09L20.29,3.09ZM10.57,18.1C9.62,18.1,8.84,17.32,8.84,16.37C8.84,15.42,9.62,14.64,10.57,14.64C11.52,14.64,12.3,15.42,12.3,16.37C12.31,17.32,11.53,18.1,10.57,18.1ZM16.43,18.1C15.48,18.1,14.7,17.32,14.7,16.37C14.7,15.42,15.48,14.64,16.43,14.64C17.38,14.64,18.16,15.42,18.16,16.37C18.16,17.32,17.38,18.1,16.43,18.1Z"/>
                            </svg>
                            <span>Join Discord</span>
                        </a>
                        <a href="https://chat.whatsapp.com/Gl6OT8i4DWyGnVv93Cjx1Y" target="_blank" class="flex items-center justify-center gap-3 px-6 py-3 rounded-lg bg-green-500 hover:bg-green-600 text-white font-semibold shadow-md transition-transform transform hover:scale-105 w-full sm:w-auto">
                            <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> <!-- Slightly larger icon -->
                                <path d="M12.04,2A10.02,10.02,0,0,0,2,12.04a10.02,10.02,0,0,0,10.04,10.02A10.02,10.02,0,0,0,22.06,12.04,10.02,10.02,0,0,0,12.04,2Zm0,18.1A8.07,8.07,0,0,1,3.96,12.04,8.07,8.07,0,0,1,12.04,3.96,8.07,8.07,0,0,1,20.12,12.04,8.07,8.07,0,0,1,12.04,20.12ZM17.46,14.85A4.54,4.54,0,0,0,16.65,14c-.27-.14-1.53-.75-1.76-.84s-.39-.13-.56.13-.67.84-.82,1-.29.19-.55,0a6.49,6.49,0,0,1-1.77-.93,7.13,7.13,0,0,1-1.26-1.52c-.14-.24,0-.38.11-.51s.24-.29.36-.43a1.69,1.69,0,0,0,.24-.42.41.41,0,0,0-.05-.38c-.06-.13-.56-1.34-.76-1.84s-.39-.42-.56-.43h-.48a.93.93,0,0,0-.67.31,2.84,2.84,0,0,0-.9,2.1,4.9,4.9,0,0,0,1,2.95,7.76,7.76,0,0,0,3.52,3.09,6.72,6.72,0,0,0,1.19.42,2.61,2.61,0,0,0,1.3.08,2.09,2.09,0,0,0,1.39-.94c.22-.29.22-.55.16-.84S17.73,15,17.46,14.85Z"/>
                            </svg>
                            <span>Chat on WhatsApp</span>
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="w-full bg-white dark:bg-neutral-800 border-t border-neutral-200 dark:border-neutral-700 py-8 mt-12">
            <div class="container mx-auto px-4 lg:px-8 text-center text-neutral-500 dark:text-neutral-400">
                <div class="flex justify-center space-x-6 mb-4">
                    <a href="https://discord.gg/7FWvfABUwz" target="_blank" aria-label="Discord" class="hover:text-red-500 dark:hover:text-red-500">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.29,3.09C19.23,2.38,18.09,1.76,16.88,1.26C16.73,1.21,16.57,1.17,16.41,1.14C16.22,1.1,16.03,1.08,15.83,1.07C15.79,1.07,15.75,1.07,15.71,1.07C14.6,1.07,13.5,1.22,12.44,1.52C12.41,1.53,12.38,1.54,12.35,1.55C10.02,2.25,7.96,3.68,6.23,5.72C6.03,5.95,5.84,6.19,5.66,6.43C4.38,8.13,3.53,10.08,3.16,12.15C3.14,12.27,3.12,12.39,3.11,12.51C3.07,12.77,3.05,13.03,3.05,13.29C3.05,13.45,3.05,13.61,3.06,13.77C3.09,14.18,3.14,14.58,3.2,14.98C3.21,15.02,3.21,15.06,3.22,15.1C3.73,18.39,5.63,21.25,8.54,23.01C8.69,23.1,8.84,23.18,9,23.26C9.05,23.29,9.1,23.32,9.15,23.35C9.18,23.37,9.21,23.39,9.24,23.41C10.46,24.06,11.76,24.4,13.1,24.49C13.19,24.5,13.28,24.5,13.37,24.51C13.53,24.52,13.69,24.53,13.85,24.53C13.97,24.53,14.09,24.53,14.21,24.53C16.68,24.53,19.04,23.75,21.04,22.33C21.23,22.19,21.41,22.04,21.58,21.88C22.82,20.71,23.75,19.31,24.29,17.76C24.31,17.7,24.33,17.64,24.35,17.58C24.81,16.12,25,14.58,25,12.99C25,12.92,25,12.85,25,12.78C24.94,10.21,24.08,7.8,22.58,5.74C22.16,5.17,21.7,4.64,21.2,4.15C21.14,4.09,21.08,4.03,21.02,3.97C20.83,3.74,20.63,3.51,20.42,3.29C20.37,3.23,20.32,3.18,20.29,3.09L20.29,3.09ZM10.57,18.1C9.62,18.1,8.84,17.32,8.84,16.37C8.84,15.42,9.62,14.64,10.57,14.64C11.52,14.64,12.3,15.42,12.3,16.37C12.31,17.32,11.53,18.1,10.57,18.1ZM16.43,18.1C15.48,18.1,14.7,17.32,14.7,16.37C14.7,15.42,15.48,14.64,16.43,14.64C17.38,14.64,18.16,15.42,18.16,16.37C18.16,17.32,17.38,18.1,16.43,18.1Z"/>
                        </svg>
                    </a>
                    <a href="https://chat.whatsapp.com/Gl6OT8i4DWyGnVv93Cjx1Y" target="_blank" aria-label="WhatsApp" class="hover:text-green-500 dark:hover:text-green-500">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.04,2A10.02,10.02,0,0,0,2,12.04a10.02,10.02,0,0,0,10.04,10.02A10.02,10.02,0,0,0,22.06,12.04,10.02,10.02,0,0,0,12.04,2Zm0,18.1A8.07,8.07,0,0,1,3.96,12.04,8.07,8.07,0,0,1,12.04,3.96,8.07,8.07,0,0,1,20.12,12.04,8.07,8.07,0,0,1,12.04,20.12ZM17.46,14.85A4.54,4.54,0,0,0,16.65,14c-.27-.14-1.53-.75-1.76-.84s-.39-.13-.56.13-.67.84-.82,1-.29.19-.55,0a6.49,6.49,0,0,1-1.77-.93,7.13,7.13,0,0,1-1.26-1.52c-.14-.24,0-.38.11-.51s.24-.29.36-.43a1.69,1.69,0,0,0,.24-.42.41.41,0,0,0-.05-.38c-.06-.13-.56-1.34-.76-1.84s-.39-.42-.56-.43h-.48a.93.93,0,0,0-.67.31,2.84,2.84,0,0,0-.9,2.1,4.9,4.9,0,0,0,1,2.95,7.76,7.76,0,0,0,3.52,3.09,6.72,6.72,0,0,0,1.19.42,2.61,2.61,0,0,0,1.3.08,2.09,2.09,0,0,0,1.39-.94c.22-.29.22-.55.16-.84S17.73,15,17.46,14.85Z"/>
                        </svg>
                    </a>
                </div>
                <p>&copy; {{ date('Y') }} Laravel Uganda Community. All rights reserved.</p>
            </div>
        </footer>

    </body>
</html>
