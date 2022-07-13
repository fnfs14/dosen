@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-emerald-300 focus:ring focus:ring-emerald-100 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
