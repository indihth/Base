<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Networks') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            {{-- Flash messages from 'Laracast Easy Flash Messages'--}}
            @include('flash::message')

            {{-- routes to the create form --}}
            <a href="{{ route('admin.networks.create') }}" class="btn-link btn-lg mb-2">+ New Network</a>

            {{-- loops through all tv shows, displaying the title and descriptions --}}
            @foreach ($networks as $network)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('admin.networks.show', $network) }}">{{ $network->title }}</a>
                    </h2>
                    <p class="mt-2">
                        {{ $network->manager }}
                    </p>
                    <p class="mt-2">
                        {{ $network->location }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
