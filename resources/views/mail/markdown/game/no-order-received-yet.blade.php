{{-- @formatter:off --}}
@component('mail::message')
# Spiel gestartet

Hallo,

das Spiel _"{{ $gameName }}"_ wird bald ausgewertet und du hast noch keine Befehle abgegeben.
Bitte hole das schnellstmöglich nach.

@component('mail::button', ['url' => $url])
Befehle abgeben
@endcomponent

Gut Brett!
@endcomponent
