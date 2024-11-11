@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'pl-3 py-2  border  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-lg']) !!}>