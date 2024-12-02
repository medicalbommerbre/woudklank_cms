<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('Maak een evenement aan')}}
            </h2>
        
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left"
                    onclick="window.location.href='{{ url("/events") }}'">
                Terug
            </button>
        </div>
    </x-slot>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 4000); 
    

            setTimeout(function() {
                var errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 4000); 
        });
    </script>
 
        <form method="POST" action="{{ route('event.store') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="event_title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Evenement naam</label>
                <input type="text" name="event_title" id="event_title" placeholder="Naam"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="event_description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Beschrijving</label>
                <textarea name="event_description" id="event_description" placeholder="Beschrijving"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label for="event_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Datum</label>
                <input type="date" name="event_date" id="event_date" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="event_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tijdstip</label>
                <input type="time" name="event_time" id="event_time" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Locatie</label>
                <input type="text" name="location" id="location" placeholder="Locatie"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="image_path" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Foto*</label>
                <input type="file" name="image_path" id="image_path" 
                       class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <input type="submit" value="Maak een nieuw event aan"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </form>
    </div>
</x-app-layout>
