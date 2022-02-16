@extends('layouts.main')
@extends('layouts.detailbody')

@section('detailContent')
    <div class="p-2 docs-highlight">
        <div class="row">
            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;{{$store->review_count}}&#41;</h2>
        </div>
@guest
{{-- 로그인안됨 --}}
        <div class="row px-3">
            <button class="btn btn-dark" type="button" data-coreui-target="#loginModal" data-coreui-toggle="modal">로그인 후
                리뷰를 작성하실 수 있습니다.
        </div>

{{-- 스토어 리뷰 출력 --}}
        @foreach ($store->reviews as $review)

        <div class="d-flex border-top border-bottom mx-1">
            <div class="col-9 ps-3 py-2">
                <p class="card-text">
                    @php
                        $now = (strtotime(date('Ymd H:i:s')))/86400;
                        $updated_at = (strtotime($review->updated_at))/86400;
                        $interval = floor($now - $updated_at);
                    @endphp
                    @if ($interval < 1)
                        오늘
                    @else
                        {{$interval}} 일전
                    @endif
                </p>
                <h5 class="card-title">{{$review->title}}</h5>
                <p class="card-text">{{$review->contents}}</p>
                <p class="card-text">
                    방문 날짜 :
                    @php
                        $date = date("Y-m-d", strtotime($review->been_date));
                        echo $date;
                    @endphp
                </p>
            </div>
        </div>
        
        @endforeach
@else
{{-- 로그인됨 --}}
{{-- 사용자가 작성한 리뷰가 없을시 리뷰작성창 --}}
@if($reviewCount < 1)
        <form class="pb-4" method="POST" id="reviewForm" action="{{ route('writeReview') }}">
            @csrf
            <input type="hidden" name="storeId" value="{{ $store->id }}">
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">평점</p></label>
                <div class="col-sm-11">
                    <div class="ratingStars">
                        <input type="hidden" id="rating" name="rating" value="">
                        <button class="m-0 p-0 starbutton" type="button" style="background-color:transparent; border:transparent;" value="1"> <img src="/images/emptystar.png" id="starImg_1"
                        style="width:25px; height:25px;" ></button>
                        <button class="m-0 p-0 starbutton" type="button" style="background-color:transparent; border:transparent;" value="2"> <img src="/images/emptystar.png" id="starImg_2"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0 starbutton" type="button" style="background-color:transparent; border:transparent;" value="3"> <img src="/images/emptystar.png" id="starImg_3"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0 starbutton" type="button" style="background-color:transparent; border:transparent;" value="4"> <img src="/images/emptystar.png" id="starImg_4"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0 starbutton" type="button" style="background-color:transparent; border:transparent;" value="5"> <img src="/images/emptystar.png" id="starImg_5"
                        style="width:25px; height:25px;"></button>
                    </div>
                </div>
            </div>
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">제목</p></label>
                <div class="col-sm-11">
                <input type="text" class="form-control" name="title" id="title" value="">
                </div>
            </div>
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                    <p style="font-size: 20px;">내용</p>
                </label>
                <div class="col-sm-11">
                    <textarea class="form-control" name="contents" id="contents" rows="7"></textarea>
                </div>
            </div>
            <div class="row mb-3 px-2">
            <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                <p style="font-size: 20px;">방문 일자</p>
                </label>
                <div class="col-sm-11">
                    <input type="date" class="form-control w-25" name="reviewDate" id="reviewDate">
                </div>
            </div>
            <div class="row px-3">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-dark rounded-pill w-50" type="button" onclick="formCheck(event);">리뷰 작성</button>
                    {{-- 리뷰작성 전송용 --}}
                    <button type="button" hidden data-coreui-target="#WriteCheckModal"
                    data-coreui-toggle="modal" id="reviewWriteConfirm"></button>
                    <button type="submit" hidden id="reviewWriteConfirmOk"></button>
                </div>
            </div>
        </form>
@else
@endif
{{-- 사용자가 작성한 리뷰출력 --}}
        @foreach ($userReviews as $userReview)
        <div class="d-flex border-top border-bottom mx-1" style="background-color: #4f5d73">
            <div class="col-9 ps-3 py-2">
                <p class="card-text text-white">
                    @php
                        $now = (strtotime(date('Ymd H:i:s')))/86400;
                        $updated_at = (strtotime($userReview->updated_at))/86400;
                        $interval = floor($now - $updated_at);
                    @endphp
                    @if ($interval < 1)
                        오늘
                    @else
                        {{$interval}} 일전
                    @endif
                </p>
                <h5 class="card-title text-white">{{$userReview->title}}</h5>
                <p class="card-text text-white">{{$userReview->contents}}</p>
                <p class="card-text text-white">
                    방문 날짜 :
                    @php
                        $date = date("Y-m-d", strtotime($userReview->been_date));
                        echo $date;
                    @endphp
                </p>
            </div>
        </div>
    
        @endforeach


{{-- 사용자가 작성하지 않은 리뷰출력 --}}
@foreach ($noUserReviews as $noUserReview)
<div class="d-flex border-top border-bottom mx-1" >
    <div class="col-9 ps-3 py-2">
        <p class="card-text text-black">
            @php
                $now = (strtotime(date('Ymd H:i:s')))/86400;
                $updated_at = (strtotime($noUserReview->updated_at))/86400;
                $interval = floor($now - $updated_at);
            @endphp
            @if ($interval < 1)
                오늘
            @else
                {{$interval}} 일전
            @endif
        </p>
        <h5 class="card-title text-black">{{$noUserReview->title}}</h5>
        <p class="card-text text-black">{{$noUserReview->contents}}</p>
        <p class="card-text text-black">
            방문 날짜 :
            @php
                $date = date("Y-m-d", strtotime($noUserReview->been_date));
                echo $date;
            @endphp
        </p>
    </div>
</div>

@endforeach

@endguest


    </div>
    @endsection


{{-- 리뷰 수정 모달 --}}
<div class="modal" tabindex="-1" id="modifyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-3">리뷰수정</h5>
                <div data-coreui-dismiss="modal" aria-label="Close" style="cursor: pointer">
                    <span class="fw-bold">X</span>
                </div>
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
                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4"
                    data-coreui-target="#modifyCheckModal" data-coreui-toggle="modal">확인</button>
                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
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
                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
                    data-coreui-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>

{{-- 리뷰작성확인 모달 --}}
<div class="modal" tabindex="-1" id="WriteCheckModal">
    <div class="modal-dialog modal-dialog-centered modalSize350">
        <div class="modal-content">
            <div class="modal-body">
                <p class="fw-bold text-center">리뷰를 작성하시겠습니까?</p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4" onclick="reviewWrite()" data-coreui-dismiss="modal">확인</button>
                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4" data-coreui-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>

{{-- 맛집카드 wish 체크용 --}}
<form method="POST" id="addWish" action="{{ route('addWish') }}">
    @csrf
    <input type="hidden" id="addWishInput" name="storeId" value="">
</form>
<form method="POST" id="removeWish" action="{{ route('removeWish') }}">
    @csrf
    <input type="hidden" id="removeWishInput" name="storeId" value="">
</form>



@section('script')
@parent

<script>


// 찜하트변경

$('#heart').click(function(){
    let value = $(this).attr("value");
    let storeId = $(this).attr("name");

    if (value == 1){
        $('#addWishInput').val($(this).attr("name"));
        $('#heart').attr('src', '/images/redheart.png');
        $('#heart').attr('value', '2');        
        $('#addWish').submit();
    }

    else{
        $('#removeWishInput').val($(this).attr("name"));
        $('#heart').attr('src', '/images/whiteheart.png');
        $('#heart').attr('value', '1');        
        $('#removeWish').submit();
    }
});


// 평점 버튼 클릭시 별변경 및 값입력

$(".starbutton").click(function(){
    $("#rating").val($(this).val());
    var count=$("#rating").val();
    for(var i=1;i<=count;i++){
        $('#starImg_'+i).attr('src','/images/star.png');
    }
    count = i;
    for(var j=count;j<=5;j++){
        $('#starImg_'+j).attr('src','/images/emptystar.png');
    }
});


// 리뷰작성 클릭시 유효성검사

function formCheck(event){

event.preventDefault();
let form = $('#reviewForm');
let rating = $('#rating').val();
let title = $('#title').val();
let contents = $('#contents').val();
let reviewDate = $('#reviewDate').val();

console.log(reviewDate);
console.log(contents.length);

function getToday(){
    var date = new Date();
    var year = date.getFullYear();
    var month = ("0" + (1 + date.getMonth())).slice(-2);
    var day = ("0" + date.getDate()).slice(-2);

    return year + "-" + month + "-" + day;
}

let today = getToday();
let todayChecker = reviewDate <= today;


if (rating == ''){
    alert('평점을 체크해주세요.');
        return false;
}

else if(title == ''){
    alert('제목을 입력해주세요.');
        return false;
}

else if(title.length < 5){
    alert('제목을 5자이상 30자 이하로 작성해주세요.');
    return false;
}

else if(title.length > 30){
    alert('제목을 5자이상 30자 이하로 작성해주세요.');
    return false;
}

else if (contents == ''){
    alert('내용을 입력해주세요.');
        return false;
} 

else if(contents.length < 20){
    alert('내용을 20자이상 300자 이하로 작성해주세요.');
    return false;
}

else if(contents.length > 300){
    alert('내용을 20자이상 300자 이하로 작성해주세요.');
    return false;
}

else if(reviewDate == ''){
    alert('방문일자를 체크해주세요');
        return false;
} 

else if(todayChecker != true){
    alert('오늘 이전 날짜를 체크해주세요');
        return false;
} 


$('#reviewWriteConfirm').click();

}


// 스토어카드 별찍기

$('.stars').each(function(){
    let star = parseInt($(this).text());
    let halfStar = ($(this).text() - star) * 10;
    $(this).text('');
    for(i=0;i<star;i++){
        $(this).append('<img src="/images/star.png">');
    }
    if(halfStar >=5){
        $(this).append('<img src="/images/star_half.png">');
    }
    console.log(star);
    console.log(halfStar);
});

// // 전화번호 형식변경 

var number = $('#telephone').text(); 
$('#telephone').text(number.replace(/[^0-9]/, '').replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`));

// 리뷰 평점 전달

function reviewWrite(){

    event.preventDefault();
    $('#reviewWriteConfirmOk').click();

}
        // // 찜하트 변경

        // function heartChange(id) {
        //     let heart;
        //     let value;
        //     heart = document.getElementById(id);
        //     value = heart.getAttribute('value');
        //     switch (value) {
        //         case '1':
        //             heart.setAttribute('src', '/images/redheart.png');
        //             heart.setAttribute('value', '2');
        //             break;
        //         case '2':
        //             heart.setAttribute('src', '/images/whiteheart.png');
        //             heart.setAttribute('value', '1');
        //             break;

        //     }
        //     console.log(value);
        //     console.log(heart.src);
        //     console.log(id);
        // }
        

// 평점 클릭시 별 변경
// let oneStar = document.getElementById('oneStar');
// let twoStar = document.getElementById('twoStar');
// let threeStar = document.getElementById('threeStar');
// let fourStar = document.getElementById('fourStar');
// let fiveStar = document.getElementById('fiveStar');

// function star_listener(event){
//     switch(event.target.id){
//         case 'oneStar':
//             oneStar.setAttribute('src','/images/star.png');
//             twoStar.setAttribute('src','/images/emptystar.png');
//             threeStar.setAttribute('src','/images/emptystar.png');
//             fourStar.setAttribute('src','/images/emptystar.png');
//             fiveStar.setAttribute('src','/images/emptystar.png');
//         break;

//         case 'twoStar':
//             oneStar.setAttribute('src','/images/star.png');
//             twoStar.setAttribute('src','/images/star.png');
//             threeStar.setAttribute('src','/images/emptystar.png');
//             fourStar.setAttribute('src','/images/emptystar.png');
//             fiveStar.setAttribute('src','/images/emptystar.png');
//         break;

//         case 'threeStar':
//             oneStar.setAttribute('src','/images/star.png');
//             twoStar.setAttribute('src','/images/star.png');
//             threeStar.setAttribute('src','/images/star.png');
//             fourStar.setAttribute('src','/images/emptystar.png');
//             fiveStar.setAttribute('src','/images/emptystar.png');
//         break;

//         case 'fourStar':
//             oneStar.setAttribute('src','/images/star.png');
//             twoStar.setAttribute('src','/images/star.png');
//             threeStar.setAttribute('src','/images/star.png');
//             fourStar.setAttribute('src','/images/star.png');
//             fiveStar.setAttribute('src','/images/emptystar.png');
//         break;

//         case 'fiveStar':
//             oneStar.setAttribute('src','/images/star.png');
//             twoStar.setAttribute('src','/images/star.png');
//             threeStar.setAttribute('src','/images/star.png');
//             fourStar.setAttribute('src','/images/star.png');
//             fiveStar.setAttribute('src','/images/star.png');
//         break;

//     }
// }
//
// oneStar.addEventListener('click', star_listener);
// twoStar.addEventListener('click', star_listener);
// threeStar.addEventListener('click', star_listener);
// fourStar.addEventListener('click', star_listener);
// fiveStar.addEventListener('click', star_listener);
//

    </script>
@endsection
