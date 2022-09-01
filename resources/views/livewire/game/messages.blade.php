<div wire:poll>
    <div class="space-y-2">
        @foreach($messages as $message)
            <?php /** @var \App\DTO\Views\Message $message */?>
            <div @class(['flex', 'flex-row' => !$message->fromUser, 'flex-row-reverse' => $message->fromUser])>
              <div @class(['bg-gray-200 w-3/4 overflow-hidden rounded-lg bg-white shadow'])>
                  <div class="px-2 py-2 sm:p-2">
                  <div>
                      <p class="font-medium text-gray-900 truncate" style="color: {{ $message->color }}">
                          {{$message->name}}
                      </p>
                  </div>

                  {{ $message->text }}

                      <div class="flex flex-row-reverse text-xs">
                          {{ $message->sentAt }}
                      </div>
                  </div>
              </div>

            </div>
        @endforeach
    </div>
    @if($showMore)
        <button wire:click="increaseAmount" wire:loading.attr="disabled" wire:target="increaseAmount" wire:loading.class="bg-red-500">More</button>
    @endif
</div>
