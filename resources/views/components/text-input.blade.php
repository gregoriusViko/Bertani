@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'pl-3 py-2  border  border-gray-300 hover:bg-gray-50 focus:border-green-600 focus:ring-green-600 rounded-md shadow-md']) !!}>