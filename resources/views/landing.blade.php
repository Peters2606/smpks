<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom styles for a more professional look */
        .hero-gradient {
            background: linear-gradient(135deg, #4a00e0 0%, #8e2de2 100%); /* Deeper purple gradient */
        }
        .btn-primary {
            background-color: #6366f1; /* Indigo 500 */
            color: white;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary:hover {
            background-color: #4f46e5; /* Indigo 600 */
            transform: translateY(-2px);
        }
        .btn-secondary {
            background-color: white;
            color: #6366f1;
            border: 1px solid #6366f1;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.2s ease;
        }
        .btn-secondary:hover {
            background-color: #6366f1;
            color: white;
            transform: translateY(-2px);
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="text-3xl font-extrabold text-gray-800 tracking-tight">SMPKS</a>
                </div>
                <nav class="space-x-6">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Login</a>
                        {{-- Register link is still available in header if needed --}}
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow flex items-center justify-center hero-gradient text-white py-24 px-4">
            <div class="text-center max-w-5xl">
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6 drop-shadow-lg">
                    Manajemen Kontrak yang Cerdas dan Efisien
                </h1>
                <p class="text-xl md:text-2xl mb-12 opacity-90 leading-relaxed">
                    Transformasi cara Anda mengelola perjanjian kerja sama. Pantau status, kelola persetujuan, dan dapatkan notifikasi penting dalam satu platform intuitif.
                </p>
                <div class="flex justify-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary py-4 px-10 rounded-full text-xl font-semibold shadow-xl transition duration-300 transform hover:scale-105">
                            Lihat Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary py-4 px-10 rounded-full text-xl font-semibold shadow-xl transition duration-300 transform hover:scale-105">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </main>

        <!-- Features Section -->
        <section class="py-20 bg-gray-50 px-4">
            <div class="max-w-7xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-16 text-gray-800">Solusi Lengkap untuk Kebutuhan Anda</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="feature-card p-8 bg-white rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                        <div class="text-indigo-600 mb-6">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Manajemen Kontrak Terpusat</h3>
                        <p class="text-gray-600 leading-relaxed">Catat, lacak, dan kelola semua perjanjian kerja sama Anda dari satu platform yang mudah diakses dan terorganisir.</p>
                    </div>
                    <div class="feature-card p-8 bg-white rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                        <div class="text-indigo-600 mb-6">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Alur Persetujuan Dinamis</h3>
                        <p class="text-gray-600">Sistem persetujuan multi-level yang fleksibel untuk Legal dan Marketing, dengan opsi pembatalan dalam batas waktu.</p>
                    </div>
                    <div class="feature-card p-8 bg-white rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
                        <div class="text-indigo-600 mb-6">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-gray-800">Notifikasi Kontrak Berakhir</h3>
                        <p class="text-gray-600">Dapatkan peringatan dini untuk kontrak yang akan segera berakhir dan pantau statusnya secara langsung.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Removed Call to Action Section --}}

        <!-- Footer -->
        <footer class="bg-gray-900 text-gray-400 py-8 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'SMPKS') }}. All rights reserved.</p>
            <div class="mt-4 text-sm">
                <a href="#" class="hover:text-white mx-2">Kebijakan Privasi</a>
                <span class="mx-2">|</span>
                <a href="#" class="hover:text-white mx-2">Syarat & Ketentuan</a>
            </div>
        </footer>
    </div>
</body>
</html>