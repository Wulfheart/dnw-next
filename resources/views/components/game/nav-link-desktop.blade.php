@props(['link' => '#', 'isActive' => false])
<a href="{{ $isActive ? '#' : $link }}" @class([
    'group flex items-center px-2 py-2 text-base font-medium rounded-md',
    'text-white bg-primary-600 hover:opacity-75' => $isActive,
    'text-gray-800 hover:outline hover:outline-2 hover:outline-primary-500' => !$isActive,
])>
    {{ $slot }}
</a>
