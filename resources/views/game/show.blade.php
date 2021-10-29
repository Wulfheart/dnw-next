<x-app-layout>
    <div class="content-bare content-board-header">
        <div class="boardHeader">
            <div class="variantClassic"><a name="gamePanel"></a>
                <div class="titleBar">


                    <div class="titleBarRightSide">
                        <div>
                            <span class="gameTimeRemaining"><span class="gameTimeRemainingNextPhase">Next:</span> <span
                                        class="timeremaining" unixtime="1635152264"
                                        unixtimefrom="1635070107">23 hours</span> (<span class="timestampGames"
                                                                                         unixtime="1635152264">Mon, 10:57 AM, 25 Oct</span>)</span>
                        </div>
                    </div>
                    <div class="titleBarLeftSide">
                        <span class="gameName">{{ $game->name }}</span></div>
                    <div style="clear:both"></div>
                    <div class="titleBarRightSide">
                        <div><span class="gameHoursPerPhase"><strong>1 day</strong> /phase</span></div>
                    </div>
                    <div class="titleBarLeftSide">
                        <div>
                            Pot: <span class="gamePot">35  <img src="images/icons/points.png" alt="D"
                                                                title="webDiplomacy points"></span> - <span
                                    class="gameDate">Spring, 1903</span>, <span class="gamePhase">Diplomacy</span></div>
                        <div>
                            <div class="titleBarLeftSide">
                                <span class="gamePotType"><a class="light" href="variants.php#Classic">Classic</a>, Draw-Size Scoring</span>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                    <div class="titleBarRightSide"><span class="excusedNMRs">1</span>
                        excused missed turn
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="membersList">
                    <div class="panelAnonOnlyFlag"><b>At least 1 country still needs to enter orders!</b></div>
                    <div class="panelBarGraphMember memberProgressBar barAlt1">
                        <table class="memberProgressBarTable">
                            <tbody>
                            <tr>
                                <td class="memberProgressBarSCs first" style="width:17%"></td>
                                <td class="memberProgressBarRemaining " style="width:83%"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="memberBoardHeader barAlt1 barDivBorderTop ">
                        <table>
                            <tbody>
                            <tr class="member">
                                <td class="memberLeftSide">
                                    <span class="memberCountryName"><span
                                                class="country6 memberYourCountry memberStatusPlaying">Turkey</span></span>
                                </td>
                                <td class="memberRightSide ">
                                    <div>
                                        <div class="memberUserDetail">
                                            <span class="member1771092StatusIcon"><img src="images/icons/alert.png"
                                                                                       alt="Not received"
                                                                                       title="No orders submitted!"> </span>
                                            - <span class="member1771092StatusText">No orders submitted!</span><br>
                                            No unread messages
                                        </div>
                                        <div class="memberGameDetail">
                                            <span class="memberPointsCount">Bet: <em>0 <img
                                                            src="images/icons/points.png" alt="D"
                                                            title="webDiplomacy points"></em>, worth: <em class="good">5 <img
                                                            src="images/icons/points.png" alt="D"
                                                            title="webDiplomacy points"></em></span><br><span
                                                    class="memberUnitCount"><span class="memberSCCount"><em>3</em> supply-centers, <em
                                                            class="neutral">3</em> units</span></span>
                                        </div>
                                        <div style="clear:both"></div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panelBarGraphTop occupationBar">
                    <table class="occupationBarTable">
                        <tbody>
                        <tr>
                            <td class="occupationBar1 first" style="width:13%"></td>
                            <td class="occupationBar2 " style="width:15%"></td>
                            <td class="occupationBar3 " style="width:12%"></td>
                            <td class="occupationBar4 " style="width:15%"></td>
                            <td class="occupationBar5 " style="width:18%"></td>
                            <td class="occupationBar6 " style="width:9%"></td>
                            <td class="occupationBar7 " style="width:18%"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{--    <x-container x-data="{ current: 0, max_index: {{ $phases->count() - 1 }}}">--}}
    {{--        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">--}}
    {{--            Kriegsspiele--}}
    {{--        </h2>--}}
    {{--        <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">--}}
    {{--            <div class="mt-2 flex items-center text-sm text-gray-500">--}}
    {{--                <x-ri-treasure-map-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current"/>--}}
    {{--                {{ $game->variant->name }}--}}
    {{--            </div>--}}
    {{--            <div class="mt-2 flex items-center text-sm text-gray-500">--}}
    {{--                <x-ri-focus-line class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 fill-current"/>--}}
    {{--                {{ $game->currentPhase->phase_name_long }}--}}
    {{--            </div>--}}
    {{--        </div>--}}


    {{--        <x-tabs distribute>--}}
    {{--            <a href="">--}}
    {{--                <x-tabs.item>Map</x-tabs.item>--}}
    {{--            </a>--}}
    {{--            <a href="">--}}
    {{--                <x-tabs.item>Messages</x-tabs.item>--}}
    {{--            </a>--}}

    {{--        </x-tabs>--}}


    {{--        <div class="flex justify-center mt-5">--}}
    {{--            <?php /** @var \App\DTO\Views\PhaseDTO $phase */?>--}}
    {{--            @foreach($phases as $phase)--}}
    {{--                <div class="" x-show="current == {{ $loop->index }}" {{ !$loop->first ? 'x-cloak' : '' }}>--}}
    {{--                    <img class="object-cover max-h-[65vh]" x-bind:src="Math.abs({{ $loop->index }} - current) <= 5 || Math.abs(max_index - {{ $loop->index }}) <= 5 ? '{{ asset('storage/'.$phase->svg) }}' : ''" alt="{{ $phase->key }}">--}}
    {{--                </div>--}}
    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--        <div class="flex justify-center mt-3 text-gray-500">--}}
    {{--            <button x-on:click="current = max_index" x-bind:disabled="current == max_index" class="disabled:opacity-50">--}}
    {{--                <x-feathericon-chevrons-left />--}}
    {{--            </button>--}}
    {{--            <button x-on:click="current++" x-bind:disabled="current == max_index" class="disabled:opacity-50">--}}
    {{--                <x-feathericon-chevron-left/>--}}
    {{--            </button>--}}
    {{--            <button x-on:click="current--"  x-bind:disabled="current == 0" class="disabled:opacity-50">--}}
    {{--                <x-feathericon-chevron-right/>--}}
    {{--            </button>--}}
    {{--            <button x-on:click="current = 0"  x-bind:disabled="current == 0" class="disabled:opacity-50">--}}
    {{--                <x-feathericon-chevrons-right/>--}}
    {{--            </button>--}}
    {{--        </div>--}}

    {{--        @can('submitOrders', $game)--}}
    {{--        <div class="mt-5">--}}
    {{--            <livewire:order-submission/>--}}
    {{--        </div>--}}
    {{--        @endcan--}}

    {{--        <?php /** @var \App\Models\PhasePowerData $phasePowerData */ ?>--}}
    {{--        <ul class="divide-y divide-gray-200 mt-6">--}}
    {{--        @foreach($game->currentPhase->phasePowerData as $phasePowerData)--}}
    {{--            <li class="grid grid-cols-3 py-4">--}}
    {{--                <div style="color:{{ $phasePowerData->power->basePower->color }}" class="font-medium">{{ $phasePowerData->power->basePower->name }}</div>--}}
    {{--                <div>{{ $phasePowerData->power->user->name }}</div>--}}
    {{--                <div class="grid place-items-end italic text-sm">{{ $phasePowerData->supply_center_count }} VZs, {{ $phasePowerData->unit_count }} Einheiten</div>--}}
    {{--            </li>--}}
    {{--        @endforeach--}}

    {{--        </ul>--}}
    {{--    </x-container>--}}
</x-app-layout>