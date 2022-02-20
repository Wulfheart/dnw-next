<x-app-layout>
    <x-container.large>
        <div class="pb-5">
            <x-game.category-header title="Neue Spiele" :link="route('games.index')" />
        </div>
        <div class="grid grid-cols-4 gap-10 min-h-[6rem]">
            <a href="{{ route('games.create') }}" type="button"
               class="relative block w-full border-2 border-gray-300 border-dashed rounded-xl p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <x-heroicon-o-plus class="mx-auto h-12 w-12 text-gray-400" />
                <span class="mt-2 block text-sm font-medium text-gray-900"> Neues Spiel erstellen </span>
            </a>
            <?php /** @var \App\Models\Game $game */ ?>
            @foreach($preview['new'] as $game)
                <a href="#" class="focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 rounded-xl">
                    <div class="h-full w-full bg-black/60 rounded-xl bg-blend-darken bg-center bg-cover p-5 text-white"
                         style="background-image: url('{{storage_asset($game->currentPhase->svg_adjudicated)}}')"
                    >
                        <div class="h-full flex flex-col justify-between">
                            <h3 class="font-bold text-xl line-clamp-2 mb-4">{{$game->name}}</h3>
                            <div class="flex flex-row justify-between space-x-5">
                                <div class="font-medium">{{$game->powers->count()}}/{{$game->variant->basePowers->count()}} Spieler</div>
                                <div class="font-medium">12 h</div>
                            </div>

                        </div>

                    </div>

                </a>
        @endforeach


    </x-container.large>
</x-app-layout>