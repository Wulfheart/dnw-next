<?php /** @var \App\Models\Game $game */
?>
@props(['name', 'link', 'bg', 'left' => null, 'right' => null])

<a href="{{ $link }}" {{ $attributes->merge(['class' => "focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 rounded-xl min-h-[12.5rem]"]) }}>
    <div class="h-full w-full bg-black/60 rounded-xl bg-blend-darken hover:bg-black/80 bg-center bg-cover p-5 text-white"
        style="background-image: url('{{ $bg }}')">
        <div class="h-full flex flex-col justify-between">
            <h3 class="font-bold text-xl line-clamp-2 mb-4">{{ $name }}</h3>
            <div class="flex flex-row justify-between space-x-5">
                <div class="font-medium">{{ $left }}</div>
                <div class="font-medium">{{ $right }}</div>
            </div>

        </div>

    </div>
    {{ $slot }}

</a>
