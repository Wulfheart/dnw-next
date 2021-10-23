@props(['distribute' => false])

<div>
    <div>
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 overflow-x-auto @if($distribute) justify-between @endif" aria-label="Tabs">
                {{ $slot }}
            </nav>
        </div>
    </div>
</div>
