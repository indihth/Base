@props(['disabled' => false, 'field' => ''])

{{-- wrapped in a div so they displayed blocks --}}
<div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
        'class' =>
            'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-6 ',
    ]) !!}>


    {{-- Displaying error messages --}}
    {{-- replace 'title' with the $field variable, can't hardcode --}}
    @error($field)
        <div class="text-red-600 text-sm"> {{ $message }}</div>
    @enderror

</div>
