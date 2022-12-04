<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            TV Shows in <strong>{{ $network->title }}</strong> Network
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- displays when network was created and updated, css needed --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

              {{-- Delete tvshow button, needs to be form --}}
              <form action="{{ route('admin.tvshows.multiDestroy', $network) }}" method="post">

                {{-- HTML can't use delete method, @method needed --}}
                @method('delete')

                {{-- csrf token --}}
                @csrf

                <button type="submit" class="btn btn-danger ml-4"
                    onclick="confirm('Are you sure you want to delete these TV Shows?')">Delete TV Shows</button>
            </form>

                {{-- loops through all tv shows, displaying the title and descriptions --}}
                @forelse ($networkShows as $tvshow)
                    <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                        <h2 class="font-bold text-2xl">
                            {{-- Makes tvshow titles into links, passing the tvshow id into URL --}}
                            <a href="{{ route('admin.tvshows.show', $tvshow) }}">{{ $tvshow->title }}</a>
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