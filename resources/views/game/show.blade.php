<x-app-layout>
    <x-container x-data="{ current: 0, max_index: {{ $phases->count() - 1 }}}">
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


        <x-tabs distribute>
            <a href="">
                <x-tabs.item>Map</x-tabs.item>
            </a>
            <a href="">
                <x-tabs.item>Messages</x-tabs.item>
            </a>

        </x-tabs>


        <div class="flex justify-center mt-5">
            <?php /** @var \App\DTO\Views\PhaseDTO $phase */?>
            @foreach($phases as $phase)
                <div class="" x-show="current == {{ $loop->index }}" {{ !$loop->first ? 'x-cloak' : '' }}>
                    <img class="object-cover max-h-[65vh]" x-bind:src="Math.abs({{ $loop->index }} - current) <= 5 || Math.abs(max_index - {{ $loop->index }}) <= 5 ? '{{ asset('storage/'.$phase->svg) }}' : ''" alt="{{ $phase->key }}">
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-3 text-gray-500">
            <button x-on:click="current = max_index" x-bind:disabled="current == max_index" class="disabled:opacity-50">
                <x-heroicon-o-chevron-double-left class="h-5 w-5"/>
            </button>
            <button x-on:click="current++" x-bind:disabled="current == max_index" class="disabled:opacity-50">
                <x-heroicon-o-chevron-left class="h-5 w-5"/>
            </button>
            <button x-on:click="current--"  x-bind:disabled="current == 0" class="disabled:opacity-50">
                <x-heroicon-o-chevron-right class="h-5 w-5"/>
            </button>
            <button x-on:click="current = 0"  x-bind:disabled="current == 0" class="disabled:opacity-50">
                <x-heroicon-o-chevron-double-right class="h-5 w-5"/>
            </button>
        </div>

        @can('submitOrders', $game)
        <div class="mt-5">
            <livewire:order-submission/>
        </div>
        @endcan

        <?php /** @var \App\Models\PhasePowerData $phasePowerData */ ?>
        <ul class="divide-y divide-gray-200 mt-6">
        @foreach($game->currentPhase->phasePowerData as $phasePowerData)
            <li class="grid grid-cols-3 py-4">
                <div style="color:{{ $phasePowerData->power->basePower->color }}" class="font-medium">{{ $phasePowerData->power->basePower->name }}</div>
                <div>{{ $phasePowerData->power->user->name }}</div>
                <div class="grid place-items-end italic text-sm">{{ $phasePowerData->supply_center_count }} VZs, {{ $phasePowerData->unit_count }} Einheiten</div>
            </li>
        @endforeach

        </ul>
    </x-container>
</x-app-layout>