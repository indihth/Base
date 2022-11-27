<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.tvshows.update', $tvshow) }}" method="post">

                    {{-- Laravel resource controller update uses method PUT/PATCH but HTML can't use either so we 
                    need to spoof it by adding the @method('put') in the form by adding a hidden input field --}}
                    @method('put')

                    @csrf

                    {{-- :value fills the field with the existing tvshow value and retains the edited value if validation fails --}}
                    <x-text-input type="text" name="title" field="title" :value="@old('title', $tvshow->title)" placeholder="Title"
                        class="w-full" autocomplete="off"></x-text-input>

                    <x-textarea name="description" rows="10" field="description" :value="@old('description', $tvshow->description)"
                        placeholder="Start typing here..." class="w-full mt-6"></x-textarea>

                    <x-text-input type="text" name="director" field="director" :value="@old('director', $tvshow->director)"
                        placeholder="Director" class="" autocomplete="off"></x-text-input>

                    <x-text-input type="text" name="release_date" field="release_date" :value="@old('release_date', $tvshow->release_date)"
                        placeholder="Release Date" class="" autocomplete="off"></x-text-input>

                    <x-text-input type="number" name="rating" field="rating" :value="@old('rating', $tvshow->rating)" placeholder="Rating"
                        class="" autocomplete="off"></x-text-input>

                    <x-text-input type="number" name="difficulty" field="difficulty" :value="@old('difficulty', $tvshow->difficulty)"
                        placeholder="Difficulty" class="" autocomplete="off"></x-text-input>

                
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
