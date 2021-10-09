<x-app-layout>
    <x-slot name="header">
        <x-header.text>
            {{ __('Dashboard') }}
        </x-header.text>
    </x-slot>

    <x-container>
        <x-jet-welcome></x-jet-welcome>
    </x-container>
</x-app-layout>
