<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CoreUI for Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/css/coreui.min.css" rel="stylesheet">

    <style>
#sidebar{
    background: black
}
    </style>

    <title>Delicious</title>
</head>
<body class="c-app">
    <div class="c-sidebar">
    </div>

    <div class="c-wrapper">
        <header class="c-header">

            <div class="header">
                <a class="header-brand" href="#">
                    <img src="..." alt="" width="22" height="24" class="d-inline-block align-top" alt="CoreUI Logo">
                    CoreUI
                </a>
                <button class="header-toggler" type="button">
                    <span class="header-toggler-icon"></span>
                </button>
                <ul class="header-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Link
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="headerDropdown" role="button" data-coreui-toggle="dropdown" aria-expanded="false">
                        Dropdown
                        </a>
                    <div class="dropdown-menu" aria-labelledby="headerDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>      
        </header>

    <div class="c-body">
        <main class="c-main">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="sidebar enable-rounded enalbe-shadow main-color" style="width:300px">
                            <ul class="list-group">
                                <li class="list-group-item" style="background: #455A64;">
                                    카테고리
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    First checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Second checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Third checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Fourth checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Fifth checkbox
                                </li>
                            </ul>
                        </div>
                        <div class="rating" style="width:300px">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    First checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Second checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Third checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Fourth checkbox
                                </li>
                                <li class="list-group-item">
                                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                    Fifth checkbox
                                </li>
                            </ul>
                        </div>
                        </div>
                  <div class="col">
                    <div class="contents">
                        {{-- 맛집카드 --}}
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body" style="height: 350px;
                            width: 275px;
                            left: 2284px;
                            top: -87px;
                            border-radius: 10px;
                            ">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>  
        </main>
    </div>
    
    <footer class="c-footer">
        <footer class="footer">
            <div>
              <a href="https://coreui.io">CoreUI</a>
              <span>&copy; 2021 creativeLabs.</span>
            </div>
            <div>
              <span>Powered by</span>
              <a href="https://coreui.io">CoreUI</a>
            </div>
          </footer>    </footer>
    </div>



    <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.bundle.min.js"></script>
</body>


</html>