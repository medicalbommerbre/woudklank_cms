<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Archief') }} 
            </h2>
            {{-- <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left" 
                    onclick="window.location.href='{{ url("/events/create") }}'">
                Maak nieuw event aan
            </button> --}}
        </div>
    </x-slot>
 

    <div class="p-5 h-screen bg-gray-100 dark:bg-gray-900">
  
        @if (session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
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
    
     
         
   

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-left">
                        <th class="py-5 px-4 border-b">Nummer</th>
                        <th class="py-5 px-4 border-b">Naam</th>
                        <th class="py-5 px-4 border-b">Beschrijving</th>
                        <th class="py-5 px-4 border-b">Datum</th>
                        <th class="py-5 px-4 border-b">Tijdstip</th>
                        <th class="py-5 px-4 border-b">Locatie</th>
                        <th class="py-5 px-4 border-b">Afbeelding</th>
                        <th class="py-5 px-4 border-b">Gemaakt op</th>
                        <th class="py-5 px-4 border-b">Geupdated op</th>
                        <th class="py-5 px-4 border-b">Bewerken</th>
                        <th class="py-5 px-4 border-b">Verwijderen</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-5 px-4 border-b text-white">{{ $event->id }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->event_title }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->event_description }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->event_date }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->event_time = date('H:i', strtotime($event->event_time))}}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->location }}</td>
                            <td class="py-5 px-4 border-b text-white">
                                <img src="{{ asset($event->image_path) }}" alt="Geen foto" >
                            </td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->created_at }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $event->updated_at }}</td>
                            <td class="py-5 px-4 border-b text-white">
                                <a href="{{ route('archive.edit', ['event' => $event->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                            </td>
                
                            
                            <td class="py-5 px-4 border-b text-white">
                                <form action="{{ route('archive.destroy', ['event' => $event->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE') 
                                    <input type="submit" value="Verwijderen" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                </form>
                            </td>
                            
                            
                        </tr>
                    @endforeach 
                    
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
