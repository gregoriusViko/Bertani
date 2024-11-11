@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-libre-franklin font-medium text-sm text-black']) }}>
    {{ $value ?? $slot }}
</label>