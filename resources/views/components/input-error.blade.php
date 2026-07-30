@props(['messages'])
@if ($messages)
    <span {{ $attributes->merge(['class' => 'text-sm text-danger space-y-1']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
</span>
@endif
