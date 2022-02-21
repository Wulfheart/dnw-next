@props(['active' => false, 'badge' => null])


<!-- Current: "", Default: "" -->
<div
    class="{{ $active? 'border-primary-500 text-primary-600': 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
    {{ $slot }}

    @isset($badge)
        @if ($active)
            <span
                class="bg-primary-100 text-primary-600 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $badge }}</span>
        @else
            <span
                class="bg-gray-100 text-gray-900 hidden ml-3 py-0.5 px-2.5 rounded-full text-xs font-medium md:inline-block">{{ $badge }}</span>
        @endif
    @endisset
</div>
