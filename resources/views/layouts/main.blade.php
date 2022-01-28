<!doctype html>
<html lang="ko">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
        <!-- CoreUI for Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/css/coreui.min.css"
            rel="stylesheet">

            <style>
                .modalSize350 {
                    width: 350px;
                }
                
                .nav-pills {
                    --cui-nav-link-color : black;
                    --cui-nav-pills-link-active-bg : #455A64;
                    --cui-nav-link-hover-color : black;
                }
                .pagination{
                    --cui-pagination-color: black;
                    --cui-pagination-active-bg: #455A64;
                    --cui-pagination-active-border-color:#455A64;
                }
    
            </style>
        <title>Delicious</title>
    </head>

    <body>
        <header>
            @include('layouts.header')
        </header>

        <main>
            @yield('content')
        </main>

        <footer>
            @include('layouts.footer')
        </footer>

        <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.bundle.min.js">
        </script>
    </body>
    
@yield('script')

</html>
