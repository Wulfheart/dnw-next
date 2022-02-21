@props(['action', 'method' => 'POST'])

<form method="POST" action="{{ $action }}" {{ $attributes }}>
    @csrf
    @method($method)
    {{ $slot }}
</form>
