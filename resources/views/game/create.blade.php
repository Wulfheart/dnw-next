<x-app-layout>
    <x-slot name="header">
        <x-header.text>
            Neues Spiel erstellen
        </x-header.text>
    </x-slot>

    <x-form :action="route('games.store')">
        <x-container.index>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="name" value="Name" />
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{ old('name') }}"/>
                    <x-jet-input-error for="name" class="mt-2" />
                    <x-form.explanation class="mt-2">Der Name des Spiels</x-form.explanation>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="variant_id" value="Variante" />
                    <select name="variant_id" id="variant_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                        @foreach($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="variant_id" class="mt-2" />
                    <x-form.explanation class="mt-2">Wähle aus dieser Liste verfügbarer Spiel-Varianten/-Regeln, welche Art von Diplomacy-Partie du starten möchtest.</x-form.explanation>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="phase_length" value="Phasenlänge" />
                    <select name="phase_length" id="phase_length" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                        @foreach($phaselengths as $phaselength)
                            <option value="{{ $phaselength['minutes'] }}" {{ $phaselength['minutes'] == $default_phaselength ? 'selected' : '' }}>{{ $phaselength['humanized'] }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="join_phase_length" class="mt-2" />
                    <x-form.explanation class="mt-2">Die Zeit, die die Spieler pro Phase maximal für Diskussionen und das Abgeben von Zügen haben.
                        Längere Spiel-Phasen bedeuten mehr Zeit für sorgfälltige Überlegungen und Absprachen - aber brauchen schlichtweg mehr Zeit. Kürzere Phasen bringen ein schnelleres Spiel mit sich. Die Spieler, die an einem schnellen Spiel teilnehmen, müssen aber auch die Zeit mitbringen, sich in kurzen Abständen am Spiel zu beteiligen.</x-form.explanation>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label value="Keine Spielauswertung" />
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mt-2">
                        @foreach($no_adjudication_days as $no_adjudication_day)
                            <div>
                                <x-jet-checkbox
                                        id="{{ $no_adjudication_day['form_key'] }}"
                                        name="{{ $no_adjudication_day['form_key'] }}"
                                        value="1"
                                />
                                <label for="{{ $no_adjudication_day['form_key'] }}" class="text-sm">{{ $no_adjudication_day['humanized'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-jet-input-error for="no_adjudication" class="mt-2" />
                    <x-form.explanation class="mt-2">Wenn das Spiel an bestimmten Tagen nicht ausgewertet werden soll, können hier entsprechende Tage ausgewählt werden.
                        Sollte die aktuelle Phasenfrist auf einen gewählten Tag fallen, wird die Phase automatisch um 24 Stunden verlängert. Es besteht weiterhin die Möglichkeit, vorzeitig in die nächste Phase voranzuschreiten, indem alle Spieler ihre Befehle mit "Fertig" markieren.
                    </x-form.explanation>
                </div>
                <div class="col-span-6 sm:col-span-6 mx-auto">
                    <x-jet-button>Spiel erstellen</x-jet-button>
                </div>
            </div>
        </x-container.index>

    </x-form>

</x-app-layout>