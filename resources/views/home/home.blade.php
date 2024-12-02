<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Homepage') }} 
            </h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-left" 
                    onclick="window.location.href='{{ url("/home/create") }}'">
                Voeg een home item toe
            </button>
        </div>
    </x-slot>
        <div class="p-5 h-screen bg-gray-100 dark:bg-gray-900">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-left">
                            <th class="py-5 px-4 border-b">Prioriteit</th>
                            <th class="py-5 px-4 border-b">Titel</th>
                            <th class="py-5 px-4 border-b">Type</th>
                            <th class="py-5 px-4 border-b">Foto</th>
                            <th class="py-5 px-4 border-b">Inhoud</th>
                            <th class="py-5 px-4 border-b">Gemaakt op</th>
                            <th class="py-5 px-4 border-b">Geupdated op</th>
                            <th class="py-5 px-4 border-b">Bewerken</th>
                            <th class="py-5 px-4 border-b">Verwijderen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($home as $home)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="py-5 px-4 border-b text-white">{{ $home->order }}</td>
                                <td class="py-5 px-4 border-b text-white">{{ $home->title }}</td>
                                <td class="py-5 px-4 border-b text-white">{{ $home->type }}</td>
                                <td class="py-5 px-4 border-b text-white">
                                    <img src="{{ asset($home->foto_path) }}" alt="Geen foto" >
                                </td>
                                <td class="py-5 px-4 border-b text-white">{{ $home->content }}</td>
                             
                                <td class="py-5 px-4 border-b text-white">{{ $home->created_at }}</td>
                                <td class="py-5 px-4 border-b text-white">{{ $home->updated_at }}</td>
                                <td class="py-5 px-4 border-b text-white">
                                    <a href="{{ route('home.edit', ['home' => $home->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                                </td>
                                
                                <td class="py-5 px-4 border-b text-white">
                                    <form action="{{ route('home.destroy', ['home' => $home->id]) }}" method="POST">
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
