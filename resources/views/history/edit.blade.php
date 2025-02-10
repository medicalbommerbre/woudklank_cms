
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Bewerk geschiedenis item met titel:') }} {{$history->title}}
            </h2>
        
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-4" 
                    onclick=window.history.back();>
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

    
            
    @if (session('success'))
        <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @elseif (session('error'))
        <div id="error-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
        
             <form method="POST" action="{{route('history.update',['history'=> $history])}}" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">

            @csrf
            @method('PUT')
   
            <div class="mb-4">
                <label for="priority" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Prioriteit</label>
                <input type="numbers" name="priority" id="priority" value="{{ $history->priority}}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Titel</label>
                <input type="text" name="title" id="title" value="{{ $history->title}}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Beschrijving</label>
                <input type="text" name="description" id="description" value="{{ $history->description}}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="yearnumber" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Jaartal</label>
                <input type="integer" name="yearnumber" id="yearnumber" value="{{ $history->yearnumber}}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Datum</label>
                <input type="date" name="datum" id="datum" value="{{ $history->datum}}"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:text-gray-300 dark:bg-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <input type="submit" value="Update"
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
        </form>
    </div>
</x-app-layout>
