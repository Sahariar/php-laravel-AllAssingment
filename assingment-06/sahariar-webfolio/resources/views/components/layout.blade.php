<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Sahariar Kabir</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.svg') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
        @vite('resources/css/app.css','resources/js/app.js')

    </head>
    <body>
        <x-navbar> </x-navbar>
            {{ $slot }}
        <x-footer> </x-footer>
    </body>
</html>
