<!doctype html>
<html lang="kr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CoreUI for Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/css/coreui.min.css"
            rel="stylesheet">

        <style></style>
        <title>Delicious</title>
    </head>

    <body class="c-app">
        <div class="c-sidebar"></div>

        <div class="c-wrapper">
            <header class="c-header">
                @include('header')
            </header>

            <div class="c-body" style="background-color: #E5E5E5">
                @include('body')
            </div>

            <footer class="c-footer">
                <div class="footer bg-white py-4 justify-content-center">
                    <div>
                        <span>Hug management &copy; 2021</span>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
        <script
            src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.bundle.min.js"></script>
    </body>
</html>