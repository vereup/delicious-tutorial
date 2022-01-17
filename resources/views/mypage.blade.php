<!doctype html>
<html lang="ko">
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

    <body class="c-app">
        <div class="c-sidebar"></div>

        <div class="c-wrapper">
            <header class="c-header">
                @include('header')
            </header>

            <div class="c-body" style="background-color: #E5E5E5">

                <div class="container p-2">
                    <div class="d-flex flex-column" style="background-color: white">
                        <div class="p-2 docs-highlight">
                            <p class="fs-2 fw-bold p-4">테스트님 &#40;id@email.com&#41;</p>
                        </div>
                        <div class="p-2 docs-highlight">
                            <ul class="nav nav-pills mb-2 border-bottom" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link active"
                                        id="myReview-tab"
                                        data-coreui-toggle="pill"
                                        data-coreui-target="#myReview"
                                        type="button"
                                        role="tab"
                                        aria-controls="pills-home"
                                        aria-selected="true"
                                        style="width:220px;height:75px;">내 리뷰</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button
                                        class="nav-link"
                                        id="wishList-tab"
                                        data-coreui-toggle="pill"
                                        data-coreui-target="#wishList"
                                        type="button"
                                        role="tab"
                                        aria-controls="pills-profile"
                                        aria-selected="false"
                                        style="width:220px;height:75px;">찜 목록</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                <div
                                    class="tab-pane fade show active"
                                    id="myReview"
                                    role="tabpanel"
                                    aria-labelledby="myReview-tab">
                                    <div class="row">
                                        <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">내 리뷰 &#40;리뷰개수&#41;</h2>
                                    </div>
                                    <div class="d-flex border-top border-bottom">
                                        <div class="col-9 ps-3 py-2">
                                            <p class="card-text">2일전</p>
                                            <h5 class="card-title">카츠샌드짱</h5>
                                            <p class="card-text">엄청맛있어요~!</p>
                                            <p class="card-text">방문 날짜 : 2021-09-10</p>
                                        </div>
                                        <div class="col-auto pt-5">
                                            <button
                                                type="submit"
                                                class="btn btn-primary fs-4 btn-dark rounded-pill"
                                                style="width: 117px; height:60px;"
                                                data-coreui-target="#modifyModal"
                                                data-coreui-toggle="modal">수정</button>
                                            <button
                                                type="submit"
                                                class="btn btn-secondary fs-4 btn-gray text-white rounded-pill ms-2"
                                                style="width: 117px; height:60px;"
                                                data-coreui-target="#deleteCheckModal"
                                                data-coreui-toggle="modal">삭제</button>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="tab-pane fade"
                                    id="wishList"
                                    role="tabpanel"
                                    aria-labelledby="wishList-tab">
                                    <div class="row">
                                        <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">찜 목록 &#40;찜개수&#41;</h2>
                                    </div>
                                    <div class="d-flex border-top border-bottom">
                                        <div class="col-2 ps-3 py-2">
                                            <img src="..." class="img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-9 ps-3 py-2">
                                            <h5 class="card-title">베이커리&샌드위치</h5>
                                            <div>
                                                <img src="/images/star.png">&#40;리뷰개수&#41;
                                            </div>
                                            <p class="card-text">주소</p>
                                        </div>
                                        <div class="col-auto pt-4">
                                            {{-- 찜버튼 --}}
                                            <button
                                                class="p-2 bg-white"
                                                style="border: 1px solid #A0A0A0; border-radius: 50%;"
                                                data-coreui-target="#wishDeleteCheckModal"
                                                data-coreui-toggle="modal">
                                                <div>
                                                    <img src="/images/redheart.png" width="25" height="25"></a>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="...">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link"><</a> </li> <li class="page-item"><a class="page-link"
                                        href="#">1</a></li> <li class="page-item active" aria-current="page"> <a
                                        class="page-link" href="#">2</a> </li> <li class="page-item"><a
                                        class="page-link" href="#">3</a></li> <li class="page-item"> <a
                                        class="page-link" href="#">></a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
                {{-- 리뷰삭제 확인 모달 --}}
                <div class="modal" tabindex="-1" id="deleteCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">리뷰를 삭제하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 리뷰 수정 모달 --}}
                <div class="modal" tabindex="-1" id="modifyModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold fs-3">리뷰수정</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="reviewTitle" class="form-label">제목</label>
                                    <input type="email" class="form-control" id="reviewTitle" placeholder="제목">
                                </div>
                                <div class="mb-3">
                                    <label for="reviewContents" class="form-label">내용</label>
                                    <textarea class="form-control" id="reviewContents" rows="7" placeholder="내용"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button
                                    type="button"
                                    class="btn btn-dark rounded-pill btn-primary px-4"
                                    data-coreui-target="#modifyCheckModal"
                                    data-coreui-toggle="modal">확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 수정 확인 모달 --}}
                <div class="modal" tabindex="-1" id="modifyCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">리뷰를 수정하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- 찜삭제 확인 모달 --}}
                <div class="modal" tabindex="-1" id="wishDeleteCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">찜 목록에서 삭제하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
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