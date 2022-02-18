<x-app-layout>
    <x-container.large>
        <div class="pb-5">
            <div class="-ml-2 -mt-2 flex flex-wrap items-baseline">
                <h2 class="ml-2 mt-2 text-2xl leading-6 font-medium text-gray-900">Neue Spiele</h2>
                <p class="ml-2 mt-1 text-sm text-gray-500 truncate">Mehr anzeigen</p>
            </div>
        </div>
        <?php /** @var \App\Models\Game $game */ ?>
        <div class="grid grid-cols-3 gap-10">
        @foreach($preview['new'] as $game)
            <div class="h-full w-full rounded-xl bg-black/60 bg-blend-darken bg-center bg-cover p-5"
                style="background-image: url('{{storage_asset($game->currentPhase->svg_adjudicated)}}')"
            >
                <h3 class="text-white font-bold text-xl line-clamp-2">{{$game->name}}</h3>

            </div>
        @endforeach


    </x-container.large>
</x-app-layout>