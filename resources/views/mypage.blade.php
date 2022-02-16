@php
    use Carbon\Carbon;

@endphp

@extends('layouts.main')

@section('content')


<div class="c-body" style="background-color: #E5E5E5" >
    <div class="container p-2">
        <div class="d-flex flex-column" style="background-color: white">
            <div class="p-2 docs-highlight">
                <p class="fs-2 fw-bold p-4">{{$user->name}} 님&#40;{{$user->email}}&#41;</p>
            </div>
            <div class="p-2 docs-highlight">
                
{{-- 틀시작 --}}

<form method="GET" action="/mypage" id="reviewForm">
    <input class="tap" type="hidden" name="tabIndex" value="1">
  </form>
  <form method="GET" action="/mypage" id="wishForm">
    <input class="tap" type="hidden" name="tabIndex" value="2">
  </form>

  @if($tabIndex <= 1 || $tabIndex == null)
        <ul class="nav nav-pills mb-3 border-bottom" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-coreui-toggle="pill" data-coreui-target="#pills-home" type="button" role="tab" 
            aria-controls="pills-home" aria-selected="true" onclick="submit('reviewForm')" style="width:220px;height:75px;border-radius: 10px 10px 0px 0px / 10px 10px 0px 0px;">내 리뷰</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-coreui-toggle="pill" data-coreui-target="#pills-profile" type="button" role="tab" 
            aria-controls="pills-profile" aria-selected="false" onclick="submit('wishForm')" style="width:220px;height:75px;border-radius: 10px 10px 0px 0px / 10px 10px 0px 0px;">찜 목록</button>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">내 리뷰 &#40;
                    <span>
                       {{$userReviewsCount}}
                    </span>&#41;
                </h2>
            </div>
            @foreach ($userReviews as $userReview)
                @if($userReview->user_id == $user->id)      
                    <div class="d-flex border-top border-bottom">
                        <div class="col-9 ps-3 py-2">
                            <p class="card-text">
                                @php
                                    // $now = (strtotime(date('Ymd H:i:s')))/86400;
                                    // $updated_at = (strtotime($userReview->updated_at))/86400;
                                    // carbon
                                    $now = Carbon::now();
                                    $past = $userReview->updated_at;
                                    $interval = $now->diffInDays($past);
                                    
                                    
                                @endphp
                                @if ($interval < 1)
                                    오늘
                                @else
                                    {{$interval}} 일전
                                    
                                @endif
                            </p>
                            <h5 class="card-title" id="reviewTitleId_{{ $userReview->id }}">{{$userReview->title}}</h5>
                            <p class="card-text" id="reviewContentsId_{{ $userReview->id }}">{{$userReview->contents}}</p>
                            <p class="card-text">방문 날짜 : 
                                @php
                                    $date = date("Y-m-d", strtotime($userReview->been_date));
                                    echo $date;
                                @endphp</p>
                        </div>
                        <div class="col-auto pt-5">
                            {{-- <button type="submit" class="btn btn-primary fs-4 btn-dark rounded-pill" 
                            style="width: 100px; height:50px;" data-coreui-target="#modifyModal" data-coreui-toggle="modal"  id="{{ $userReview->id }}" 
                            onclick="modifyClicked(this.id);">수정</button> --}}

                            <button type="submit" class="btn btn-primary fs-4 btn-dark rounded-pill" 
                                style="width: 100px; height:50px;" data-coreui-target="#modifyModal" data-coreui-toggle="modal"  id="{{ $userReview->id }}" 
                                onclick="modifyClicked({{ $userReview->id }});">수정</button>
                            <button type="submit" class="btn btn-secondary fs-4 btn-gray text-white rounded-pill ms-2" 
                            style="width: 100px; height:50px;" data-coreui-target="#deleteCheckModal" data-coreui-toggle="modal" value="{{ $userReview->id }}" 
                            onclick="selectReview({{ $userReview->id }});">삭제</button>
                        
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="p-2 docs-highlight">
            <div class="d-flex justify-content-center">
                {{ $userReviews->appends(["tabIndex" => "1"])->links() }}
            </div>
            </div>
          </div>
          {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"><h1>test profile</h1></div> --}}
        </div>



  @else
        <ul class="nav nav-pills mb-3 border-bottom" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-home-tab" data-coreui-toggle="pill" data-coreui-target="#pills-home" type="button" role="tab" 
            aria-controls="pills-home" aria-selected="false" onclick="submit('reviewForm')" style="width:220px;height:75px;">내 리뷰</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-profile-tab" data-coreui-toggle="pill" data-coreui-target="#pills-profile" type="button" role="tab" 
            aria-controls="pills-profile" aria-selected="true" onclick="submit('wishForm')" style="width:220px;height:75px;">찜 목록</button>
          </li>
        </ul>
        
        <div class="tab-content" id="pills-tabContent">
          {{-- <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"></div> --}}
          <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">
                <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">찜 목록 &#40;
                    {{$userWishesCount}}
                    &#41;</h2>
                </div>
                <div class="d-flex border-bottom align-items-center">
                </div>
            @foreach ($userWishes as $userWish)
                @if($userWish->user_id == $user->id) 
                    <div class="d-flex border-bottom align-items-center">
                        <div class="col-2 ps-3 py-2">
                            <img src="{{$userWish->store->images[0]->path}}" class="img-thumbnail border-0">
                        </div>
                        <div class="col-9 ps-3 py-2 align-middle">
                            <h5 class="card-title" onclick ="location.href='/store/{{ $userWish->store->id }}';" style="cursor: pointer;">{{$userWish->store->name}}</h5>
                            <div>
                                @php
                                    $i = 1;
                                    while($i <= $userWish->store->rating_average){
                                        echo '<img src="/images/star.png">';
                                        $i = $i + 1;
                                    }
                                    $i = $i-1;
                                    $j = -($i - $userWish->store->rating_average);
                                    if($j > 0.5){
                                        echo '<img src="/images/star_Half.png">';
                                    }
                                @endphp
                                
                                &#40;{{$userWish->store->review_count}}&#41;
                            </div>
                            <p class="card-text">{{$userWish->store->address}}</p>
                        </div>
                        <div class="col-auto pt-4">
                            {{-- 찜버튼 --}}
                            <button class="p-2 bg-white" style="border: 1px solid #A0A0A0; border-radius: 50%;" value="{{ $userWish->id }}" onclick="selectWish(this.value);"
                            data-coreui-target="#wishDeleteCheckModal" data-coreui-toggle="modal">
                                <div>
                                    <img src="/images/redheart.png" width="25" height="25">
                                </div>
                            </button>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="p-2 docs-highlight">
            <div class="d-flex justify-content-center">
                {{ $userWishes->appends(["tabIndex" => "2"])->links() }}
            </div>
            </div>

        </div>
    </div>

@endif

{{-- 틀끝 --}}


    {{-- 리뷰삭제 확인 모달 --}}
    <div class="modal" tabindex="-1" id="deleteCheckModal">
        <div class="modal-dialog modal-dialog-centered modalSize350">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="fw-bold text-center">리뷰를 삭제하시겠습니까?</p>
                </div>
                <div class="modal-footer" style="justify-content: center;">
                    <form method="POST" id="deleteReview" action="{{ route('deleteReview') }}">
                        @csrf
                        <input type="hidden" id="deleteTargetId" name="deleteReviewId">
                        <button type="button" class="btn btn-dark rounded-pill btn-primary px-4" onclick="deleteReview(document.getElementById('deleteTargetId').value);">확인</button>
                    </form>
                    <button
                        type="button"
                        class="btn btn-gray rounded-pill btn-secondary px-4"
                        data-coreui-dismiss="modal">취소</button>
                </div>
            </div>
        </div>
    </div>

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
                                <form method="POST" id="modifyForm" action="{{ route('modifyReview') }}">
                                    @csrf
                                    <input type="hidden" id="reviewId" name="reviewId">
                                    <div class="mb-3">
                                        <label for="reviewTitle" class="form-label">제목</label>
                                        <input type="text" class="form-control" id="reviewTitle" name="reviewTitle">
                                    </div>
                                    <div class="mb-3">
                                        <label for="reviewContents" class="form-label">내용</label>
                                        <textarea class="form-control" id="reviewContents" rows="7" name="reviewContents"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <button
                                    type="button"
                                    class="btn btn-dark rounded-pill btn-primary px-4"
                                    data-coreui-target="#modifyCheckModal"
                                    data-coreui-toggle="modal" >확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
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
                                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4" id="modifyConfirmOk">확인</button>
                                <button
                                    type="button"
                                    class="btn btn-gray rounded-pill btn-secondary px-4"
                                    data-coreui-dismiss="modal">취소</button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- 찜삭제 확인 모달 --}}
                <div class="modal" tabindex="-1" id="wishDeleteCheckModal">
                    <div class="modal-dialog modal-dialog-centered modalSize350">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p class="fw-bold text-center">찜 목록에서 삭제하시겠습니까?</p>
                            </div>
                            <div class="modal-footer" style="justify-content: center;">
                                <form method="POST" id="deleteWish" action="{{ route('deleteWish') }}">
                                    @csrf
                                    <input type="hidden" id="deleteWishTargetId" name="deleteWishId">
                                    <button type="button" class="btn btn-dark rounded-pill btn-primary px-4" onclick="deleteWish(document.getElementById('deleteWishTargetId').value);">확인</button>
                                </form>
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


function submit(id){
    document.getElementById(id).submit();
    // documnet.getElementById('pills-home-tab').innerHTML()
}

// var myModalEl = document.getElementById('myModal')
// myModalEl.addEventListener('hidden.coreui.modal', function (event) {
//   // do something...
// })

function modifyClicked(id){
    
    event.preventDefault();

    let title = document.getElementById('reviewTitleId_'+id+'').innerText;
    let contents = document.getElementById('reviewContentsId_'+id+'').innerText;
    let reviewTitle = document.getElementById('reviewTitle');
    let reviewContents = document.getElementById('reviewContents');

    console.log(id);

    reviewId.value = id;    
    reviewTitle.value = title;
    reviewContents.innerText = contents;

    console.log(id);
}


let modifyConfirm = document.getElementById('modifyConfirmOk');
modifyConfirm.addEventListener('click',function (event){

        let modifyForm = document.getElementById('modifyForm');

        return modifyForm.submit();
        
});


function selectReview(id){

    event.preventDefault();
    
    document.getElementById('deleteTargetId').value = id;

}

function deleteReview(id){

    event.preventDefault();
    return document.getElementById('deleteReview').submit();
    
}

function selectWish(id){

event.preventDefault();
document.getElementById('deleteWishTargetId').value = id;

}

function deleteWish(id){

event.preventDefault();
return document.getElementById('deleteWish').submit();

}


</script>

@endsection