<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <header class="mb-5">
            <nav class="navbar navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Home</a>
            </nav>
        </header>
        <section id="content" class="container">
            <div id="app"></div>
        </section>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
