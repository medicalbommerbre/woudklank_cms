<x-preview-component>
    @section('existing-content')
        <!-- Hero Section -->
        <section class="relative w-full h-[75vh] bg-cover bg-center flex items-center justify-center text-center text-white" style="background-image: url('/assets/images/blau1.jpg');">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <div class="relative max-w-2xl">
                <h1 class="text-5xl font-extrabold text-cyan-200 mb-4">Welkom bij De Woudklank Schildwolde</h1>
                <p class="text-lg text-gray-300">Een passie voor brassmuziek, een gemeenschap van muzikanten.</p>
                <a href="" class="mt-6 inline-block bg-cyan-500 text-white py-3 px-6 rounded-lg text-lg font-bold hover:bg-cyan-600 transition">Bekijk onze agenda</a>
            </div>
        </section>
        @endsection

        @foreach ($home as $home1)
        <section class="relative w-full py-16 text-center" 
            style="background-color: {{ $home1->colour_background}}; color: {{ $home1->colour_text}};">
            
          
            <h2 class="text-4xl font-extrabold mb-4" 
                style="color: {{ $home1->colour_text }};">
                {{ $home1->title }}
            </h2>
    
            <p class="text-lg max-w-2xl mx-auto" 
                style="filter: brightness(1.2); color: {{ $home1->colour_text }};">
                {{ $home1->content }}
            </p>
     
            @if (!empty($home1->button))
                <a href="" 
                   class="mt-6 inline-block py-3 px-6 rounded-lg font-bold hover:bg-gray-200 transition"
                   style="background-color: {{ $home1->colour_text }}; color: {{ $home1->colour_background}};">
                   {{ $home1->button_alt}}
                </a>
            @endif
        </section>
    @endforeach
</x-preview-component>
