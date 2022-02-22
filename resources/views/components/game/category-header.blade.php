@props(['title', 'link', 'show_link' => false])

<div class="md:flex md:items-center md:justify-between">
    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{ $title }}</h2>
    @if($show_link)
        <a href="#" class="hidden text-sm font-medium text-primary-600 hover:text-primary-500 md:block">
            Mehr anzeigen<span aria-hidden="true"> &rarr;</span>
        </a>
    @endif
</div>

