<div wire:poll>
    <div class="space-y-2 wire:poll">
        @foreach($messages as $message)
            <?php /** @var \App\DTO\Views\Message $message */?>
            <div @class(['flex', 'flex-row' => !$message->fromUser, 'flex-row-reverse' => $message->fromUser])>
                <div @class(['bg-gray-200 max-w-3/4 text-sm overflow-hidden text-gray-900 rounded-lg bg-white shadow'])>
                    <div class="px-2 py-2 sm:p-2">
                        <div>
                            <p class="font-medium truncate text-sm" style="color: {{ $message->color }}">
                                {{$message->name}}
                            </p>
                        </div>

                        <div class="prose prose-sm">
                            {!! $message->text !!}
                        </div>

                        <div class="flex flex-row-reverse text-xs text-gray-600">
                            {{ $message->sentAt }}
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    @if($showMore)
        <x-button class="w-full mt-4" wire:click.prevent="increaseAmount" wire:loading.attr="disabled"
                  wire:target="increaseAmount" wire:loading.class="bg-red-500">Mehr laden
        </x-button>
    @endif
</div>
