<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TV Shows') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.tvshows.store') }}" method="post" enctype="multipart/form-data">
                    {{-- @csrf is used to generate a hidden field with a csrf token to validate the request is being made 
                        by an authorised user. Prevent outside attacks --}}
                    @csrf

                    {{-- if field doesn't pass validation an error message will show.
                        'field' value is used to display error from the component file --}}
                    <x-text-input type="text" name="title" field="title" :value="@old('title')" placeholder="Title"
                        class="w-full" autocomplete="off"></x-text-input>

                    {{-- 'value' is used to retain user input after error message from other fields
                        :colon needed to pass in a Blade value --}}
                    <x-textarea name="description" rows="10" field="description" :value="@old('description')"
                        placeholder="Start typing here..." class="w-full mt-6"></x-textarea>

                    <x-text-input type="text" name="director" field="director" :value="@old('director')"
                        placeholder="Director" class="" autocomplete="off"></x-text-input>
                    <x-text-input type="date" name="release_date" field="release_date" :value="@old('release_date')"
                        placeholder="Release Date" class="w-full" autocomplete="off"></x-text-input>
                    <x-text-input type="number" name="rating" field="rating" :value="@old('rating')" placeholder="Rating"
                        class="" autocomplete="off"></x-text-input>
                    <x-text-input type="number" name="difficulty" field="difficulty" :value="@old('difficulty')"
                        placeholder="Difficulty" class="" autocomplete="off"></x-text-input>

                    <x-text-input type="file" name="image" field="image" placeholder="image"
                        class="w-full mt-6"></x-text-input>

                        {{-- drop down menu to select the network --}}
                    <div class="form-group">
                        <label for="network_id">Network</label>
                        <select name="network_id">
                            {{-- loops through each network and displays them as a drop down option --}}
                            @foreach ($networks as $network)
                                <option value="{{ $network->id }}"
                                    {{-- old() retains the selection  --}}
                                    {{ old('network_id') == $network->id ? 'selected' : '' }}>{{ $network->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="actors"> <strong> Actors</strong> <br></label>
                        @foreach ($actors as $actor)
                            <input type="checkbox", value="{{ $actor->id }}", name="actors[]">
                            {{ $actor->name }}
                        @endforeach
                    </div>
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
