<div>
    <ul role="list" class="divide-y divide-gray-300">
   @foreach($messageRoomPreviews as $messageRoomPreview)
        <li class="relative bg-white py-5">
            <div class="flex justify-between space-x-3">
                <div class="min-w-0 flex-1">
                    <a href="#" class="block focus:outline-none">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="font-medium text-gray-900 truncate" style="color: {{ $messageRoomPreview->textColor }}">{{$messageRoomPreview->name}}</p>
                    </a>
                </div>
                <time class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">{{ $messageRoomPreview->previewSentAt }}</time>
            </div>
            <div class="mt-1">
                <p class="line-clamp-2 text-md text-gray-600"> {{ $messageRoomPreview->previewText }}</p>
            </div>
        </li>
   @endforeach
    </ul>

</div>
