<x-app-layout>
    <x-slot name="header">
        <x-header title="Neues Spiel erstellen" subtitle="Erstelle ein Spiel nach deinen Vorstellungen"/>
    </x-slot>


    <div class="content">
        <div class="gameCreateShow">
            <x-form :action="route('games.store')">
                <p>
                    <strong>Name des Spiels:</strong><br>
                    <input class="gameCreate" type="text" name="name" value="" size="30">
                </p>
                <p>
                    <strong>Variante:</strong><br>
                    <select name="variant_id" id="variant_id" class="gameCreate">
                        @foreach($variants as $variant)
                            <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <strong>Phasenlänge:</strong>
                    <select name="phase_length" id="phase_length" class="gameCreate">
                        @foreach($phaselengths as $phaselength)
                            <option value="{{ $phaselength['minutes'] }}" {{ $phaselength['minutes'] == $default_phaselength ? 'selected' : '' }}>{{ $phaselength['humanized'] }}</option>
                        @endforeach
                    </select>
                </p>
                <p>
                    <strong>Keine Spielauswertung:</strong>

                    @foreach($no_adjudication_days as $no_adjudication_day)
                        <div>
                            <input type="checkbox" id="{{ $no_adjudication_day['form_key'] }}"
                                   name="{{ $no_adjudication_day['form_key'] }}" value="1">
                            <span>{{ $no_adjudication_day['humanized'] }}</span>
                        </div>
                    @endforeach
                </p>
                <p>
                    <button type="submit" class="green-Submit"><strong>Submit</strong></button>
                </p>
            </x-form>
        </div>
    </div>
</x-app-layout>