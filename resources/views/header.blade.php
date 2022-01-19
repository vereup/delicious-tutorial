<div class="header">
    <a class="header-brand flex-grow-1" href="/">
        <img
            src="/images/logo.png"
            width="50"
            height="50"
            class="d-inline-block ms-5"
            alt="Deliciuos Logo">
            <span class="align-middle fw-bolder fs-3 fst-italic">Delicious</span>
        </a>
        <button class="header-toggler" type="button">
            <span class="header-toggler-icon"></span>
        </button>

        <ul class="header-nav mr-auto align-items-end">
           <li class="nav-item active"> 
                <a class="nav-link" data-coreui-target="#loginModal" data-coreui-toggle="modal" style="cursor: pointer">Login
                    <span class="visually-hidden">(current)</span>
                </a>

            <li class="nav-item"> 
                <a class ="nav-link" href="/mypage">Mypage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Logout</a>
            </li>
        </ul>
        <form class="d-flex">
            <input
                class="form-control"
                type="search"
                id="search"
                style="border-top-right-radius: 0; border-bottom-right-radius: 0;">
                <button
                    class="btn btn-outline-secondary"
                    type="submit"
                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    <img src="/images/magnifying-glass.png"></button>
                </form>
            </div>
            {{-- 로그인모달 --}}
            <div class="modal" id="loginModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold fs-3">로그인</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-coreui-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="inputEmail" class="form-label my-1">이메일</label>
                            <input
                                type="email"
                                class="form-control my-1"
                                id="inputEmail"
                                placeholder="id@email.com">
                                <label for="inputPassword" class="form-label mt-2 my-1">비밀번호</label>
                                <input
                                    type="password"
                                    class="form-control my-1"
                                    id="inputPassword"
                                    placeholder="6~12자리 숫자 영문"></div>
                                <div class="modal-footer">
                                    <button
                                        type="submit"
                                        class="btn rounded-pill text-white"
                                        style="width:-webkit-fill-available;background: #455A64;"
                                        data-coreui-dismiss="modal">로그인</button>
                                    <button
                                        type="button"
                                        class="btn rounded-pill text-white"
                                        style="width:-webkit-fill-available;background: #A0A0A0;"
                                        onclick="window.location.href='/signup'">회원가입</button>
                                </div>
                            </div>
                        </div>
                    </div>