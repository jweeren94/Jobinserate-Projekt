<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Jobbörse')</title>

    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    @vite('resources/css/app.css')
</head>
<body>

    <x-header />

    <main>
        @yield('content')
    </main>



</body>
</html>
