@extends('layouts.main')

@section('content')
{{-- <div class="c-header">{{ __('Register') }}</div> --}}
<div class="c-body" style="background-color: #E5E5E5">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-center"
                <div class="p-2 docs-highlight">
                    <div class="d-flex flex-column docs-highlight p-3 my-3 w-50" style="background:white;">
                        <div class="p-2 docs-highlight border-bottom">
                            <h5 class="fw-bold fs-3">회원가입</h5>
                        </div>
                     
                        <div class="p-2 docs-highlight mt-4">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                            <div class="input-group">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- 중복체크기능구현 --}}
                                <button class="btn btn-outline-secondary btn-dark" type="button" id="emailCheck">
                                    <span style="color: white;" onclick = "checkDuplicate(event.document.getElementById('email'))">중복체크</span>
                                </button>
                            </div>
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="비밀번호">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="비밀번호확인">
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name"  @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="이름">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2 docs-highlight">
                            <input class="form-check-input ms-3" type="checkbox" id="agreeCheck">
                            <label class="form-check-label ms-2" for="agreeCheck">
                                서비스 이용약관 및 개인정보 처리 방침 동의
                            </label>
                        </div>
                        <div class="d-grid gap-2 py-3 px-2">
                            <button type="button" class="btn btn-primary btn-dark rounded-pill" data-coreui-toggle="modal" 
                            data-coreui-target="#signCheckModal">Sign in</button>
                        </div>
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
                        
                        <button type="submit" class="btn btn-dark rounded-pill btn-primary">{{ __('Register') }}</button>
                        <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
                        data-coreui-dismiss="modal">취소</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- 회원가입확인모달 끝 --}}
        </div>
    </form>
</div>

@endsection
{{-- 
<script>

function checkDuplicate(email){
    let users = @json($users);
    users.forEach(user => {
        if(user->email == email){
            return 1;
        }
    });
}
</script> --}}
