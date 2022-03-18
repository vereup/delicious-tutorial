@extends('layouts.adminMain')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="py-1" style="background-color: #E5E5E5">
    <form method="POST" id="registForm" action="{{ route('modifyStore') }}" enctype="multipart/form-data">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-center">
                    <div class="d-flex flex-column docs-highlight p-3 mt-3 mb-1 w-50" style="background:white;">
                        <div class="p-2 docs-highlight border-bottom">
                            <h5 class="fw-bold fs-3">맛집수정</h5>
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="name" class="form-label">가게 이름</label>
                            <input type="text" class="form-control" id="storeName" name="storeName" value="{{ $store->name }}"placeholder="맛집 레스토랑">
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="storeIntro" class="form-label">가게 소개</label>
                            <textarea type="text" class="form-control" id="storeIntro" name="storeIntro" placeholder="가게 소개">{{ $store->introduction }}
                            </textarea>
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="category" class="form-label">카테고리</label>
                            <select name="category_id" class="form-select" id="category_id">
                            <option selected>카테고리</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $store->category_id) selected @else @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="p-2 docs-highlight">
                            <label for="address" class="form-label">주소</label>
                            <div class="input-group">
                                <select class="form-select" style="border-radius: 3px" aria-label="Default select example" onchange="selectCity(event)" name="adminCity" id="cityList">
                                  <option value="">광역시도</option>
                                  @foreach ($cities as $city)
                                  <option value="{{ $city->id }}" @if($city->id == $store->county->city->id) selected @else @endif>
                                    {{ $city->city}}</option>
                                  @endforeach
                                </select>
                                <span class="px-3"></span>
                                <select class="form-select countyList" style="border-radius: 3px" aria-label="Default select example" name="adminCounty" id="countyList">
                                    <option value="none">시/군/구</option>
                                    @foreach ($counties as $county)
                                        <option value="{{ $county->id }}" @if($county->id == $store->county_id) selected @else @endif>
                                            {{ $county->county }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <input type="text" class="form-control mt-3" id="addressDetail" name="addressDetail" placeholder="상세주소" value="{{ $store->address_detail }}">
                        </div>


                        <div class="p-2 docs-highlight">
                            <label for="address" class="form-label">전화번호</label>
                            <div class="input-group">
                                <select class="form-select" style="border-radius: 3px" aria-label="Default select example" name="localCode" id="localCode">
                                  <option value="">지역번호</option>
                                  @foreach ($localCodes as $localCode)
                                  <option value="{{ $localCode->id }}" @if($localCode->id == $store->local_code_id) selected @else @endif>
                                    {{ $localCode->number }}</option>
                                  @endforeach
                                </select>
                                <span class="px-2"></span>
                                <input type="text" class="form-control" style="border-radius: 3px" id="middleNumber" name="middleNumber" value="{{ $middleNumber }}">
                                <span class="px-3 align-self-center">-</span>
                                <input type="text" class="form-control" style="border-radius: 3px" id="lastNumber" name="lastNumber" value="{{ $lastNumber }}">
                            </div>
                        </div>


                        <div class="p-2 docs-highlight file-select">
                            <label for="address" class="form-label" id="fileSelectForm">사진</label>
                            {{-- <input type="hidden" data-id="deletedFileList" name="deletedFileList">
                            <input type="hidden" data-id="changedFileList" name="changedFileList"> --}}
                            <input type="hidden" data-id="fileNameList" name="fileNameList">
                            {{-- <input type="hidden" data-id="orderList" name="orderList"> --}}
                            
                            
                            @for($i=0;$i<5;$i++)
                            @if($imageNames[$i] != "")
                            <div class="input-group mb-3 fileSelect" id="fileSelect{{ $i+1 }}" data-value="on" data-path="{{ $imageNames[$i] }}" data-order="{{ $i }}">
                                <input type="hidden" id="fileListCheck{{ $i+1 }}" name="fileListCheck{{ $i+1 }}" value="on">
                                <input type="text" class="form-control bg-white rounded-start" name="filename{{ $i+1 }}" disabled="disabled" placeholder="{{ $imageNames[$i] }}" value="{{ $imageNames[$i] }}" id="fileName{{ $i+1 }}">
                                <button class="btn btn-outline-secondary btn-dark" type="button" id="fileNameSelectButton{{ $i+1 }}" onclick="chooseFile({{ $i+1 }});">
                                    <span style="color: white;">파일선택</span>
                                </button>                                
                                <button class="btn btn-outline-secondary btn-white rounded-end" style="width: 40px;" type="button" id="addFileSelect{{ $i+1 }}" value="{{ $i+1 }}" data-old-index="{{ $i+1 }}" @if($i == 0) onclick="addFileList()"@else onclick="deleteFileList({{ $i+1 }}) @endif">
                                    <span style="color: black;" id="icon1">@if($i== 0)+@else-@endif</span>
                                </button>                                
                                <input type="file" class="form-control" hidden id="inputFile{{ $i+1 }}" data-id="{{ $i+1 }}" name="inputFile{{ $i+1 }}" onchange="sendFile(this)">
                            </div>
                            @else
                            <div class="input-group mb-3 fileSelect" id="fileSelect{{ $i+1 }}" hidden data-value="off">
                                <input type="hidden" id="fileListCheck{{ $i+1 }}" name="fileListCheck{{ $i+1 }}" value="off">
                                <input type="text" class="form-control bg-white rounded-start" name="filename{{ $i+1 }}" disabled="disabled" placeholder="파일선택" value="" id="fileName{{ $i+1 }}">
                                <button class="btn btn-outline-secondary btn-dark" type="button" id="fileNameSelectButton{{ $i+1 }}" onclick="chooseFile({{ $i+1 }});">
                                    <span style="color: white;">파일선택</span>
                                </button>                                
                                <button class="btn btn-outline-secondary btn-white rounded-end" style="width: 40px;" type="button" id="addFileSelect{{ $i+1 }}" value="{{ $i+1 }}" @if($i == 0) onclick="addFileList()"@else onclick="deleteFileList({{ $i+1 }}) @endif">
                                    <span style="color: black;" id="icon1">@if($i== 0)+@else-@endif</span>
                                </button>                                
                                <input type="file" class="form-control" hidden id="inputFile{{ $i+1 }}" data-id="{{ $i+1 }}" name="inputFile{{ $i+1 }}" onchange="sendFile(this)">
                            </div>
                            @endif
                            @endfor

                        </div>
                        <p class="ps-3" style="color:#BDBDBD">* 사진은 최대 5장 까지 등록 가능합니다. (jpg, jpeg, png)</p>

                        
                        <div class="p-2 docs-highlight">

                            <div class="row row-cols-3">
                                @for($i=0;$i<5;$i++)
                                @if($imageNames[$i] != "")
                                <div class="col mb-3" id="thumbnail{{ $i+1 }}">
                                    <img class="img-thumbnail align-middle" src="{{$store->images[$i]->path}}">
                                </div>
                                @else
                                <div class="col mb-3" id="thumbnail{{ $i+1 }}" hidden>
                                    <img class="img-thumbnail align-middle" src="">
                                </div>
                                @endif
                                @endfor
                            </div>
                        </div>

                        {{-- <div class="d-flex flex-wrap gap-3" style="justify-content: flex-start;" id="imageThumnail">
                            @for($i=0;$i<5;$i++)
                            @if($imageNames[$i] != "")
                            <div class="img-thumbnail" id="thumbnail{{ $i+1 }}" style="width: 30%; max-height:10%;" >
                                <img style="width: 100%; height:auto;" src="{{$store->images[$i]->path}}">
                            </div>
                            @else
                            <div class="img-thumbnail" id="thumbnail{{ $i+1 }}" style="width: 30%; max-height:30%;" hidden>
                                <img style="width: 100%; height:auto;" src="">
                            </div>
                            @endif
                            @endfor

                        </div> --}}
                        
                        
                        <div class="d-grid gap-2 py-3 px-2">
                            <button type="button" class="btn btn-primary btn-dark rounded-pill"  id="signupButton" onclick="formCheck(event);">맛집 수정</button>
                            
                            <button type="button" hidden id="modalOpen" data-coreui-toggle="modal" 
                            data-coreui-target="#registCheckModal"></button>
                        </div>
                        </div>

                    </div>
            </div>  


        {{-- 맛집수정 확인 모달 --}}
        <div class="modal" tabindex="-1" id="registCheckModal">
            <div class="modal-dialog modal-dialog-centered modalSize350">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <span class="fw-bold" style="vertical-align: middle;text-align:center;">맛집을 수정하시겠습니까?</span>
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
        <input hidden name="storeId" value="{{ $store->id }}">
    </form>
</div>
@endsection

<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>

//입력값 검사
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
    let secondImgPath = $('#fileSelect2').attr('data-path');
    let thirdImgPath = $('#fileSelect3').attr('data-path');
    let fourthImgPath = $('#fileSelect4').attr('data-path');
    let fifthImgPath = $('#fileSelect5').attr('data-path');
    let secondImgValue = $('#fileSelect2').attr('data-value');
    let thirdImgValue = $('#fileSelect3').attr('data-value');
    let fourthImgValue = $('#fileSelect4').attr('data-value');
    let fifthImgValue = $('#fileSelect5').attr('data-value');

    var storeNameLength = storeName.length;
    var storeIntroLength = storeIntro.length;

    // 

    // function makeFileList (order, path){
        
    //     class File {
    //         file(order, path){
    //         this.order = order;
    //         this.path = path;
    //         }
    //     }

    //     let tempfile = new file(order, path);
    //     let modifyFiles = modifyFiles.push(tempfile);
    //     console.log(modifyFiles);
    // }
    
    // let modifyFiles = new Array();

    for(i=1;i<=5;i++){
    let value = i;
    let order = $('#addFileSelect'+value).val();
    let filename = $('#thumbnail'+value).children().attr('src');


    // modifyFiles.push({order, filename});
    // console.log(modifyFiles);
    }

    //파일 이름과 순서 보내기

    let fileNameList = new Array();
    let orderList = new Array();
    $("div[data-value=on]").each(function(index, item){
        fileNameList.push($(item).attr('data-path'));
        orderList.push($(item).attr('data-order'));
    });
    
    console.log('fileNameListFormcheck:'+fileNameList);
    console.log('orderListFormcheck:'+orderList);
    
    fileNameList.join(", ");
    orderList.join(", ");
    
    $("input[data-id=fileNameList]").val(fileNameList);
    $("input[data-id=orderList]").val(orderList);





    // // 지운 이미지 확인 및 폼채우기

    // let deleteList = new Array();
    // $("button[data-delete=delete]").each(function(index, item){
    //     deleteList.push($(item).attr('data-old-index'));
    // });
    
    // console.log('deleteListFormcheck:'+deleteList);

    // deleteList.sort().join(", ");
    // $("input[data-id=deletedFileList]").val(deleteList);

    // console.log('deletevalue:'+$("input[data-id=deletedFileList]").val());

    // let changedList = new Array();
    // $("button[data-delete=changed]").each(function(index, item){
    //     changedList.push($(item).attr('data-old-index'));
    // });
    // console.log('changeListFormcheck:'+changedList);
    // changedList.sort().join(", ");
    // $("input[data-id=changedFileList]").val(changedList);

    // console.log('changevalue:'+$("input[data-id=changedFileList]").val());

    //전화번호 체크용
    var regMiddleNumber = /\d{3,4}/;
    var regLastNumber = /\d{4}/;
    
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

    else if (countyId == '' || countyId == 'none'){
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
        alert('전화번호를 입력해주세요');
            return false;
    }

    else if (regMiddleNumber.test(middleNumber) != true || regLastNumber.test(lastNumber) != true){
        alert('전화번호를 형식에 맞게 입력해주세요');
            return false;
    }

    else if (firstImgPath == 'none'){
        alert('사진을 최소 1장이상 등록해주세요.');
            return false;
    }
    else if (secondImgValue == 'on' && secondImgPath == 'none'){
        alert('두번째 사진을 등록해주세요.');
            return false;
    }
    else if (thirdImgValue == 'on' && thirdImgPath == 'none'){
        alert('세번째 사진을 등록해주세요.');
            return false;
    }
    else if (fourthImgValue == 'on' && fourthImgPath == 'none'){
        alert('네번째 사진을 등록해주세요.');
            return false;
    }
    else if (fifthImgValue == 'on' && fifthImgPath == 'none'){
        alert('다섯째 사진을 등록해주세요.');
            return false;
    }


    $('#modalOpen').click();
    // readFileList();
};


// 시도 선택시 시군구 요소값 변경
function selectCity(event){

var cityId = event.target.value;
console.log(cityId);

if(cityId == ''){

    console.log(cityId);

    //시군구 요소 초기화
    var countyList = document.querySelector('.countyList');
    while(countyList.hasChildNodes()){
    countyList.removeChild(countyList.firstChild);
    }
    //시군구 첫번째 요소 추가
    var countyElementFirst = document.createElement('option');
    countyElementFirst.value = "none";
    countyElementFirst.innerText = '시/군/구';
    countyList.appendChild(countyElementFirst);
}

else{
$.ajax({
        type : 'GET',
        url : "{{ route('selectCity') }}",
        data : {
            'cityId' : cityId,
        },
        success : function(data) {

            //시군구 요소 초기화
            var countyList = document.querySelector('.countyList');
            while(countyList.hasChildNodes()){
            countyList.removeChild(countyList.firstChild);
            }
            //시군구 첫번째 요소 추가
            var countyElementFirst = document.createElement('option');
            countyElementFirst.value = "none";
            countyElementFirst.innerText = '시/군/구';
            countyList.appendChild(countyElementFirst);

            //시군구 요소들 추가
            for(i=0;i<data.length;i++){
                var countyElement = document.createElement('option');
                countyElement.value = data[i].id;
                countyElement.innerText = data[i].county;
                countyList.appendChild(countyElement);
            }
        },
        
        error : function(error) {
            console.log(error);
        }
    });
    }
}

//파일선택클릭
function chooseFile(num){
    console.log(num);
    $('#inputFile'+num).click();

    // check 필요없어짐 지울예정
    // if($('#filename'+num).attr('placeholder') != '파일선택'){
    // // 지운이미지표시
    // var old = document.getElementById('addFileSelect'+num);
    // old.setAttribute("data-delete", "delete");
    // console.log(old.getAttribute('data-delete'));
    // }

}


// 파일 이름 얻기
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

            return allFilename; // 확장자 포함 파일명
    } 

    else {
            alert("파일을 선택해주세요");
            return false;
    }
}

function sendFile(obj) {
    var num = obj.getAttribute('data-id');
    console.log(num);
    var s = sendFileFunction(obj);
    $('#fileName'+num).attr('placeholder', s);
    $('#fileName'+num).val(s);

    $('#fileSelect'+num).attr('data-path', 'new');

    addThumnail(obj, num);
}

// 파일선택리스트 추가
function addFileList(){

var fileCount = $('.fileSelect:visible').length+1;
console.log(fileCount);

if(fileCount <= 5){

    for(i=1;i<=5;i++){
        console.log('i'+i);
        console.log($('#fileSelect'+i).data('value'));
        if($('#fileSelect'+i).attr('data-value') == 'off'){
            $('#fileSelect'+i).removeAttr('hidden');
            $('#fileSelect'+i).attr('data-value','on');
            $('#fileSelect'+i).attr('data-order', i-1);
            $('#fileListCheck'+i).attr('value','on');
            
            break;
        } 
    }  

    if(fileCount >= 5){
        $('#icon1').text('');
    }
}

else{
    alert('이미지는 최대 5개까지 업로드 가능합니다.');
}
}

// 파일 리스트 값 변경 함수

// 파일 리스트 삭제
function deleteFileList(value){


var fileCount = $('.fileSelect:visible').length;

    $('#fileSelect'+value).attr('data-value', 'off');
    $('#fileSelect'+value).attr('data-order', value-1);


// check 지울예정
// if($('#filename'+value).attr('placeholder') != '파일선택'){
//     // 지운이미지표시
//     var old = document.getElementById('addFileSelect'+value);
//     old.setAttribute("data-delete", "delete");
//     console.log(old.getAttribute('data-delete'));
//     }

// 모두
if(value < fileCount){
    for(i=value;i<fileCount;i++){
        var j = i+1
        var fileSelect1 = $('#fileSelect'+i);
        var fileSelect2 = $('#fileSelect'+j);
        var fileListCheck1 = $('#fileListCheck'+i);
        var fileListCheck2 = $('#fileListCheck'+j);
        var fileName1 = $('#fileName'+i);
        var fileName2 = $('#fileName'+j);
        var fileSelectButton1 = $('#fileNameSelectButton'+i);
        var fileSelectButton2 = $('#fileNameSelectButton'+j);
        var addFileSelect1 = $('#addFileSelect'+i);
        var addFileSelect2 = $('#addFileSelect'+j);
        var inputFile1 = $('#inputFile'+i);
        var inputFile2 = $('#inputFile'+j);
        var thumnail1 = $('#thumbnail'+i);
        var thumnail2 = $('#thumbnail'+j);
        
        // 위치 변경
        fileSelect1.insertAfter(fileSelect2);
        thumnail1.insertAfter(thumnail2);

        // fileSelect 요소값 치환
        // var tempfilePath = fileSelect2.attr('data-path');
        // console.log(tempfilePath);
        fileSelect2.attr('data-path',thumnail2.children().attr('data-path'));
        // fileSelect1.attr('data-path',tempfilePath);

        var tempfileOrder = fileSelect2.attr('data-order');
        fileSelect2.attr('data-order',fileSelect1.attr('data-order'));
        fileSelect1.attr('data-order',tempfileOrder);

        var tempfileSelectId = fileSelect2.attr('id');
        fileSelect2.attr('id',fileSelect1.attr('id'));
        fileSelect1.attr('id',tempfileSelectId);

        // fileListCheck 요소값 치환
        var tempfileListCheckName = fileListCheck2.attr('name');
        fileListCheck2.attr('name',fileListCheck1.attr('name'));
        fileListCheck1.attr('name',tempfileListCheckName);

        var tempfileListCheckValue = fileListCheck2.attr('value');
        fileListCheck2.attr('value',fileListCheck1.attr('value'));
        fileListCheck1.attr('value',tempfileListCheckValue);

        var tempfileListCheckId = fileListCheck2.attr('id');
        fileListCheck2.attr('id',fileListCheck1.attr('id'));
        fileListCheck1.attr('id',tempfileListCheckId);

        // fileName 요소값 치환
        var tempfileName = fileName2.attr('name');
        fileName2.attr('name',fileName1.attr('name'));
        fileName1.attr('name',tempfileName);
        
        var tempfileNameClass = fileName2.attr('class');
        fileName2.attr('class',fileName1.attr('class'));
        fileName1.attr('class',tempfileNameClass);

        var tempfileNameId = fileName2.attr('id');
        fileName2.attr('id',fileName1.attr('id'));
        fileName1.attr('id',tempfileNameId);
        
        // fileSelectButton 요소값 치환
        var tempfileSelectButtonClass = fileSelectButton2.attr('class');
        fileSelectButton2.attr('class',fileSelectButton1.attr('class'));
        fileSelectButton1.attr('class',tempfileSelectButtonClass);

        var tempfileSelectButtonOnclick = fileSelectButton2.attr('onclick');
        fileSelectButton2.attr('onclick',fileSelectButton1.attr('onclick'));
        fileSelectButton1.attr('onclick',tempfileSelectButtonOnclick);

        var tempfileSelectButtonId = fileSelectButton2.attr('id');
        fileSelectButton2.attr('id',fileSelectButton1.attr('id'));
        fileSelectButton1.attr('id',tempfileSelectButtonId);
        
        var tempthumnailId = thumnail2.attr('id');
        thumnail2.attr('id',thumnail1.attr('id'));
        thumnail1.attr('id',tempthumnailId);

        // addFileSelect 요소값 치환
        var tempaddFileSelectClass = addFileSelect2.attr('class');
        addFileSelect2.attr('class',addFileSelect1.attr('class'));
        addFileSelect1.attr('class',tempaddFileSelectClass);

        var tempaddFileSelectValue = addFileSelect2.attr('value');
        addFileSelect2.attr('value',addFileSelect1.attr('value'));
        addFileSelect1.attr('value',tempaddFileSelectValue);

        var tempaddFileSelectOnclick = addFileSelect2.attr('onclick');
        addFileSelect2.attr('onclick',addFileSelect1.attr('onclick'));
        addFileSelect1.attr('onclick',tempaddFileSelectOnclick);
        
        // addFileSelect2.attr('data-delete', 'changed');

        var tempaddFileSelectId = addFileSelect2.attr('id');
        addFileSelect2.attr('id',addFileSelect1.attr('id'));
        addFileSelect1.attr('id',tempaddFileSelectId);

        // inputFile 요소값 치환
        var tempinputFileClass = inputFile2.attr('class');
        inputFile2.attr('class',inputFile1.attr('class'));
        inputFile1.attr('class',tempinputFileClass);

        var tempinputFileDataId = inputFile2.attr('data-id');
        inputFile2.attr('data-id',inputFile1.attr('data-id'));
        inputFile1.attr('data-id',tempinputFileDataId);

        var tempinputFileName = inputFile2.attr('name');
        inputFile2.attr('name',inputFile1.attr('name'));
        inputFile1.attr('name',tempinputFileName);

        var tempinputFileOnchange = inputFile2.attr('onchange');
        inputFile2.attr('onchange',inputFile1.attr('onchange'));
        inputFile1.attr('onchange',tempinputFileOnchange);

        var tempinputFileId = inputFile2.attr('id');
        inputFile2.attr('id',inputFile1.attr('id'));
        inputFile1.attr('id',tempinputFileId);

    }
        // 하나 지우기
        $('#fileSelect'+fileCount).attr('hidden','');
        $('#fileSelect'+fileCount).attr('data-value','off');
        $('#fileSelect'+fileCount).attr('data-path', 'none');


        $('#fileListCheck'+fileCount).attr('value','off');

        $('#fileName'+fileCount).val("");
        $('#fileName'+fileCount).attr('placeholder','파일선택');

        $('#inputFile'+fileCount).val('');
        $('#inputFile'+fileCount).attr('type','hidden');
        $('#inputFile'+fileCount).attr('type','file');

        $('#thumbnail'+fileCount).attr('hidden','');
    }

    else{

    $('#fileSelect'+value).attr('hidden','');
    $('#fileSelect'+value).attr('data-value','off');
    $('#fileSelect'+fileCount).attr('data-path', 'none');


    $('#fileListCheck'+value).attr('value','off');

    $('#fileName'+value).val("");
    $('#fileName'+value).attr('placeholder','파일선택');

    $('#inputFile'+value).val('');
    $('#inputFile'+value).attr('type','hidden');
    $('#inputFile'+value).attr('type','file');

    $('#thumbnail'+value).attr('hidden','');

    }

    if(fileCount <= 5){
            $('#icon1').text('+');
    }

}


// 썸네일 추가
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

</script>
