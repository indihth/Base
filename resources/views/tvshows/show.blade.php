<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- displays when note was created and updated, css needed --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex ">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $tvshow->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $tvshow->updated_at->diffForHumans() }}
                </p>
            </div>


            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{ $tvshow->title }}
                </h2>

                {{-- NOT WORKING: whitespace-pre-wrap preserves the returns and spacing in the note text --}}
                <p class="mt-6 whitespace-pre-wrap">{{ $tvshow->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
