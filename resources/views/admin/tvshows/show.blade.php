<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- displays when tvshow was created and updated, css needed --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- flash alter to confirm update --}}
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex ">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $tvshow->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $tvshow->updated_at->diffForHumans() }}
                </p>

                {{-- Edit tvshow button --}}
                <a href="{{ route('admin.tvshows.edit', $tvshow) }}" class="btn-link ml-auto">Edit TV Show</a>

                {{-- NEED TO REMOVE ACTOR FROM TV SHOW BEFORE DELETE --}}
                
                {{-- Delete tvshow button, needs to be form --}}
                <form action="{{ route('admin.tvshows.destroy', $tvshow) }}" method="post">

                    {{-- HTML can't use delete method, @method needed --}}
                    @method('delete')

                    {{-- csrf token --}}
                    @csrf

                    <button type="submit" class="btn btn-danger ml-4"
                        onclick="confirm('Are you sure you want to delete this TV Show?')">Delete TV Show</button>
                </form>
            </div>


            <div class="container my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="row">
                    <h2 class="font-bold text-2xl">
                        {{ $tvshow->title }}
                    </h2>
                </div>
                <p>
                    {{-- displays the image from by using the symbolic storage link --}}
                    <img src="{{ asset('storage/images/' . $tvshow->image) }}" width="150">
                </p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Director:</strong> {{ $tvshow->director }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Network:</strong> {{ $tvshow->network->title }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Release Date: </strong>{{ $tvshow->release_date }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Rating: </strong>{{ $tvshow->rating }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Difficulty: </strong>{{ $tvshow->difficulty }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Description: </strong>{{ $tvshow->description }}</p>

                <p class="mt-6 whitespace-pre-wrap"><strong>Actors: </strong></p>

                @foreach ($tvshow->actors as $actor)
                    <p>{{ $actor->name }}</p>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
