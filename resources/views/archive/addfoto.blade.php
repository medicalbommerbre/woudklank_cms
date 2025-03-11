<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{__('Upload home item')}}
            </h2>
        
            <div class="flex justify-start">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" 
                    onclick="window.history.back();">
                    Terug
                </button>
            </div>
        </div>
    </x-slot>

    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <script src="{{ asset('/js/bootstrap.js') }}"></script>

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

        <form method="POST" action="{{ route('archive.fotostore') }}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            @csrf
            @method('POST')
      
      
            <div id="photo-section">
        
                <div class="mb-4 photo-input">
                    <label for="caption" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Caption</label>
                    <input type="text" name="caption[]" placeholder="Caption"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    
                    <label for="img" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Foto</label>
                    <input type="file" name="img[]" id="img"  
                        class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

   
                    <button type="button" class="text-red-500 hover:text-red-700 mt-2" onclick="removeNewPhotoSection(this)">Haal dit gedeelte weg</button>
                </div>
            </div>

            <div class="mb-4">
                <button type="button" id="add-more-photos" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Voeg nog een foto toe
                </button>
            </div>

            <input type="hidden" name="archived_event_id" id="archived_event_id" value="{{ request()->id }}">
         
            <div>
                <input type="submit" value="Upload foto's"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </form>
    </div>

    <script>

        function removeNewPhotoSection(button) {
            const section = button.closest('.photo-input');
            section.remove(); 
        }

        document.getElementById('add-more-photos').addEventListener('click', function() {
            const newSection = document.createElement('div');
            newSection.classList.add('mb-4', 'photo-input');
            newSection.innerHTML = `
                <label for="caption" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Caption</label>
                <input type="text" name="caption[]" placeholder="Caption"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <label for="img" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Foto</label>
                <input type="file" name="img[]" id="img"  
                    class="text-gray-700 dark:text-gray-300 dark:bg-gray-700 w-full py-2 px-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <button type="button" class="text-red-500 hover:text-red-700 mt-2" onclick="removeNewPhotoSection(this)">Haal dit gedeelte weg</button>
            `;
            document.getElementById('photo-section').appendChild(newSection); 
        });
    </script>
</x-app-layout>
