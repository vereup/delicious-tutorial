<!doctype html>
<html lang="ko">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="/js/jquery-3.6.0.js" crossorigin="anonymous"></script>

        <!-- CoreUI for Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/css/coreui.min.css"
            rel="stylesheet">

        <link rel="stylesheet" href="/css/custum.css">

        <title>Delicious</title>
    </head>

    <body>
        <header>
            @include('layouts.header')
        </header>

        <main>
            <div id="app">
                @include('flash-message')
            </div>

            @yield('content')
        </main>

        <footer>
            @include('layouts.footer')
        </footer>

        <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/js/coreui.bundle.min.js"></script>
    </body>
    
@yield('script')

</html>
