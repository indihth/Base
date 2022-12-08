<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Network') }}
        </h2>

    </x-slot>
    <div class="py-12">
        {{-- displays when network was created and updated, css needed --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @include('flash::message')


            <div class="flex ">
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $network->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $network->updated_at->diffForHumans() }}
                </p>

                {{-- Edit network button --}}
                <a href="{{ route('admin.networks.edit', $network) }}" class="btn-link ml-auto">Edit Network</a>

                {{-- Delete tvshow button, needs to be form --}}
                {{-- <form action="{{ route('admin.networks.destroy', $network) }}" method="post"> --}}

                {{-- HTML can't use delete method, @method needed --}}
                {{-- @method('delete') --}}

                {{-- csrf token --}}
                {{-- @csrf --}}

                @if ($networkShows->count() == 0)
                    {{-- Delete tvshow button, needs to be form --}}
                    <form action="{{ route('admin.networks.destroy', $network) }}" method="post">


                        <button type="submit" class="btn btn-danger ml-4"
                            onclick="confirm('Are you sure you want to delete this Network?')">Delete
                            Network</button>

                        {{-- HTML can't use delete method, @method needed --}}
                        @method('delete')

                        {{-- csrf token --}}
                        @csrf

                    </form>
                @else
                     {{-- Delete tvshow button, needs to be form --}}
                     <form action="{{ route('admin.networks.destroy', $network) }}" method="post">


                        <button type="submit" class="btn btn-danger ml-4"
                            onclick="confirm('Are you sure you want to delete this Network and TV Shows?')">Delete
                            Network and TV Shows</button>

                        {{-- HTML can't use delete method, @method needed --}}
                        @method('delete')

                        {{-- csrf token --}}
                        @csrf

                    </form>
                @endif

                {{-- <button type="submit" class="btn btn-danger ml-4" --}}
                {{-- onclick="confirm('Are you sure you want to delete this Network?')">Delete Network</button> --}}
                {{-- </form> --}}
            </div>


            <div class="container my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <div class="row">
                    <h2 class="font-bold text-2xl">
                        {{ $network->title }}
                    </h2>
                </div>
                <p class="mt-6 whitespace-pre-wrap"><strong>Manger:</strong> {{ $network->manager }}</p>
                <p class="mt-6 whitespace-pre-wrap"><strong>Location:</strong> {{ $network->location }}</p>
            </div>
        </div>
    </div>
    </div>

    {{-- scripts --}}
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script>
        $('#flash-overlay-modal').modal();
    </script>

</x-app-layout>
