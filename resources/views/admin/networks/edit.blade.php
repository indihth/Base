<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.networks.update', $network) }}" method="post">

                    {{-- Laravel resource controller update uses method PUT/PATCH but HTML can't use either so we 
                    need to spoof it by adding the @method('put') in the form by adding a hidden input field --}}
                    @method('put')

                    @csrf

                    {{-- :value fills the field with the existing network value and retains the edited value if validation fails --}}
                    <x-text-input type="text" name="title" field="title" :value="@old('title', $network->title)" placeholder="Title"
                        class="w-full" autocomplete="off"></x-text-input>

                    {{-- 'value' is used to retain user input after error message from other fields
                        :colon needed to pass in a Blade value --}}
                    <x-text-input type="text" name="manager" field="manager" :value="@old('manager', $network->manager)"
                        placeholder="Manager" class="" autocomplete="off"></x-text-input>
                    <x-text-input type="text" name="location" field="location" :value="@old('location', $network->location)"
                        placeholder="Location" class="w-full" autocomplete="off"></x-text-input>

                
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
