{{-- @formatter:off --}}

@component('mail::message')
# Spiel ausgewertet

Hallo,

das Spiel _"{{ $gameName }}"_ wurde gerade beendet. Sieh jetzt nach, wie es ausgegangen ist.

@component('mail::button', ['url' => $url])
    Spiel ansehen
@endcomponent

Gut Brett!
@endcomponent
