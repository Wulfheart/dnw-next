{{-- @formatter:off --}}
@component('mail::message')
# Spiel gestartet

Hallo,

das Spiel _"{{ $gameName }}"_ hat begonnen!

@component('mail::button', ['url' => $url])
Spiel ansehen
@endcomponent

Gut Brett!
@endcomponent
