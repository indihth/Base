<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- loops through all tv shows, displaying the title and descriptions --}}
            @forelse ($tvshows as $tvshow)

            {{-- styling isn't working within loop --}}
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        {{ $tvshow->title }}
                    </h2>
                    <p class="mt-2">
                        {{-- limits description to displaying only 200 characters --}}
                        {{ Str::limit($tvshow->description, 200) }}
                    </p>
                    <span class="block mt-4 text-sm opacity-70">{{ $tvshow->updated_at->diffForHumans() }}</span>
                </div>
                
            {{-- if the above loop is empty the following paragraph will be displayed --}}
            @empty
            <p>No TV Shows added yet.</p>
            @endforelse

            {{ $tvshows->links() }}
        </div>
    </div>
</x-app-layout>
