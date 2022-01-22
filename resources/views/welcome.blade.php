<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LAV-Forum</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div id="app">
            <v-app>
                <home></home>
            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
