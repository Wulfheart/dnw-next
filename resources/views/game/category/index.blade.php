<x-app-layout>
    <x-container.large title="{{ $title }}">
        <div class="space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10 ">
                <?php /** @var \App\Models\Game $game */ ?>
                @foreach ($games as $game)
                    <x-game.preview.player :game="$game" />
                @endforeach
            </div>
        </div>
    </x-container.large>
</x-app-layout>
