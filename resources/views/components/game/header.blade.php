@props(['game', 'adjudicationInProgress'])

<x-app-layout>
    <x-container.game {{ $attributes }}>
        <div class="bg-white shadow-2xl block fixed inset-x-0 bottom-0 z-10 lg:hidden space-x-0 flex flex-row space-x-4">
            <x-game.nav-link-mobile :link="route('games.show', $game)" icon-active="heroicon-s-map"
                icon-inactive="heroicon-o-map" :is-active="request()->routeIs('games.show')">
                Karte
            </x-game.nav-link-mobile>
            <x-game.nav-link-mobile :link="route('games.messages.index', $game)" icon-active="heroicon-s-mail"
                icon-inactive="heroicon-o-mail" :is-active="!request()->routeIs('games.show')">
                Nachrichten
            </x-game.nav-link-mobile>
        </div>
        <div class="flex lg:space-x-5">

            {{-- Navigation desktop --}}
            <div class="w-1/4 items-start hidden lg:block">
                <div class="sticky top-10 space-y-1">
                    <x-game.nav-link-desktop :link="route('games.show', $game)"
                        :is-active="request()->routeIs('games.show')">Karte
                    </x-game.nav-link-desktop>
                    <x-game.nav-link-desktop :link="route('games.messages.index', $game)"
                        :is-active="!request()->routeIs('games.show')">Nachrichten
                    </x-game.nav-link-desktop>

                </div>
            </div>


            <div class="pb-[25px] lg:pb-0 w-full">

                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    {{ $game->name }}
                </h2>
                <div
                    class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6 sm:justify-between items-center">
                    <div class="flex flex-row space-x-6 ">

                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <x-ri-treasure-map-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current" />
                            {{ $game->variant->name }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <x-ri-focus-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current" />
                            {{ $game->currentPhase->phase_name_long }}
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 mt-2">
                        @if ($adjudicationInProgress)
                            Auswertung läuft
                        @else
                            <x-game.countdown :isoDatetime="$game->currentPhase->adjudication_at?->toIso8601String()" />
                        @endif
                    </div>
                </div>

                @if ($game->currentState() == \App\Enums\GameStatusEnum::PREGAME)
                    <div class="sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6 sm:px-0">
                            <div class="sm:flex sm:items-start sm:justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        {{ $game->powers->whereNotNull('user_id')->count() }}
                                        /{{ $game->variant->basePowers->count() }} Spieler
                                    </h3>
                                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                                        <p>{{ $game->powers->whereNotNull('user_id')->transform(fn($power) => $power->user->name)->implode(', ') }}
                                        </p>
                                    </div>
                                </div>
                                @can('join', $game)
                                    <x-form :action="route('games.join', $game)"
                                        class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm">
                                            Spiel beitreten
                                        </button>
                                    </x-form>
                                @endcan
                                @can('leave', $game)
                                    <x-form :action="route('games.leave', $game)"
                                        class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm">
                                            Spiel verlassen
                                        </button>
                                    </x-form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </div>
        </div>
    </x-container.game>
</x-app-layout>
