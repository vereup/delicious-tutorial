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

        <style>
            .modalSize350 {
                width: 350px;
            }
        </style>
        <title>Delicious</title>
    </head>

    <body class="c-app">
        <div class="c-sidebar"></div>

        <div class="c-wrapper">
            <header class="c-header">
                @include('header')
            </header>

            <div class="c-body" style="background-color: #E5E5E5">

                <div class="container-fluid p-2">
                    <div class="d-flex flex-column docs-highlight bg-white">
                        <div class="d-flex">

                            <div class="col-11 ps-3 py-4">
                                <p class="card-title fs-3 fw-bold">베이커리&샌드위치
                                    <img src="/images/star.png">
                                    <span class="text" style="font-size: 10pt;">&#40;리뷰개수&#41;</span>
                                </p>
                                <p class="card-text pb-2"><img src="/images/location.png">&nbsp;주소
                                    <span class="fw-bold" style="color: #a0a0a0;">&nbsp;|</span>
                                    <img src="/images/telephone.png">&nbsp;&nbsp;전화번호
                                </p>
                            </div>
                            <div class="col-1 pt-5">
                                {{-- 찜버튼 --}}
                                <button
                                    class="p-2 bg-white"
                                    style="border: 1px solid #A0A0A0; border-radius: 50%;">
                                    <div>
                                        <img src="/images/redheart.png" width="25" height="25"></a>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="d-flex flex-row border-top border-bottom">
                            <div class="p-2 border-end">
                                <div
                                    id="carouselExampleFade"
                                    class="carousel slide carousel-fade"
                                    data-coreui-ride="carousel"
                                    style="width: 550px; height:350px;">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img
                                                src="/images/sample-1.png"
                                                class="d-block w-100"
                                                style="width: 550px; height:350px;"
                                                alt="..."></div>
                                        <div class="carousel-item">
                                            <img
                                                src="/images/star.png"
                                                class="d-block w-100"
                                                style="width: 550px; height:350px;"
                                                alt="..."></div>
                                        <div class="carousel-item">
                                            <img
                                                src="/images/telephone.png"
                                                class="d-block w-100"
                                                style="width: 550px; height:350px;"
                                                alt="..."></div>
                                    </div>
                                    <button
                                        class="carousel-control-prev"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button
                                        class="carousel-control-next"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="p-2 pt-3 ps-4">
                                <p class="text-start">
                                    카페 & 디저트</p>
                                <p class="text-start">
                                    베이커리 & 샌드위치 맛집 소개</p>
                            </div>
                        </div>

                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="row">
                            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;리뷰개수&#41;</h2>
                        </div>
                        <form class="pb-4">
                            <div class="row mb-3 px-2">
                                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">평점</p></label>
                                <div class="col-sm-11">
                                 <div>
                                    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;" id="rating1"> <img src="/images/emptystar.png"
                                    style="width:25px; height:25px;"></button>
                                    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;" id="rating2"> <img src="/images/emptystar.png"
                                    style="width:25px; height:25px;"></button>
                                    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;" id="rating3"> <img src="/images/emptystar.png"
                                    style="width:25px; height:25px;"></button>
                                    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;" id="rating4"> <img src="/images/emptystar.png"
                                    style="width:25px; height:25px;"></button>
                                    <button class="m-0 p-0" type="summit" style="background-color:transparent; border:transparent;" id="rating5"> <img src="/images/emptystar.png"
                                    style="width:25px; height:25px;"></button>
                                  </div>
                                </div>
                              </div>
                            <div class="row mb-3 px-2">
                              <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">제목</p></label>
                              <div class="col-sm-11">
                                <input type="text" class="form-control" id="inputTitle">
                              </div>
                            </div>
                            <div class="row mb-3 px-2">
                              <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                                <p style="font-size: 20px;">내용</p>
                                </label>
                              <div class="col-sm-11">
                                <textarea class="form-control" id="inputPassword3" rows="7"></textarea>
                              </div>
                            </div>
                            <div class="row px-3">
                                <center>
                                <button class="btn btn-dark rounded-pill w-50" type="button" data-coreui-target="#loginModal" 
                                data-coreui-toggle="modal">리뷰 작성
                                </center>
                                </div>
                            <div class="row mb-3 px-2">
                            <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                                <p style="font-size: 20px;">방문 일자</p>
                                </label>
                            <div class="col-sm-11">
                                <input type="" class="form-control" id="inputPassword3" rows="7"></textarea>
                            </div>
                            </div>    
                          </form>
                        <div class="d-flex border-top border-bottom">
                            <div class="col-9 ps-3 py-2">
                                <p class="card-text">2일전</p>
                                <h5 class="card-title">카츠샌드짱</h5>
                                <p class="card-text">엄청맛있어요~!</p>
                                <p class="card-text">방문 날짜 : 2021-09-10</p>
                            </div>
                        
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        pignation
                    </div>
                </div>
            </div>


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