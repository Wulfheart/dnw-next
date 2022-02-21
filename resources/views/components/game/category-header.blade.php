@props(['title', 'link'])

<div class="-ml-2 -mt-2 flex flex-wrap items-baseline">
    <h2 class="ml-2 mt-2 text-2xl leading-6 font-medium text-gray-900">{{ $title }}</h2>
    <a href="{{ $link }}" class="ml-2 mt-1 text-sm text-gray-500 truncate flex flex-row items-baseline">Mehr
        anzeigen
        <x-heroicon-o-chevron-right class="h-3 w-3 stroke-2" />
    </a>
</div>
