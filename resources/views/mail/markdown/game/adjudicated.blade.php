{{-- @formatter:off --}}

@component('mail::message')
# Spiel ausgewertet

Hallo,

das Spiel _"{{ $gameName }}"_ wurde ausgewertet. Sieh jetzt nach, was passiert ist.

@component('mail::button', ['url' => ''])
Spiel ansehen
@endcomponent

Gut Brett!
@endcomponent
