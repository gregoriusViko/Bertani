@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'p-2 border-gray-300 focus:border-green-600 outline-none rounded-lg hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md md:h-36 resize-none',
]) !!}>{{ $slot }}</textarea>