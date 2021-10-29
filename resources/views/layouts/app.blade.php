<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/home.css') }}">
    <link rel="stylesheet" href="{{ mix('css/gamepanel.css') }}">
    <link rel="stylesheet" href="{{ mix('css/global.css') }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

@livewireStyles

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
<div id="header">
    <div id="header-container">
        <a href="./">
            <img id="logo" src="images/logo.png" alt="Diplomacy">
        </a>
        <div>
            <div id="header-welcome">
                Welcome, <a href="./userprofile.php?userID=84364">wulfheart (100 <img src="images/icons/points.png"
                                                                                      alt="D"
                                                                                      title="webDiplomacy points">)</a>
                -
                <span class="logon">(<a href="logon.php?logoff=on" class="light">Log off</a>)</span>
            </div>
            <div id="header-goto">
                <div class="nav-wrap">
                    <div class="nav-tab"><a href="index.php?" title="See what's happening">Home</a></div>
                    <div class="nav-tab"><a href="/contrib/phpBB3/"
                                            title="The forum; chat, get help, help others, arrange games, discuss strategies">Forum</a>
                    </div>
{{--                    <div id="navSubMenu" class="clickable nav-tab">Suche ▼--}}
{{--                        <div id="nav-drop">--}}
{{--                            <a href="search.php">Find User</a>--}}
{{--                            <a href="gamelistings.php?gamelistType=Search">Game Search</a>--}}
{{--                            <a href="detailedSearch.php" title="advanced search of users and games">Advanced Search</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div id="navSubMenu" class="clickable nav-tab" x-data="{open: false}" x-on:click="open = true" x-on:click.away="open = false">Spiele ▼
                        <div id="nav-drop" x-show="open" x-cloak>
                            <a href="gamelistings.php?gamelistType=New"
                               title="Game listings; a searchable list of the games on this server">Neue Spiele</a>
                            <a href="gamelistings.php?gamelistType=Open%20Positions"
                               title="Open positions dropped by other players, free to claim">Offene Positionen</a>
                            <a href="{{ route('games.create') }}" title="Start up a new game">Neues Spiel erstellen</a>
                        </div>
                    </div>
{{--                    <div id="navSubMenu" class="clickable nav-tab">Account ▼--}}
{{--                        <div id="nav-drop">--}}
{{--                            <a href="contrib/phpBB3/ucp.php?i=pm" title="Read your messages">Private Messages</a>--}}
{{--                            <a href="contrib/phpBB3/ucp.php?i=179" title="Change your forum user settings">Forum--}}
{{--                                Settings</a>--}}
{{--                            <a href="usercp.php" title="Change your user specific settings">Site Settings</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div id="navSubMenu" class="clickable nav-tab">Help ▼--}}
{{--                        <div id="nav-drop">--}}
{{--                            <a href="rules.php">Site Rules</a>--}}
{{--                            <a href="faq.php" title="Frequently Asked Questions">FAQ</a>--}}
{{--                            <a href="intro.php" title="Intro to Diplomacy">Diplomacy Intro</a>--}}
{{--                            <a href="points.php" title="Points and Scoring Systems">Points/Scoring</a>--}}
{{--                            <a href="variants.php" title="Active webDiplomacy variants">Variants</a>--}}
{{--                            <a href="help.php" title="Site information; guides, stats, links">More Info</a>--}}
{{--                            <a href="contactUsDirect.php">Contact Us</a>--}}
{{--                            <a href="donations.php">Donate</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="seperator"></div>

@isset($header)
    {{ $header }}
    @endisset


{{ $slot }}

@livewireScripts
</body>
</html>
