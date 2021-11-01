<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/old_app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <style>
            svg.eye-icon-blind{
                display: none;
            }
        </style>
    </head>
    <body>
        <script>
            if (location.protocol !== 'https:' && location.hostname !== '127.0.0.1') {  
                location.replace(`https:${location.href.substring(location.protocol.length)}`);
            }
        </script>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        
    </body>
</html>