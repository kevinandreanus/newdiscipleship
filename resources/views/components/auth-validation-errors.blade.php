@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        {{-- <div class="font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div> --}}

        @foreach ($errors->all() as $error)
            <p class="text-danger text-red-600">{{ $error }}</p>
        @endforeach
    </div>
@endif
