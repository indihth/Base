<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Network') }}
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
                <p class="opacity-70">
                    <strong>Created: </strong> {{ $network->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70 ml-8">
                    <strong>Updated: </strong> {{ $network->updated_at->diffForHumans() }}
                </p>

                {{-- Edit network button --}}
                <a href="{{ route('admin.networks.edit', $network) }}" class="btn-link ml-auto">Edit Network</a>
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
</x-app-layout>
