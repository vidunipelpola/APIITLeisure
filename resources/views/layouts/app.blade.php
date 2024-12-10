<!-- resources/views/layouts/app.blade.php -->
@props(['title' => 'Default Title'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="../images/logo.png">
        <title>{{ $title ?? 'Default Title' }}</title> 

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Scripts (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased overflow-x-hidden" style="background-color: #000000; font-family:Georgia;">
        <div class="min-h-screen bg-transparent w-full">
            <!-- Include Navigation Bar -->
            @include('layouts.navigation')

            <!-- Notification Popup -->
            <div x-data="notificationPopup()" x-init="checkNotifications()" class="fixed top-4 right-4 z-50">
                <template x-if="showPopup">
                    <div class="bg-amber-100 rounded-lg shadow-xl p-4 max-w-sm w-full border-l-4 border-amber-500" 
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 transform translate-y-2" 
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         style="background-color: rgb(254 243 199);">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center">
                                <h3 class="text-lg font-semibold text-amber-900" x-text="currentNotification.title"></h3>
                            </div>
                            <button @click="dismissNotification" class="text-amber-500 hover:text-amber-600">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="text-amber-900 font-medium text-base whitespace-pre-line" x-text="currentNotification.message"></div>
                        <div class="mt-3 flex justify-end">
                            <button @click="dismissNotification" class="text-sm text-amber-700 hover:text-amber-800 font-medium">
                                Got it
                            </button>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-[#1E1E1E] shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <!-- Footer -->
            @include('layouts.footer') 
        </div>
    </body>
</html>
