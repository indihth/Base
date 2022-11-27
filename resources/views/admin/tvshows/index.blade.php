<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

        {{-- routes to the create form --}}
        <a href="{{ route('admin.tvshows.create') }}" class="btn-link btn-lg mb-2">+ New TV Show</a>

            {{-- loops through all tv shows, displaying the title and descriptions --}}
            @forelse ($tvshows as $tvshow)

                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{-- Makes tvshow titles into links, passing the tvshow id into URL --}}
                       <a href="{{ route('admin.tvshows.show', $tvshow) }}">{{ $tvshow->title }}</a> 
                    </h2>
                    <p class="mt-2">
                        <strong>Network: {{ $tvshow->network->title }} </strong>
                    </p>
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

            {{-- page links generate from using pagination --}}
            {{ $tvshows->links() }}
        </div>
    </div>
</x-app-layout>
