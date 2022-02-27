<x-app-layout>
    <x-container x-data="{ current: 0, max_index: {{ $phases->count() - 1 }}}">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            {{ $game->name }}
        </h2>
        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6 sm:justify-between items-baseline">
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
            <div class="text-sm text-gray-500">
                @if($adjudicationInProgress)
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
                        @if ($user->can('join', $game))
                            <x-form :action="route('games.join', $game)"
                                class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm">
                                    Spiel beitreten
                                </button>
                            </x-form>
                        @endif
                        @if ($user->can('leave', $game))
                            <x-form :action="route('games.leave', $game)"
                                class="mt-5 sm:mt-0 sm:ml-6 sm:flex-shrink-0 sm:flex sm:items-center">
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:text-sm">
                                    Spiel verlassen
                                </button>
                            </x-form>
                        @endif
                    </div>
                </div>
            </div>
        @endif


        {{-- <x-tabs distribute> --}}
        {{-- <a href="{{ route('games.show', $game) }}"> --}}
        {{-- <x-tabs.item :active="true">Map</x-tabs.item> --}}
        {{-- </a> --}}
        {{-- <a href="{{ route('games.show.messages.index', $game) }}"> --}}
        {{-- <x-tabs.item>Messages</x-tabs.item> --}}
        {{-- </a> --}}
        {{-- </x-tabs> --}}


        <div class="flex justify-center mt-5">
            <?php /** @var \App\DTO\Views\PhaseDTO $phase */
            ?>
            @foreach ($phases as $phase)
                <div class="" x-show="current == {{ $loop->index }}"
                    {{ !$loop->first ? 'x-cloak' : '' }}>
                    <img class="object-cover max-h-[65vh]"
                        x-bind:src="Math.abs({{ $loop->index }} - current) <= 5 || Math.abs(max_index - {{ $loop->index }}) <= 5 ? '{{ asset('storage/' . $phase->svg) }}' : ''"
                        alt="{{ $phase->key }}">
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-3 text-gray-500">
            <button x-on:click="current = max_index" x-bind:disabled="current == max_index" class="disabled:opacity-50">
                <x-heroicon-o-chevron-double-left class="h-5 w-5" />
            </button>
            <button x-on:click="current++" x-bind:disabled="current == max_index" class="disabled:opacity-50">
                <x-heroicon-o-chevron-left class="h-5 w-5" />
            </button>
            <button x-on:click="current--" x-bind:disabled="current == 0" class="disabled:opacity-50">
                <x-heroicon-o-chevron-right class="h-5 w-5" />
            </button>
            <button x-on:click="current = 0" x-bind:disabled="current == 0" class="disabled:opacity-50">
                <x-heroicon-o-chevron-double-right class="h-5 w-5" />
            </button>
        </div>

        @if ($userIsMember)
            <div class="mt-5">
                <x-form :action="route('games.orders.store', $game)" x-data="{showHelp: false}"
                    x-on:click.away="showHelp = false">
                    <div>
                        <div class="flex justify-between" x-on:click.prevent="showHelp = !showHelp">
                            <label for="orders" class="block text-sm font-medium text-gray-700">Befehle
                                @isset($userPower->basePower)
                                    <span class="inline-flex">
                                        (
                                        <span
                                            style="color:{{ $userPower->basePower->color }}">{{ $userPower->basePower->name }}</span>
                                        )
                                    </span>
                                @endisset
                            </label>
                            <span class="text-sm text-gray-500"><button>
                                    <x-heroicon-o-question-mark-circle type="button" class="h-4 w-4" />
                                </button></span>
                        </div>
                        <div x-show="showHelp" x-collapse x-cloak>
                            <div class="rounded-md bg-gray-100 p-4 my-4">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-gray-800">Befehlsnotation</h3>
                                    <div class="mt-2 text-sm text-gray-700 font-mono">
                                        A LON H // Hold<br>
                                        F IRI - MAO // Move<br>
                                        A IRI - MAO VIA // ???<br>
                                        A WAL S F LON // Support Hold<br>
                                        A WAL S F MAO - IRI // Support Move<br>
                                        F NWG C A NWY - EDI // Convoy<br>
                                        A IRO R MAO // Retreat<br>
                                        A IRO D // Disband<br>
                                        A LON B // Build<br>
                                        F LIV B // Build<br>
                                        WAIVE
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-1">
                        <textarea id="orders" rows="4" name="orders"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md disabled:opacity-50 disabled:bg-gray-200 disabled:cursor-not-allowed"
                            @disabled(!
                            $ordersSubmittable)>{{ $ordersNeeded ? $orders : 'Keine Befehle benötigt' }}</textarea>
                    </div>
                    <div class="mt-2 flex justify-end space-x-4">
                        @if ($ordersReady)
                            <textarea name="orders" hidden>{{ $orders }}</textarea>
                            <x-button intent="primary" type="submit" name="ready" value="0" :disabled="$user->can('submitOrders', $game)"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Noch nicht fertig
                            </x-button>
                        @else
                            <x-button intent="primary" type="submit" name="ready" value="0"
                                :disabled="!$ordersSubmittable"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Speichern
                            </x-button>
                            <x-button intent="primary" type="submit" name="ready" value="1"
                                :disabled="!$ordersSubmittable"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Fertig
                            </x-button>
                        @endif
                    </div>
                </x-form>

            </div>
        @endif

        @if ($gameState != \App\Enums\GameStatusEnum::PREGAME)
            <?php
            /** @var \App\Models\PhasePowerData $phasePowerData */
            ?>
            <ul class="divide-y divide-gray-200 mt-6">
                @foreach ($game->currentPhase->phasePowerData as $phasePowerData)
                    <li class="grid grid-cols-3 py-4">
                        <div class="font-medium flex flex-row items-center space-x-2">
                            @if (isset($phasePowerData->orders))
                                <x-heroicon-s-check-circle
                                    data-tippy-content="{{ $phasePowerData->ready_for_adjudication ? 'Befehle gespeichert und fertig' : 'Befehle gespeichert' }}"
                                    class="w-4 h-4 {{ $phasePowerData->ready_for_adjudication ? 'text-green-600' : 'text-gray-500' }}" />
                            @elseif($phasePowerData->orders_needed)
                                <x-heroicon-o-exclamation-circle data-tippy-content="Befehle benötigt"
                                    class="w-4 h-4 text-red-600" />
                            @else
                                <x-heroicon-o-minus-sm data-tippy-content="Keine Befehle nötig"
                                    class="w-4 h-4 text-gray-500" />
                            @endif
                            <span
                                style="color:{{ $phasePowerData->power->basePower->color }}">{{ $phasePowerData->power->basePower->name }}</span>

                        </div>
                        <div>{{ $phasePowerData->power->user->name }}</div>
                        <div class="grid place-items-end italic text-sm">{{ $phasePowerData->supply_center_count }}
                            VZs,
                            {{ $phasePowerData->unit_count }} Einheiten
                        </div>
                    </li>
                @endforeach

            </ul>
        @endif
    </x-container>
</x-app-layout>
