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
                
                <a class="nav-link fw-bolder text-black" data-coreui-target="#loginModal" data-coreui-toggle="modal" style="cursor: pointer">Login
                    <span class="visually-hidden">(current)</span>
                </a>
        @else
            <li class="nav-item"> 
                <a class ="nav-link fw-bolder text-black" href="/admin/regist">맛집등록</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bolder text-black" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
        </ul>
        {{-- <div class="row col-3 px-3">
            <div class="input-group">
            <input class="form-control col-9" type="text" id="search" name="keyword"
             @if($keyword != null) value="{{ $keyword }}"@endif>
                <button class="btn btn-outline-secondary border-start-0 col-3 p-0 m-0" type="button" id="keywordButton"
                 onclick="go()">
                    <img src="/images/magnifying_glass.png" style="width: 20px; height: auto;"></button>
            </div>
            </div> --}}
</div>
            {{-- 로그인모달 --}}
            <div class="modal" id="loginModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold fs-3">로그인</h5>
                            <div data-coreui-dismiss="modal" aria-label="Close" style="cursor: pointer">
                                <span class="fw-bold">X</span>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            <div class="modal-body">
                                
                                    @csrf
                                <label for="email" class="form-label my-1">{{ __('이메일') }}</label>
                                <input
                                    type="email" class="form-control my-1 @error('email') is-invalid @enderror"
                                    id="email"
                                    placeholder="id@email.com" autofocus name="email" value="{{ old('email') }}" required autocomplete="email" >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="form-label mt-2 my-1">{{ __('비밀번호') }}</label>
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
                                    data-coreui-dismiss="modal">{{ __('로그인') }}</button>
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


<script>

// console.log($(location).attr('pathname'));

function go(){
    location.href = "/?keyword=" + $("#search").val();
}

</script>
