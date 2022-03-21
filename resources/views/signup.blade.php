@extends('layouts.main')

@section('content')

<div class="py-1" style="background-color: #E5E5E5">
    <form method="POST" id="signupForm" action="{{ route('register') }}">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column docs-highlight p-3 mt-3 mb-1 w-50" style="background:white;">
                        <div class="p-2 docs-highlight border-bottom">
                            <h5 class="fw-bold fs-3">회원가입</h5>
                        </div>
                        <div class="p-2 docs-highlight mt-4">
                            <label for="email" class="form-label">이메일</label>
                            <div class="input-group">
                                <input id="emailSignup" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" autofocus placeholder="test@gmail.com" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- 중복체크기능구현 --}}
                                <button class="btn btn-outline-secondary btn-dark" type="button" id="emailCheck" value="">
                                    <span style="color: white;" onclick = "checkDuplicate();">중복체크</span>
                                </button>
                            </div>
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="password" class="form-label">비밀번호</label>
                            <input id="passwordSignup" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="6~12자리 숫자, 영문">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="password-confirm" class="form-label">비밀번호확인</label>
                            <input id="passwordCheck" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="6~12자리 숫자, 영문">
                        </div>
                        <div class="p-2 docs-highlight">
                            <label for="name" class="form-label">이름</label>
                            <input type="text" class="form-control" id="name"  @error('name') is-invalid @enderror name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="이름">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2 docs-highlight">
                            <input class="form-check-input ms-3" type="checkbox" id="agreeCheck" name="agreeCheck">
                            <label class="form-check-label ms-2" for="agreeCheck">
                                서비스 이용약관 및 개인정보 처리 방침 동의
                            </label>
                        </div>
                        <div class="d-grid gap-2 py-3 px-2">
                            <button type="button" class="btn btn-primary btn-dark rounded-pill"  id="signupButton" onclick="formCheck(event);">회원가입</button>
                            <button type="button" hidden id="modalOpen" data-coreui-toggle="modal" 
                            data-coreui-target="#signCheckModal">My Button</button>
                        </div>
                    </div>
            </div>  
        {{-- 회원가입확인모달 --}}
        <div class="modal" tabindex="-1" id="signCheckModal">
            <div class="modal-dialog modal-dialog-centered modalSize350">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="fw-bold" style="vertical-align: middle;text-align:center;">입력하신 정보로 회원가입하시겠습니까?</span>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" class="btn btn-dark rounded-pill btn-primary">{{ __('회원가입') }}</button>
                        <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
                        data-coreui-dismiss="modal">취소</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- 회원가입확인모달 끝 --}}
    </form>
</div>
@endsection

<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>


//클릭시 이메일 중복검사

function checkDuplicate(event) {

    let checkEmail = $('#emailSignup').val();
    let regEmail = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;

    if(regEmail.test(checkEmail)!=true){
        alert('이메일 형식에 맞게 입력해주세요');
        $('#emailSignup').attr('style', 'border: solid red;')
        return false;
    }

    else {
        // fetch
        
        var url = '{{ route('checkId') }}/'+checkEmail;
        console.log(url);
        fetch(url)
        .then( async (response) => await response.json())
        .then( response => {
            if(response.status == 'ok'){
                alert('가입 가능한 이메일입니다.');

                // coreui validation : 전체 폼 validation시
                $('#emailSignup').attr('style', 'border: solid green;');
                $('#emailCheck').val('check');
            }
            else{
                alert('사용중인 이메일주소가 있습니다.');
                $('#emailSignup').attr('style', 'border: solid red;');
                $('#emailCheck').val('duplicate');
            }
        })
        .catch((error) => console.log(error));
        

        // // ajax
        // $.ajax({
        //     type : 'GET',
        //     url : "{{ route('checkId') }}",
        //     data : {
        //         'checkEmail' : checkEmail,
        //     },
        //     success : function(data) {
        //         if(data) {
        //             if(data == 'ok') {
        //                 console.log(data);
        //                 alert('가입 가능한 이메일입니다.');
        //                 $('#emailSignup').attr('style', 'border: solid green;');
        //                 $('#emailCheck').val('check');
                        
        //             }
        //             else if(data == 'duplicate') {
        //                 console.log(data);
        //                 alert('사용중인 이메일주소가 있습니다.');
        //                 $('#emailSignup').attr('style', 'border: solid red;');
        //                 $('#emailCheck').val('duplicate');
    
        //             }
        //         }


            // },
            // error : function(error) {
            //     console.log(error);
            // }
        // });


    }
}

function formCheck(event){

    event.preventDefault();
    let form = $('#signupForm');
    let email = $('#emailSignup').val();
    let password = $('#passwordSignup').val();
    let passwordConfirm = $('#passwordCheck').val();
    let name = $('#name').val();

    console.log(password);

    var regPassword = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,12}$/;


    
    if (email = null){
        alert('이메일을 입력해주세요.');
            return false;
    }

    else if($('#emailCheck').val() != 'check' && $('#emailCheck').val() != 'duplicate'){
        alert('이메일을 중복체크를 해주세요.');
            return false;
    }

    else if($('#emailCheck').val() == 'duplicate'){
        alert('이미 가입되어있는 이메일입니다. 다시 중복체크를 해주세요.');
            return false;
    }

    else if (password == ''){
        alert('비밀번호를 입력해주세요.');
            return false;
    } 
    
    else if(regPassword.test($('#passwordSignup').val())!=true){
        alert('비밀번호를 6자리 이상, 12자리 이하, 숫자와 영문을 포함해 설정해주세요.');
            return false;
    } 
    
    else if($('#passwordSignup').val() != $('#passwordCheck').val()){
        alert('비밀번호가 일치하지 않습니다.');
            return false;
    }

    else if (name.length <= 0){
        alert('이름을 입력해주세요.');
            return false;
    } 

    else if(!document.querySelector('#agreeCheck').checked){
        alert('서비스이용약관 동의를 해주세요.');
        return false;
    }

    $('#modalOpen').click();

};


</script>
