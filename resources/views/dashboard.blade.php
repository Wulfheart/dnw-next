<x-app-layout>
    <x-slot name="header">
        <x-header.text>
            {{ __('Dashboard') }}
        </x-header.text>
    </x-slot>

    <x-container.index>
        <x-jet-welcome></x-jet-welcome>
    </x-container.index>
</x-app-layout>
