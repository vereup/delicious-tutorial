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
            .modalSize350{
            width : 350px;
            }
        </style>
        <title>Delicious</title>
    </head>

    <body class="c-app">

        <div class="c-wrapper">
            <header class="c-header">
                @include('header')
            </header>

            <div class="c-body" style="background-color: #E5E5E5">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <div class="col"></div>
                        </div>
                        <div class="col-6">
                            <div class="col my-4" style="background:white;">
                                <form class="row">
                                    <div class="col-md-12 pt-3 pb-1 border-bottom">
                                        <h5 class="fw-bold fs-3" style="margin-left:30px;">회원가입</h5>
                                    </div>
                                </form>
                                <form class="row g-3">
                                    <div class="col-md-12 pt-3 px-5">
                                        <div class="row">
                                            <label for="inputEmail4" class="form-label">Email</label>
                                            <div class="col-9 pe-0">
                                                <label for="inputEmail4" class="visually-hidden">test@email.com</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="inputEmail4"
                                                    placeholder="id@email.com"
                                                    style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                            </div>
                                            <div class="col-auto p-0">
                                                <button
                                                    type="submit"
                                                    class="btn btn-dark"
                                                    style="width:100px; border-top-left-radius: 0; border-bottom-left-radius: 0;">중복체크</button>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- 중복체크완료시 체크표시 --}}
                                    <div class="col-md-12 px-5">
                                        <label for="inputPassword4" class="form-label">비밀번호</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="inputPassword4"
                                            placeholder="비밀번호">
                                    </div>
                                    {{-- 비밀번호체크시 확인 --}}
                                    <div class="col-md-12 px-5">
                                        <label for="inputPasswordCheck4" class="form-label">비밀번호확인</label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="inputPasswordCheck4"
                                            placeholder="비밀번호확인">
                                    </div>
                                    <div class="col-md-12 px-5">
                                        <label for="inputName4" class="form-label">이름</label>
                                        <input type="password" class="form-control" id="inputName4" placeholder="이름">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input ms-3" type="checkbox" id="agreeCheck">
                                            <label class="form-check-label ms-2" for="agreeCheck">
                                                서비스 이용약관 및 개인정보 처리 방침 동의
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-4">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <button type="button" class="btn btn-dark rounded-pill w-100 ms-3" 
                                            data-coreui-toggle="modal" data-coreui-target="#signCheckModal">Sign in</button>
                                        </div>
                                        <div class="col-2"></div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="col"></div>
                        </div>

                    </div>
                </div>
                {{-- 리뷰삭제확인모달 --}}
                <div class="modal" tabindex="-1" id="signCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">리뷰를 삭제하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button type="button" class="btn btn-dark rounded-pill btn-primary">회원가입</button>
                                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4" data-coreui-dismiss="modal">취소</button>
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