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

        @guest
            <li class="nav-item active"> 
                
                <a class="nav-link" data-coreui-target="#loginModal" data-coreui-toggle="modal" style="cursor: pointer">Login
                    <span class="visually-hidden">(current)</span>
                </a>
        @else
            <li class="nav-item"> 
                <a class ="nav-link" href="/mypage">Mypage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
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
                        <form method="POST" action="{{ route('login') }}">
                            <div class="modal-body">
                                
                                    @csrf
                                <label for="email" class="form-label my-1">{{ __('E-Mail Address') }}</label>
                                <input
                                    type="email"
                                    class="form-control my-1 @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="id@email.com"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="form-label mt-2 my-1">{{ __('Password') }}</label>
                                <input
                                    type="password"
                                    class="form-control my-1 @error('password') is-invalid @enderror"
                                    id="password" name="password"
                                    placeholder="6~12자리 숫자 영문"
                                    required autocomplete="current-password">
                                    @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="submit"
                                    class="btn rounded-pill text-white"
                                    style="width:-webkit-fill-available;background: #455A64;"
                                    data-coreui-dismiss="modal">{{ __('Login') }}</button>
                                <button
                                    type="button"
                                    class="btn rounded-pill text-white"
                                    style="width:-webkit-fill-available;background: #A0A0A0;"
                                    onclick="window.location.href='/signup'">회원가입</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
