<x-app-layout>
    <x-container.large>
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


        <div>
            <?php /** @var \App\Models\Phase $phase */?>
            @foreach($game->phases as $phase)

                <div {{ $phase->id != $game->currentPhase->id ? 'x-cloak' : '' }}>
                    <img src='{{ asset($phase->svg_with_orders) }}' alt="">
                    <img src='{{ asset($phase->svg_adjudicated) }}' alt="">
                </div>
            @endforeach
        </div>
    </x-container.large>
</x-app-layout>