@props(['intent' => null, 'disabled' => false])

@php
$color = match ($intent) { 'primary' => 'text-white bg-primary-600 hover:bg-primary-700',  'secondary' => 'text-primary-700 bg-primary-100 hover:bg-primary-200',  default => 'text-gray-700 bg-white hover:bg-gray-50' };

@endphp

<button
    {{ $attributes->merge(['class' => "inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md $color focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 disabled:cursor-not-allowed disabled:opacity-50"]) }}
    @disabled($disabled)>
    {{ $slot }}
</button>
