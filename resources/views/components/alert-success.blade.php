{{-- checking for session data, show flash message --}}
@if (session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100">
        {{ $slot }}
    </div>
@endif
