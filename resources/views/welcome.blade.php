<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DNW</title>

</head>

<body class="antialiased">
<a href="{{ route('login') }}">Login</a>
<br>
<a href="{{ route('register') }}">Register</a>
</body>
@if(config('app.debug'))
    <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/metrics.js"></script>
@endif
</html>
