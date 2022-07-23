<x-game.header :game="$game" :adjudication-in-progress="$adjudicationInProgress">
    <div x-data="{ current: 0, max_index: {{ $phases->count() - 1 }}}"
         x-ref="phases"
         x-on:keyup.right.window="current = current > 0 ? current - 1 : current"
         x-on:keyup.left.window=" current=current < max_index ? current + 1 : current"
    >

        <div class="flex justify-center mt-5">
            <?php /** @var \App\DTO\Views\PhaseDTO $phase */
            ?>
            @foreach ($phases as $phase)
                <div class="" x-show="current == {{ $loop->index }}"
                        {{ !$loop->first ? 'x-cloak' : '' }}>
                    @if($loop->first)
                        <div id="mapContainer" class="object-cover max-h-[65vh]">
                            {!! $preloadPhaseSvg !!}
                        </div>
                    @else
                        <img class="object-cover max-h-[65vh]"
                             x-bind:src="Math.abs({{ $loop->index }} - current) <= 5 || Math.abs(max_index - {{ $loop->index }}) <= 5 ? '{{ asset('storage/' . $phase->svg) }}' : ''"
                             alt="{{ $phase->key }}">
                    @endif
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
                              @disabled(!$ordersSubmittable)
                              x-dusk="order-textarea">{{ $ordersNeeded ? $orders : 'Keine Befehle benötigt' }}</textarea>
                </div>
                <div class="mt-2 flex justify-end space-x-4">
                    @if ($ordersReady)
                        <textarea name="orders" hidden>{{ $orders }}</textarea>
                        <x-button intent="primary" type="submit" name="ready" value="0"
                                  :disabled="$adjudicationInProgress"
                                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                                  x-dusk="order-button-not-ready">
                            Noch nicht fertig
                        </x-button>
                    @else
                        <x-button intent="primary" type="submit" name="ready" value="0" :disabled="!$ordersSubmittable"
                                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                                  x-dusk="order-button-save">
                            Speichern
                        </x-button>
                        <x-button intent="primary" type="submit" name="ready" value="1" :disabled="!$ordersSubmittable"
                                  class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                                  x-dusk="order-button-ready">
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
                    <div class="grid place-items-end italic text-sm">
                        {{ $phasePowerData->supply_center_count }}
                        VZs,
                        {{ $phasePowerData->unit_count }} Einheiten
                    </div>
                </li>
            @endforeach

        </ul>
    @endif
</x-game.header>
