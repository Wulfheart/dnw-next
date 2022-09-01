<div>
    <ul role="list" class="divide-y divide-gray-300">
   @foreach($messageRoomPreviews as $messageRoomPreview)

        <li class="relative bg-white py-5">
            <a href="{{ route('games.messages.show', ['message_room' => $messageRoomPreview->id, 'game' => $game_id]) }}">

            <div class="flex justify-between space-x-3">
                <div class="min-w-0 flex-1">
                    <div href="#" class="flex flex-row focus:outline-none space-x-1 items-center">
                            @if($messageRoomPreview->unread)
                            <div class="rounded-full w-2 h-2 bg-blue-600">
                            </div>
                            @endif
                        <p class="font-medium text-gray-900 truncate" style="color: {{ $messageRoomPreview->textColor }}">
                            {{$messageRoomPreview->name}}
                        </p>
                    </div>
                </div>
                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ $messageRoomPreview->previewSentAt }}</time>
            </div>
            <div class="mt-1">
                <p class="line-clamp-2 text-md text-gray-600"> {!! $messageRoomPreview->previewText !!}</p>
            </div>
            </a>
        </li>
   @endforeach
    </ul>

</div>
