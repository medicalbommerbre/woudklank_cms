<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Home Fotos') }} 
            </h2>

            <div class="flex justify-start">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-4 rounded float-left"
                onclick="window.location.href='{{ url('/home/photos/' . request()->home . '/addphoto') }}'">
                    Voeg foto toe
                </button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                onclick="window.history.back();">
       
                   Terug
               </button>
        
            </div>

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
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-left">
                        <th class="py-5 px-4 border-b">ID</th>
                        <th class="py-5 px-4 border-b">Caption</th>
                        <th class="py-5 px-4 border-b">Foto</th>
                        <th class="py-5 px-4 border-b">Bewerken</th>
                        <th class="py-5 px-4 border-b">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($home as $homePhoto)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="py-5 px-4 border-b text-white">{{ $homePhoto->home_id }}</td>
                            <td class="py-5 px-4 border-b text-white">{{ $homePhoto->caption }}</td>
                            <td class="py-5 px-4 border-b text-white">
                                <img src="{{ asset( $homePhoto->photo_path) }}" alt="" class="w-20 h-20 rounded">
                            </td>
                            <td class="py-5 px-4 border-b text-white">
                                <a href="{{ route('homefoto.edit', ['home' => $homePhoto->home_id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Bewerken</a>
                            </td>
                            <td class="py-5 px-4 border-b text-white">
                                <form action="{{ route('homefoto.destroy', ['home' => $homePhoto->id]) }}" method="POST">
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
