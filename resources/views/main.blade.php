<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')

</head>

<body>



    <main class="bg-gray-900 h-screen w-screen ">
        @yield('page')
    </main>



</body>

</html>
