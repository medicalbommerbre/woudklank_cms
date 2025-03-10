<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Brass Band' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">
    
    <section class=" sticky top-0 z-50  bg-yellow-300 text-gray-900 py-4 px-6 mb-6 border-4 border-dashed border-gray-500">
        <h2 class="text-2xl font-semibold">Preview Mode, let op de knoppen werken niet</h2>
        <p class="mb-4">Je bekijkt nu je veranderingen, klik op tevreden als je tevreden bent en op niet tevreden als je niet tevreden bent. </p>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href='{{ url('/home/confirm') }}'">Tevreden
        </button>
        <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href='{{ url('/home/cancel') }}'">Nog niet tevreden
        </button>
    
           
        
    </section>


    <header class="bg-gray-900 text-white py-6 shadow-lg top-1">
        
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-6">
            <h1 class="text-3xl font-bold text-cyan-200">
                <a href="">De Woudklank Schildwolde</a>
            </h1>
        
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex flex-wrap items-center space-x-4 md:space-x-6 mt-4 md:mt-0">
                <a href="" class="hover:text-cyan-200">Over ons</a>
                <a href="" class="hover:text-cyan-200">Agenda</a>
                <a href="" class="hover:text-cyan-200">Nieuws</a>
                <a href="" class="hover:text-cyan-200">Contact</a> 
                <a href="" class="hover:text-cyan-200">Fotoboek</a> 
                
            </nav>

            <!-- Mobile Menu -->
            <div class="md:hidden" id="mobile-menu" class="hidden">
                <nav class="flex flex-col items-center mt-4">
                    <a href="" class="hover:text-cyan-200 py-2">Over ons</a>
                    <a href="" class="hover:text-cyan-200 py-2">Agenda</a>
                    <a href="" class="hover:text-cyan-200 py-2">Nieuws</a>
                    <a href="" class="hover:text-cyan-200 py-2">Contact</a>
                    <a href="" class="hover:text-cyan-200">Fotoboek</a> 
                </nav>
            </div>
        </div>
    </header>
    <main class="flex-grow">
    
        <!-- Existing Content -->
        <section class="relative w-full">
            @yield('existing-content')
        </section>
    
        <!-- Additional Content -->
        <section class="relative w-full bg-cover bg-center">
            {{ $slot }}
        </section>
    </main>
    

    <footer class="bg-gray-900 text-white text-center py-6 mt-auto">
        <h2 class="text-2xl font-bold text-yellow-400"></h2>
        <p class="text-sm md:text-base text-gray-400">
            2025, de Woudklank
        </p>
    </footer>

    <script>

        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
