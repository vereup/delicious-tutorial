@extends('layouts.adminMain')

@section('content')

<div class="py-1" style="background-color: #E5E5E5">
    <form method="POST" id="registForm" action="{{ route('registStore') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column docs-highlight p-3 mt-3 mb-1 w-50" style="background:white;">
                        <div class="p-2 docs-highlight border-bottom">
                            <h5 class="fw-bold fs-3">맛집등록</h5>
                        </div>


                        <div class="p-2 docs-highlight">
                            <label for="name" class="form-label">가게 이름</label>
                            <input type="text" class="form-control" id="storeName" name="storeName" placeholder="맛집 레스토랑">
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="storeIntro" class="form-label">가게 소개</label>
                            <textarea type="text" class="form-control" id="storeIntro" name="storeIntro" placeholder="가게 소개"></textarea>
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="category" class="form-label">카테고리</label>
                            <select name="category_id" class="form-select" id="category_id">
                            <option selected>카테고리</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="address" class="form-label">주소</label>
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" onchange="selectCity(event)" name="adminCity" id="cityList">
                                  <option value="">광역시도</option>
                                  @foreach ($cities as $city)
                                  <option value="{{ $city->id }}">
                                    {{ $city->city}}</option>
                                  @endforeach
                                </select>
                                <span class="px-3"></span>
                                <select class="form-select countyList" aria-label="Default select example" name="adminCounty" id="countyList">
                                  <option value="none">시/군/구</option>
                                  @if (isset($_REQUEST['adminCity']) && ($_REQUEST['adminCity']) != null)
                                  @foreach ($counties as $county)
                                    @if ($county->city_id == ($_REQUEST['adminCity']))
                                    <option value="{{ $county->id }}">
                                    {{ $county->county }}</option>
                                    @endif
                                    @endforeach
                                  @else
                                  @foreach ($counties as $county)
                                  <option value="{{ $county->id }}">
                                    {{ $county->county }}</option>
                                    @endforeach
                                  @endif
                                </select>
                            </div>
                            <input type="text" class="form-control mt-3" id="addressDetail" name="addressDetail" placeholder="상세주소">
                        </div>


                        <div class="p-2 docs-highlight">
                            <label for="address" class="form-label">전화번호</label>
                            <div class="input-group">
                                <select class="form-select" aria-label="Default select example" name="localCode" id="localCode">
                                  <option value="">지역번호</option>
                                  @foreach ($localCodes as $localCode)
                                  <option value="{{ $localCode->id }}">
                                    {{ $localCode->number }}</option>
                                  @endforeach
                                </select>
                                <span class="px-2"></span>
                                <input type="text" class="form-control" id="middleNumber" name="middleNumber">
                                <span class="px-3 align-self-center">-</span>
                                <input type="text" class="form-control" id="lastNumber" name="lastNumber">
                            </div>
                        </div>

                        <div class="p-2 docs-highlight file-select">
                            <label for="address" class="form-label" id="fileSelectForm" value="1">사진</label>
                            @for($i=1;$i<=5;$i++)
                            <div class="input-group mb-3 fileSelect" id="fileSelect{{ $i }}" @if($i != 1) hidden @endif>
                                <input type="text" class="form-control bg-white" name="filename{{ $i }}" disabled="disabled" placeholder="파일선택" value="" id="fileName{{ $i }}">
                                <button class="btn btn-outline-secondary btn-dark" type="button" onclick="chooseFile({{ $i }});">
                                    <span style="color: white;">파일선택</span>
                                </button>                                
                                <button class="btn btn-outline-secondary btn-white rounded-end" style="width: 40px;" type="button" id="addFileSelect{{ $i }}" value="{{ $i }}" @if($i == 1) onclick="addFileList()"@else onclick="deleteFileList({{ $i }}) @endif">
                                    <span style="color: black;" id="icon1">@if($i== 1)+@else-@endif</span>
                                </button>                                
                                <input type="file" class="form-control" hidden id="inputFile{{ $i }}" data-id="{{ $i }}" name="inputFile{{ $i }}" onchange="sendFile(this)">
                            </div>
                            @endfor


                        </div>

                        {{-- <div class="p-2 docs-highlight file-select">
                            <label for="address" class="form-label" id="fileSelectForm" value="1">사진</label>
                            <div class="input-group mb-3 fileSelect" id="fileSelect1">
                                <input type="text" class="form-control bg-white" name="filename1" disabled="disabled" placeholder="파일선택" value="" id="fileName1">
                                <button class="btn btn-outline-secondary btn-dark" type="button" id="fileSelect1" value="1" onclick="chooseFile(this.value);">
                                    <span style="color: white;">파일선택</span>
                                </button>                                
                                <button class="btn btn-outline-secondary btn-white rounded-end" style="width: 40px;" type="button" id="addFileSelect1" value="1" onclick= "addFileList()">
                                    <span style="color: black;" id="icon1">+</span>
                                </button>                                
                                <input type="file" class="form-control" hidden id="inputFile1" data-id="1" name="inputFile1" onchange="sendFile(this)">
                            </div>
                        </div> --}}
                        <p class="ps-3" style="color:#BDBDBD">* 사진은 최대 5장 까지 등록 가능합니다. (jpg, jpeg, png)</p>

                        <div class="d-flex flex-wrap gap-3" id="imageThumnail">
                            @for($i=1;$i<=5;$i++)
                            <div class="img-thumbnail" id="thumbnail{{ $i }}" style="width: 30%;" hidden>
                                <img style="width: 100%;" src="">
                            </div>
                            @endfor
                        </div>
                        <div class="d-grid gap-2 py-3 px-2">
                            <button type="button" class="btn btn-primary btn-dark rounded-pill"  id="signupButton" onclick="formCheck(event);">맛집 등록</button>
                            <button type="button" hidden id="modalOpen" data-coreui-toggle="modal" 
                            data-coreui-target="#registCheckModal"></button>
                        </div>
                        </div>

                    </div>
            </div>  


        {{-- 맛집등록 확인 모달 --}}
        <div class="modal" tabindex="-1" id="registCheckModal">
            <div class="modal-dialog modal-dialog-centered modalSize350">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="fw-bold" style="vertical-align: middle;text-align:center;">맛집을 등록하시겠습니까?</span>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
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
        $.ajax({
            type : 'GET',
            url : "{{ route('checkId') }}",
            data : {
                'checkEmail' : checkEmail,
            },
            success : function(data) {
                if(data) {
                    if(data == 'ok') {
                        console.log(data);
                        alert('가입 가능한 이메일입니다.');
                        $('#emailSignup').attr('style', 'border: solid green;');
                        $('#emailCheck').val('check');
                        
                    }
                    else if(data == 'duplicate') {
                        console.log(data);
                        alert('사용중인 이메일주소가 있습니다.');
                        $('#emailSignup').attr('style', 'border: solid red;');
                        $('#emailCheck').val('duplicate');
    
                    }
                }
            },
            error : function(error) {
                console.log(error);
            }
        });
    }
}

function formCheck(event){

    event.preventDefault();
    let form = $('#registForm');
    let storeName = $('#storeName').val();
    let storeIntro = $('#storeIntro').val();
    let categoryId = $('#category_id').val();
    let cityId = $('#cityList').val();
    let countyId = $('#countyList').val();
    let addressDetail = $('#addressDetail').val();
    let localCode = $('#localCode').val();
    let middleNumber = $('#middleNumber').val();
    let lastNumber = $('#lastNumber').val();
    let firstImgPath = $('#fileName1').attr('placeholder');

    var storeNameLength = storeName.length;
    var storeIntroLength = storeIntro.length;

    var regMiddleNumber = /\d{3,4}/;
    var regLastNumber = /\d{4}/;

    console.log(form);
    console.log(storeName.length);
    console.log(storeIntro);
    console.log(categoryId);
    console.log(cityId);
    console.log(countyId);
    console.log(addressDetail);
    console.log(localCode);
    console.log(middleNumber);
    console.log(lastNumber);
    console.log(firstImgPath);
    
    if (storeName = null){
        alert('가게 이름을 입력해주세요.');
            return false;
    }

    else if (storeNameLength < 1){
        alert('가게 이름을 1자 이상 입력해주세요.');
            return false;
    }

    else if (storeNameLength >= 30){
        alert('가게 이름을 30자 이하로 입력해주세요.');
            return false;
    }

    else if (storeIntro = null){
        alert('가게 소개를 입력해주세요.');
            return false;
    }

    else if (storeIntroLength < 10){
        alert('가게 소개를 10자 이상 입력해주세요.');
            return false;
    }

    else if (storeIntroLength >= 300){
        alert('가게 소개를 300자 이하로 입력해주세요.');
            return false;
    }

    else if (categoryId == '카테고리'){
        alert('카테고리를 선택해주세요.');
            return false;
    }

    else if (cityId == ''){
        alert('시도를 선택해주세요.');
            return false;
    }

    else if (countyId == ''){
        alert('시군구를 선택해주세요');
            return false;
    }

    else if (addressDetail == ''){
        alert('상세주소를 입력해주세요');
            return false;
    }

    else if (localCode == ''){
        alert('지역번호를 선택해주세요');
            return false;
    }

    else if (middleNumber == '' || lastNumber == ''){
        alert('전화번호를 형식에 맞게 입력해주세요');
            return false;
    }


    // else if (middleNumber == '' || lastNumber == '' || regMiddleNumber.test(middleNumber) == false || regLastNumber.test(regLastNumber) == false){
    //     alert('전화번호를 형식에 맞게 입력해주세요');
    //         return false;
    // }

    else if (firstImgPath == '파일선택'){
        alert('사진을 최소 1장이상 등록해주세요.');
            return false;
    }

    $('#modalOpen').click();

};


// 시도 선택시 시군구 요소값 변경
function selectCity(event){

var cityId = event.target.value;
var counties = @JSON($counties);

console.log(counties);
//시군구 요소 초기화
var countyList = document.querySelector('.countyList');
while(countyList.hasChildNodes()){
    countyList.removeChild(countyList.firstChild);
}

//시군구 요소들 추가
for(i=0;i<counties.length;i++){
    if(counties[i].city_id == cityId){
        var countyElement = document.createElement('option');
        countyElement.value = counties[i].id;
        countyElement.innerText = counties[i].county;

        console.log(countyElement);

        countyList.appendChild(countyElement);
    }
    else{
        console.log(counties[i].city_id);
    }
}
}

function chooseFile(num){
    console.log(num);
    $('#inputFile'+num).click();
}

// 퍼온코드응용 check 파일이름 얻기
function sendFileFunction(obj) {
    var fileObj, pathHeader , pathMiddle, pathEnd, allFilename, fileName, extName;
    
    // check
    if(obj == "[object HTMLInputElement]") {
        fileObj = obj.value
    } else {
        fileObj = document.getElementById(obj).value;
    }

    if (fileObj != "") {
            pathHeader = fileObj.lastIndexOf("\\");
            pathMiddle = fileObj.lastIndexOf(".");
            pathEnd = fileObj.length;
            fileName = fileObj.substring(pathHeader+1, pathMiddle);
            extName = fileObj.substring(pathMiddle+1, pathEnd);
            allFilename = fileName+"."+extName;

            // if(stype == "all") {
                    return allFilename; // 확장자 포함 파일명
            // } else if(stype == "name") {
            //         return fileName; // 순수 파일명만(확장자 제외)
            // } else if(stype == "ext") {
            //         return extName; // 확장자
            // } else {
            //         return fileName; // 순수 파일명만(확장자 제외)
            // }
    } 

    else {
            alert("파일을 선택해주세요");
            return false;
    }
    // getCmaFileView(this,'name');
    // getCmaFileView('upFile','all');
}

function sendFile(obj) {
    var num = obj.getAttribute('data-id');
    console.log(num);
    var s = sendFileFunction(obj);
    $('#fileName'+num).attr('placeholder', s);
    addThumnail(obj, num);
}

// 파일선택시 파일추가
function addFileList(){

    var fileCount = $('.fileSelect:visible').length+1;
    console.log(fileCount);

    if(fileCount <= 5){
        $('#fileSelect'+fileCount).removeAttr('hidden');
        if(fileCount >= 5){
            $('#icon1').text('');
        }
    }

    else{
        alert('이미지는 최대 5개까지 업로드 가능합니다.');
    }
}

// 파일선택 지우기
function deleteFileList(value){

    var fileCount = $('.fileSelect:visible').length;
    console.log(fileCount);

    $('#fileSelect'+fileCount).attr('hidden','');
    $('#thumbnail'+fileCount).attr('hidden','');

    if(fileCount <= 5){
            $('#icon1').text('+');
    }

}


// 추가형
// function deleteFileList(value){

//     var fileCount = $('.fileSelect').length;
    
//     var fileForm = document.querySelector('#fileSelect'+value);
//     fileForm.remove();
//     $("#thumbnail"+value).remove();

//     var oldValue = document.getElementById('fileSelectForm').getAttribute('value');
//     var newValue = Number(oldValue) + 1;
//     $('#fileSelectForm').attr('value', newValue);

//     if(fileCount <= 5){
//             $('#icon1').text('+');
//         }

// }


function addThumnail(e, number){

console.log(e);
var imageForm = document.querySelector('.imageThumnail');
var reader = new FileReader();

console.log(reader);
console.log(e.files[0]);

reader.readAsDataURL(e.files[0]);
reader.onload = function  () {
    var tempImage = new Image();
    tempImage.src = reader.result;
    tempImage.onload = function () {
        var canvas = document.createElement('canvas');
        var canvasContext = canvas.getContext("2d");
        canvas.width = 100; 
        canvas.height = 100;
        canvasContext.drawImage(this, 0, 0, 100, 100);
        var dataURI = canvas.toDataURL("image/jpeg");

        $("#thumbnail"+number).removeAttr('hidden');
        $("#thumbnail"+number).children('img').attr('src',dataURI);

    };
};
}


// // 추가형 썸내일추가
// function addThumnail(e, number){

//     console.log(e);
//     var imageForm = document.querySelector('.imageThumnail');
//     // var imgElementFirst = document.createElement('img');
//     // imgElementFirst.className = "img-thumbnail";
//     // imgElementFirst.setAttribute('src', path);
//     // imageForm.appendChild(imgElementFirst);

//     var reader = new FileReader();

//     console.log(reader);
//     console.log(e.files[0]);

//     reader.readAsDataURL(e.files[0]);
//     reader.onload = function  () {
//         var tempImage = new Image();
//         tempImage.src = reader.result;
//         tempImage.onload = function () {
//             var canvas = document.createElement('canvas');
//             var canvasContext = canvas.getContext("2d");
//             canvas.width = 100; 
//             canvas.height = 100;
//             canvasContext.drawImage(this, 0, 0, 100, 100);
//             var dataURI = canvas.toDataURL("image/jpeg");
//             if ($("#thumbnail"+number).length){
//                 $("#thumbnail"+number).remove();
//                 var imageThumnail= document.querySelector('#imageThumnail');
//                 var imgElement = document.createElement('div');
//                 imgElement.className = "img-thumbnail";
//                 imgElement.setAttribute('id', 'thumbnail'+number);
//                 imgElement.setAttribute('style', 'width: 30%;');
//                 imageThumnail.appendChild(imgElement);
//                 var imgTag = "<img style='width: 100%;' src='"+dataURI+"'/>";
//                 $("#thumbnail"+number).append(imgTag);
//             }

//             else{
//                 var imageThumnail= document.querySelector('#imageThumnail');
//                 var imgElement = document.createElement('div');
//                 imgElement.className = "img-thumbnail";
//                 imgElement.setAttribute('id', 'thumbnail'+number);
//                 imgElement.setAttribute('style', 'width: 30%;');
//                 imageThumnail.appendChild(imgElement);
//                 var imgTag = "<img style='width: 100%;' src='"+dataURI+"'/>";
//                 $("#thumbnail"+number).append(imgTag);

//             }
//         };
//     };
// }



// function addThumnail(e, number){

// console.log(e);


// var imageForm = document.querySelector('.imageThumnail');
// // var imgElementFirst = document.createElement('img');
// // imgElementFirst.className = "img-thumbnail";
// // imgElementFirst.setAttribute('src', path);
// // imageForm.appendChild(imgElementFirst);

//     var reader = new FileReader();

//     console.log(reader);
//     console.log(e.files[0]);

//     reader.readAsDataURL(e.files[0]);
//     reader.onload = function  () {
//         var tempImage = new Image();
//         tempImage.src = reader.result;
//         tempImage.onload = function () {
//             var canvas = document.createElement('canvas');
//             var canvasContext = canvas.getContext("2d");
//             canvas.width = 100; 
//             canvas.height = 100;
//             canvasContext.drawImage(this, 0, 0, 100, 100);
//             var dataURI = canvas.toDataURL("image/jpeg");
//             var imageThumnail= document.querySelector('#imageThumnail');
//             console.log(imageThumnail);
//             var imgElement = document.createElement('div');
//             imgElement.className = "img-thumbnail";
//             imgElement.setAttribute('id', 'thumbnail'+number);
//             imageThumnail.appendChild(imgElement);
// var imgTag = "<img style='width: 35%;' src='"+dataURI+"'/>";
//             $("#thumbnail"+number).append(imgTag);
//         };

//     };


// }






// function checkDuplicate() {

    
//     let email = $('#emailSignup').val();
//     let form = $('<form>@csrf');
//     form.attr("method", "post");
//     form.attr("action", "{{ route('checkId') }}");

//     let field = $('<input>');
//     field.attr("type", "hidden");
//     field.attr("name", "emailPost");
//     field.attr("value", $('#emailSignup').val());
//     form.append(field);

//     $(document.body).append(form);
//     form.submit();

//     alert($checkEmail);

// }




// function checkDuplicate() {

// event.preventDefault();
// $('#emailPost').val($('#emailSignup').val());
// alert($('#emailPost').val());
// $('#checkEmail').submit();

// }

</script>
