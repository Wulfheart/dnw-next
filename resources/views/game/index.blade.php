<x-app-layout>
    <x-container.large>
        <div class="space-y-12">

            <div>
                <div class="pb-5">
                    <x-game.category-header title="Neue Spiele" :link="route('games.index')" :show_link="" />
                </div>
                <div class="grid grid-cols-4 gap-10 min-h-[12.5rem]">
                    <div class="h-full w-full">
                        <a href="{{ route('games.create') }}"
                            class="relative block w-full h-full border-2 border-gray-300 border-dashed rounded-lg p-12 text-center hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 flex flex-col justify-center">
                            <x-heroicon-o-plus class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                fill="none" />
                            <span class="mt-2 block text-sm font-medium text-gray-900"> Neues Spiel erstellen </span>
                        </a>
                    </div>
                    <?php /** @var \App\Models\Game $game */ ?>
                    @foreach ($preview['new'] as $game)
                        <x-game.preview.new :game="$game" />
                    @endforeach
                </div>
            </div>
            <div>
                <div class="pb-5">
                    <x-game.category-header title="Deine Spiele" :link="route('games.index')" />
                </div>
                <div class="grid grid-cols-4 gap-10 min-h-[12.5rem]">
                    <?php /** @var \App\Models\Game $game */
                    ?>
                    @forelse($preview['player'] as $game)
                        <x-game.preview.player :game="$game" />
                    @empty
                        <x-game.empty-category />
                    @endforelse
                </div>
            </div>
            <div>
                <div class="pb-5">
                    <x-game.category-header title="Laufende Spiele" :link="route('games.index')" />
                </div>
                <div class="grid grid-cols-4 gap-10 min-h-[12.5rem]">
                    <?php /** @var \App\Models\Game $game */
                    ?>
                    @forelse($preview['active'] as $game)
                        <x-game.preview.active :game="$game" />
                    @empty
                        <x-game.empty-category />
                    @endforelse
                </div>
            </div>
            <div>
                <div class="pb-5">
                    <x-game.category-header title="Fertige Spiele" :link="route('games.index')" />
                </div>
                <div class="grid grid-cols-4 gap-10 min-h-[12.5rem]">
                    <?php /** @var \App\Models\Game $game */
                    ?>
                    @forelse($preview['finished'] as $game)
                        <x-game.preview.finished :game="$game" />
                    @empty
                        <x-game.empty-category />
                    @endforelse
                </div>
            </div>
        </div>


    </x-container.large>
</x-app-layout>
