<x-app-layout>
    <x-container.large x-data="{ current: 0, max_index: {{ $phases->count() - 1 }}}">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            Kriegsspiele
        </h2>
        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <x-ri-treasure-map-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current"/>
                {{ $game->variant->name }}
            </div>
            <div class="mt-2 flex items-center text-sm text-gray-500">
                <x-ri-focus-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current"/>
                {{ $game->currentPhase->phase_name_long }}
            </div>
        </div>


        <div class="flex justify-center mt-5">
            <?php /** @var \App\DTO\Views\PhaseDTO $phase */?>
            @foreach($phases as $phase)
                <div class="" x-show="current == {{ $loop->index }}" {{ !$loop->first ? 'x-cloak' : '' }}>
                    <img class="object-cover max-h-[65vh]" x-bind:src="Math.abs({{ $loop->index }} - current) <= 5 || Math.abs(max_index - {{ $loop->index }}) <= 5 ? '{{ asset($phase->svg) }}' : ''" alt="{{ $phase->key }}">
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-3">
            <button x-on:click="current = max_index" x-bind:disabled="current == max_index"><x-feathericon-chevrons-left class="disabled:opacity-50"/></button>
            <button x-on:click="current++" x-bind:disabled="current == max_index"><x-feathericon-chevron-left/></button>
            <button x-on:click="current--"  x-bind:disabled="current == 0"><x-feathericon-chevron-right/></button>
            <button x-on:click="current = 0"  x-bind:disabled="current == 0"><x-feathericon-chevrons-right/></button>
        </div>
    </x-container.large>
</x-app-layout>