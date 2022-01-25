@extends('layouts.main')
@extends('layouts.detailbody')

@section('detailContent')
    <div class="p-2 docs-highlight">
        <div class="row">
            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;{{$store->review_count}}&#41;</h2>
        </div>
{{-- 비로그인시 출력 --}}
        <div class="row px-3">
            <button class="btn btn-dark" type="button" data-coreui-target="#loginModal" data-coreui-toggle="modal">로그인 후
                리뷰를 작성하실 수 있습니다.
        </div>

{{-- 로그인시 출력 --}}

        @foreach ($reviews as $review)
        @if($review->store_id == $store->id && $review->user_id == $user->id)
            @php
                $hasReview = True;
            @endphp
        @else
            @php
                $hasReview = False;
            @endphp
        @endif
        @endforeach

        @if($hasReview == True)
        <div class="d-flex border-bottom text-white mx-1" data-coreui-target="#modifyModal" data-coreui-toggle="modal"
            style="background: #455A64; cursor:pointer;">
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
        @else
        <form class="pb-4">
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">평점</p></label>
                <div class="col-sm-11">
                    <div>
                        <button class="m-0 p-0" type="button" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="oneStar"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0" type="button" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="twoStar"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0" type="button" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="threeStar"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0" type="button" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="fourStar"
                        style="width:25px; height:25px;"></button>
                        <button class="m-0 p-0" type="button" style="background-color:transparent; border:transparent;"> <img src="/images/emptystar.png" id="fiveStar"
                        style="width:25px; height:25px;"></button>
                    </div>
                </div>
            </div>
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label"><p style="font-size: 20px;">제목</p></label>
                <div class="col-sm-11">
                <input type="text" class="form-control" id="inputTitle">
                </div>
            </div>
            <div class="row mb-3 px-2">
                <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                    <p style="font-size: 20px;">내용</p>
                </label>
                <div class="col-sm-11">
                    <textarea class="form-control" id="inputPassword3" rows="7"></textarea>
                </div>
            </div>
            <div class="row mb-3 px-2">
            <label for="inputTitle" class="col-sm-1 ps-3 pt-0 col-form-label">
                <p style="font-size: 20px;">방문 일자</p>
                </label>
                <div class="col-sm-11">
                    <input type="date" class="form-control w-25" id="inputPassword4" rows="7">
                </div>
            </div>    
            <div class="row px-3">
                <center>
                    <button class="btn btn-dark rounded-pill w-50" type="button" data-coreui-target="#WriteCheckModal" 
                    data-coreui-toggle="modal">리뷰 작성
                </center>
            </div>
        </form>
        @endif

        @foreach ($reviews as $review)
        @if($review->store_id == $store->id && $review->user_id != $user->id) 
            
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
        @endif
        @endforeach

    </div>
    @endsection


{{-- 리뷰 수정 모달 --}}
<div class="modal" tabindex="-1" id="modifyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-3">리뷰수정</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
                <button
                    type="button"
                    class="btn btn-gray rounded-pill btn-secondary px-4"
                    data-coreui-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>

@section('script')
@parent

    <script>
        // 찜하트 변경

        function heartChange(id) {
            let heart;
            let value;
            heart = document.getElementById(id);
            value = heart.getAttribute('value');
            switch (value) {
                case '1':
                    heart.setAttribute('src', '/images/redheart.png');
                    heart.setAttribute('value', '2');
                    break;
                case '2':
                    heart.setAttribute('src', '/images/whiteheart.png');
                    heart.setAttribute('value', '1');
                    break;

            }
            console.log(value);
            console.log(heart.src);
            console.log(id);
        }



// 평점 클릭시 별 변경
let oneStar = document.getElementById('oneStar');
let twoStar = document.getElementById('twoStar');
let threeStar = document.getElementById('threeStar');
let fourStar = document.getElementById('fourStar');
let fiveStar = document.getElementById('fiveStar');
    
function star_listener(event){
    switch(event.target.id){
        case 'oneStar':
            oneStar.setAttribute('src','/images/star.png');
            twoStar.setAttribute('src','/images/emptystar.png'); 
            threeStar.setAttribute('src','/images/emptystar.png');
            fourStar.setAttribute('src','/images/emptystar.png');
            fiveStar.setAttribute('src','/images/emptystar.png');  
        break;

        case 'twoStar':
            oneStar.setAttribute('src','/images/star.png');
            twoStar.setAttribute('src','/images/star.png'); 
            threeStar.setAttribute('src','/images/emptystar.png');
            fourStar.setAttribute('src','/images/emptystar.png');
            fiveStar.setAttribute('src','/images/emptystar.png');
        break;

        case 'threeStar':
            oneStar.setAttribute('src','/images/star.png');
            twoStar.setAttribute('src','/images/star.png'); 
            threeStar.setAttribute('src','/images/star.png');
            fourStar.setAttribute('src','/images/emptystar.png');
            fiveStar.setAttribute('src','/images/emptystar.png');
        break;

        case 'fourStar':
            oneStar.setAttribute('src','/images/star.png');
            twoStar.setAttribute('src','/images/star.png'); 
            threeStar.setAttribute('src','/images/star.png');
            fourStar.setAttribute('src','/images/star.png');
            fiveStar.setAttribute('src','/images/emptystar.png');
        break;

        case 'fiveStar':
            oneStar.setAttribute('src','/images/star.png');
            twoStar.setAttribute('src','/images/star.png'); 
            threeStar.setAttribute('src','/images/star.png');
            fourStar.setAttribute('src','/images/star.png');
            fiveStar.setAttribute('src','/images/star.png'); 
        break;

    }
}

oneStar.addEventListener('click', star_listener);
twoStar.addEventListener('click', star_listener);
threeStar.addEventListener('click', star_listener);
fourStar.addEventListener('click', star_listener);
fiveStar.addEventListener('click', star_listener);


// 찜하트 변경

function heartChange(id){
    let heart;
    let value;
    heart = document.getElementById(id);
    value = heart.getAttribute('value');
    switch(value){
        case '1':
            heart.setAttribute('src','/images/redheart.png');
            heart.setAttribute('value','2'); 
            break;
        case '2':
            heart.setAttribute('src','/images/whiteheart.png'); 
            heart.setAttribute('value','1');
            break;    
    
    }
    console.log(value);
    console.log(heart.src);
    console.log(id);
}

    </script>
@endsection