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
            <div class="rounded-circle mb-1 me-4 p-0 bg-white text-center" style="position:fixed;bottom:10px;right:10px;z-index:99999999; width: 40px; height: 40px; border: 1px solid #A0A0A0; border-radius: 50%; cursor:pointer;" 
            onclick="window.scrollTo(0,0);"><span class="fs-2">^</span></div>

        </main>

        <footer>
            @include('layouts.footer')
        </footer>

        <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.1.0/dist/js/coreui.bundle.min.js"></script>
    </body>
    
@yield('script')

</html>
