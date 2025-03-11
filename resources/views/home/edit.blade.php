<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('Edit home item')}} 
                {{__('LET OP! word inactief na een wijziging')}} 
            </h2>
        
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left"
                    onclick="window.location.href='{{ url('/home')}}'">
                Terug
            </button>
        </div>
    </x-slot>
    @php
        $buttonLabels = [
            'nieuws.nieuws' => 'Nieuws',
            'contact.contact' => 'Contact',
            'fotoboek.fotoboek' => 'Fotoboek',
            'over.over' => 'Over ons',
            'events.event' => 'Agenda',
            'index' => 'Home',
        ];
    @endphp
    
    <script src="{{ asset('/js/bootstrap.js') }} "></script>
    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
      
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
        <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
            <form method="POST" action="{{route('home.update',['home'=> $home])}}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            @method('PUT')
            

            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Titel</label>
                <input type="text" name="title" id="title"  value="{{ $home->title }}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Inhoud</label>
                <input type="text" name="content" id="content" value="{{ $home->content}}"
                       class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="button" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Knopje</label>
                <select name="button" id="button" 
                    class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="{{ $home->button}}">{{ $buttonLabels[$home->button] ?? 'Geen knop' }}</option>
                    <option value="">Geen knop</option>
                    <option value="nieuws.nieuws">Nieuws</option>
                    <option value="contact.contact">Contact</option>
                    <option value="fotoboek.fotoboek">Fotoboek</option>
                    <option value="over.over">Over ons</option>
                    <option value="events.event">Agenda</option>
                    <option value="index">Home</option>
    
                </select>
            </div>
            <div class="mb-4">
                <label for="button_alt" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Knop naam</label>
                <input type="text" name="button_alt" id="order" value="{{ $home->button_alt}}"
                       class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class=" mb-4 flex space-x-6 items-center">
                <div class="flex flex-col items-center">
                    <label for="colour_background" class="text-gray-700 dark:text-gray-300 font-bold mb-2">Achtergrondkleur</label>
                    <input type="color" name="colour_background" id="colour_background" value="{{ $home->colour_background}}"
                           class="w-16 h-10 border-0 focus:ring-2 focus:ring-blue-500">
                </div>
            
                <div class="flex flex-col items-center">
                    <label for="colour_text" class="text-gray-700 dark:text-gray-300 font-bold mb-2">Tekstkleur</label>
                    <input type="color" name="colour_text" id="colour_text" value="{{ $home->colour_text}}"
                           class="w-16 h-10 border-0 focus:ring-2 focus:ring-blue-500">
                </div>
            
                <div class="flex flex-col items-center">
                    <label for="colour_button" class="text-gray-700 dark:text-gray-300 font-bold mb-2">Knopkleur</label>
                    <input type="color" name="colour_button" id="colour_button" value="{{ $home->colour_button}}"
                           class="w-16 h-10 border-0 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div class="mt-4 flex items-center">
                <label for="preset_colour_palette" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Kies een preset kleur:</label>
                <select id="preset_colour_palette" name="preset_colour_palette" class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Kies een preset</option>
                    <option data-color1="#ffffff" data-color2="#1f2937" data-color3="#1f2937">Wit</option>
                    <option data-color1="#0e7490" data-color2="#FFFFFF" data-color3="#006C6C">Aqua</option>
                    
                    @foreach ($home2 as $home1)
                    <option data-color1="{{ $home1->colour_background }}" data-color2="{{ $home1->colour_text }}" data-color3="{{ $home1->colour_button  }}">
                        {{ $home1->title}}
                    </option>
                @endforeach
                </select>
                
            </div>


            
            
            <script>

                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('preset_colour_palette').addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];

                        // Debugging: Check the selected option
                        console.log("Selected Option: ", selectedOption);

                        var selectedColor1 = selectedOption.getAttribute('data-color1');
                        var selectedColor2 = selectedOption.getAttribute('data-color2');
                        var selectedColor3 = selectedOption.getAttribute('data-color3');

                        console.log('Selected Color 1:', selectedColor1);
                        console.log('Selected Color 2:', selectedColor2);
                        console.log('Selected Color 3:', selectedColor3);

                        if (selectedColor1 && selectedColor2 && selectedColor3) {
                            document.getElementById('colour_background').value = selectedColor1;
                            document.getElementById('colour_text').value = selectedColor2;
                            document.getElementById('colour_button').value = selectedColor3;
                        } else {
                            console.log('One or more colors are missing.');
                        }
                    });
                });


            </script>
        
            
            <div class="mb-4">
                <label for="order" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Prioriteitsnummer</label>
                <input type="text" name="order" id="order" value="{{ $home->order}}"
                       class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <input type="submit" value="Update home item"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </form>
    </div>
</x-app-layout>
