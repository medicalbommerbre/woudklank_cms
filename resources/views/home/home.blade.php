<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                    onclick="window.location.href='{{ url('/home/create') }}'">
                Maak een nieuw home item aan
            </button>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home') }} 
            </h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                    onclick="window.location.href='{{ url('/home/preview') }}'">
                Bekijk preview
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
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-left">
                        <th class="py-5 px-4 border-b">Prioriteit</th>
                        <th class="py-5 px-4 border-b">Titel</th>
                        <th class="py-5 px-4 border-b">Content</th>
                        <th class="py-5 px-4 border-b">Status</th>
                        <th class="py-5 px-4 border-b">Knop</th>
                        <th class="py-5 px-4 border-b">Naam knop</th>
                        <th class="py-5 px-4 border-b text-center">Kleuren</th> 
                        <th class="py-5 px-4 border-b">Bewerken</th>
                        <th class="py-5 px-4 border-b">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($home as $home1)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-5 px-4 border-b text-white">{{ $home1->order }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $home1->title }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $home1->content }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $home1->status }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $buttonLabels[$home1->button] ?? 'Geen knop' }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $home1->button_alt }}</td>
                
                
                            <td class="py-5 px-4 border-b text-center">
                                <div class="inline-block">
                                    <div class="w-6 h-6 rounded border border-gray-300 inline-block cursor-pointer"
                                        style="background-color: {{ $home1->colour_background  }};"
                                        title="Achtergrond: {{ $home1->colour_background  }}"></div>
                                </div>
                                <div class="inline-block">
                                    <div class="w-6 h-6 rounded border border-gray-300 inline-block cursor-pointer"
                                        style="background-color: {{ $home1->colour_text  }};"
                                        title="Tekst: {{ $home1->colour_text  }}"></div>
                                </div>
                                <div class="inline-block">
                                    <div class="w-6 h-6 rounded border border-gray-300 inline-block cursor-pointer"
                                        style="background-color: {{ $home1->colour_button  }};"
                                        title="Knop: {{ $home1->colour_button  }}"></div>
                                </div>
                            </td>
                
                            <td class="py-5 px-4 border-b text-white">
                                <a href="{{ route('home.edit', ['home' => $home1->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                            </td>
                            <td class="py-5 px-4 border-b text-white">
                                <form action="{{ route('home.destroy', ['home' => $home1->id]) }}" method="POST">
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
