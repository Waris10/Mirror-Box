<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .met {
            /* height: 100vh; */
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            /* optional background */
        }
    </style>
</head>

<body>

    {{ $slot }}
</body>

</html>
