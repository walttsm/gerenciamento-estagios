@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-orange-600 focus:ring focus:ring-orange-700 focus:ring-opacity-50']) !!}>
