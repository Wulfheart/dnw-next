@props(['link' => '#', 'isActive' => false, 'iconInactive', 'IconActive'])


<a href="{{ $link }}"
    class="w-full  justify-center inline-block text-center pt-2 pb-1">
    <x-dynamic-component :component="$isActive ? $iconActive : $iconInactive"
                         class="inline-block mb-1 stroke-1 focus:text-primary-600 hover:text-primary-600 {{ $isActive ? 'text-primary-600' : '' }}"
                         width="25" height="25"/>
    <span class="block text-xs font-medium">{{ $slot }}</span>
</a>
