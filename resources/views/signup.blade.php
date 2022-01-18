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

                    <div class="row py-3">
                        <div class="col-3">
                            <div class="col"></div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column docs-highlight p-3 mb-3"
                                style="background:white;">
                                <div class="p-2 docs-highlight border-bottom">
                                    <h5 class="fw-bold fs-3">회원가입</h5>
                                </div>
                                <div class="p-2 docs-highlight">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                </div>
                                <div class="p-2 docs-highlight">
                                    <div class="input-group mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="test@email.com"
                                            aria-label="inputEmail4"
                                            aria-describedby="emailCheck">
                                        <button
                                            class="btn btn-outline-secondary btn-dark"
                                            type="button"
                                            id="emailCheck">
                                            <span style="color: white;">중복체크</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-2 docs-highlight">
                                    <label for="inputPassword4" class="form-label">비밀번호</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="inputPassword4"
                                        placeholder="비밀번호">
                                </div>
                                <div class="p-2 docs-highlight">
                                    <label for="inputPasswordCheck4" class="form-label">비밀번호확인</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="inputPasswordCheck4"
                                        placeholder="비밀번호확인">
                                </div>
                                <div class="p-2 docs-highlight">
                                    <label for="inputName4" class="form-label">이름</label>
                                    <input type="text" class="form-control" id="inputName4" placeholder="이름">
                                </div>
                                <div class="p-2 docs-highlight">
                                    <input class="form-check-input ms-3" type="checkbox" id="agreeCheck">
                                    <label class="form-check-label ms-2" for="agreeCheck">
                                        서비스 이용약관 및 개인정보 처리 방침 동의
                                    </label>
                                </div>
                                <div class="d-grid gap-2 py-3 px-2">
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-dark rounded-pill"
                                        data-coreui-toggle="modal"
                                        data-coreui-target="#signCheckModal">Sign in</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
                {{-- 회원가입확인모달 --}}
                <div class="modal" tabindex="-1" id="signCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">입력하신 정보로 회원가입하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button type="button" class="btn btn-dark rounded-pill btn-primary">회원가입</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
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

        <!-- Option 1: CoreUI for Bootstrap Bundle with Popper -->
        <script
            src="https://cdn.jsdelivr.net/npm/@coreui/coreui@4.0.2/dist/js/coreui.bundle.min.js"></script>
    </body>
</html>