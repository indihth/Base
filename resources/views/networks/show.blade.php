<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Networks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- displays when network was created and updated, css needed --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- flash alter to confirm update --}}
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex ">
                {{-- <p class="opacity-70">
                    <strong>Created: </strong> {{ $network->created_at->diffForHumans() }}
                </p> --}}
                {{-- <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $network->updated_at->diffForHumans() }}
                </p> --}}
            </div>


            {{-- <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-2xl">
                    {{ $networkShows->network_id }}
                </h2> --}}

                {{-- <p class="mt-6 whitespace-pre-wrap">Director: {{ $network->director }}</p> --}}
                {{-- <p class="mt-6 whitespace-pre-wrap">Network: {{ $network->title }}</p> --}}
                {{-- <p class="mt-6 whitespace-pre-wrap">Release Date: {{ $network->release_date }}</p>
                <p class="mt-6 whitespace-pre-wrap">Rating: {{ $network->rating }}</p>
                <p class="mt-6 whitespace-pre-wrap">Difficulty: {{ $network->difficulty }}</p>
                <p class="mt-6 whitespace-pre-wrap">Description: {{ $network->description }}</p> --}}

                {{-- loops through all tv shows, displaying the title and descriptions --}}
                @forelse ($networkShows as $tvshow)
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <h2 class="font-bold text-2xl">
                            {{-- Makes tvshow titles into links, passing the tvshow id into URL --}}
                            <a href="{{ route('tvshows.show', $tvshow) }}">{{ $tvshow->title }}</a>
                        </h2>
                        <p class="mt-2">
                            {{-- limits description to displaying only 200 characters --}}
                            {{ Str::limit($tvshow->description, 200) }}
                        </p>
                        {{-- displays the updated time in a more readable way --}}
                        <span class="block mt-4 text-sm opacity-70">{{ $tvshow->updated_at->diffForHumans() }}</span>
                    </div>

                    {{-- if the above loop is empty the following paragraph will be displayed --}}
                @empty
                    <p>No TV Shows added yet.</p>
                @endforelse

            </div>
        {{-- </div> --}}
    </div>
</x-app-layout>
