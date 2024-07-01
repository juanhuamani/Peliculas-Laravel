<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title -->
        <title>{{$title}}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- Styles -->
        @vite(['resources/js/app.js' , 'resources/scss/app.scss'])

    </head>
    <body class="relative min-h-[100vh] flex flex-col">
        @if (session('success'))
            <div x-data="{show: true}" x-effect="setTimeout(() => show = false, 5000)" x-transition x-show="show">
                <div class="absolute w-full animation">
                    <x-nice-notification>{{ session('success') }}</x-nice-notification>
                </div>
            </div>
        @endif
        {{ $slot}}
    </body>
</html>