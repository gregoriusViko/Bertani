@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 rounded-md shadow-lg',
]) !!}>{{ $slot }}</textarea>