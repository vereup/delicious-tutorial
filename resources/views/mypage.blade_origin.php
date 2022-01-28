@extends('layouts.main')

@section('content')


<div class="c-body" style="background-color: #E5E5E5" >
    <div class="container p-2">
        <div class="d-flex flex-column" style="background-color: white">
            <div class="p-2 docs-highlight">
                <p class="fs-2 fw-bold p-4">{{$user->name}} &#40;{{$user->email}}&#41;</p>
            </div>
            <div class="p-2 docs-highlight">
                
                <form action="/mypage" method="GET">
                    @csrf
                <input class="tab" type="hidden" name="current" value="review">
                <div class="nav nav-pills mb-2 border-bottom" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="myReview-tab" formaction="/mypage"
                            data-coreui-toggle="pill" data-coreui-target="#myReview" type="button" role="tab" value="review" aria-controls="pills-home" 
                            aria-selected="true" style="width:220px;height:75px;" onclick="summit(this.id)">내 리뷰 </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="wishList-tab" 
                            data-coreui-toggle="pill" data-coreui-target="#wishList" type="button" role="tab" aria-controls="pills-profile" 
                            aria-selected="false" style="width:220px;height:75px;">찜 목록</button>
                        </li>
                        {{--                     
                            <li class="nav-item" role="presentation">
                                <form method="GET">
                                    <input class="tap" type="hidden" name="current" value="1">
                                    <button class="nav-link" id="myReview-tab"
                                    data-coreui-toggle="pill" data-coreui-target="#myReview" type="button" role="tab" aria-controls="pills-profile" 
                                    aria-selected="false" style="width:220px;height:75px;">내 리뷰 </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="wishList-tab" 
                                    data-coreui-toggle="pill" data-coreui-target="#wishList" type="button" role="tab" aria-controls="pills-home" 
                                    aria-selected="true" style="width:220px;height:75px;">찜 목록</button>
                                </li> --}}
                                
                            </ul>
                            </form>
                            
                <div class="tab-content" id="pills-tabContent">
                    <div class="row justify-content-center">
                        {{ $userReviews->appends(['tab' => 'review'])->links() }}                            
                    </div>
                    {{-- @if($tab === 'review') --}}
                    <div class="tab-pane fade show active" id="myReview" role="tabpanel" aria-labelledby="myReview-tab">
                        <div class="row">
                            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">내 리뷰 &#40;
                                <span>
                                    @php
                                    echo $userReviews->count();
                                    @endphp
                                </span>&#41;
                            </h2>
                        </div>
                        @foreach ($userReviews as $userReview)
                            @if($userReview->user_id == $user->id)      
                                <div class="d-flex border-top border-bottom">
                                    <div class="col-9 ps-3 py-2">
                                        <p class="card-text">
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
                                        <h5 class="card-title">{{$userReview->title}}</h5>
                                        <p class="card-text">{{$userReview->contents}}</p>
                                        <p class="card-text">방문 날짜 : 
                                            @php
                                                $date = date("Y-m-d", strtotime($userReview->been_date));
                                                echo $date;
                                            @endphp</p>
                                    </div>
                                    <div class="col-auto pt-5">
                                        <button type="submit" class="btn btn-primary fs-4 btn-dark rounded-pill" 
                                        style="width: 100px; height:50px;" data-coreui-target="#modifyModal" data-coreui-toggle="modal">수정</button>
                                        <button type="submit" class="btn btn-secondary fs-4 btn-gray text-white rounded-pill ms-2" 
                                        style="width: 100px; height:50px;" data-coreui-target="#deleteCheckModal" data-coreui-toggle="modal">삭제</button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                    </div>


                    {{-- @else --}}
                    <div class="tab-pane fade" id="wishList" role="tabpanel" aria-labelledby="wishList-tab">
                        <div class="row">
                            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">찜 목록 &#40;
                                @php
                                    echo $userWishes->count();
                                @endphp
                                &#41;</h2>
                        </div>
                        @foreach ($userWishes as $userWish)
                            @if($userWish->user_id == $user->id) 
                                @php
                                    $store = $stores[$userWish->store_id];
                                    $image = $images[$userWish->store_id];
                                @endphp
                                
                                <div class="d-flex border-top border-bottom align-items-center">
                                    <div class="col-2 ps-3 py-2">
                                        <img src="{{$image->path}}" class="img-thumbnail">
                                    </div>
                                    <div class="col-9 ps-3 py-2 align-middle">
                                        <h5 class="card-title">{{$store->name}}</h5>
                                        <div>
                                            @php
                                                $i = 1;
                                                while($i <= $store->rating_average){
                                                    echo '<img src="/images/star.png">';
                                                    $i = $i + 1;
                                                }
                                                $i = $i-1;
                                                $j = -($i - $store->rating_average);
                                                if($j > 0.5){
                                                    echo '<img src="/images/star_Half.png">';
                                                }
                                            @endphp
                                            
                                            &#40;{{$store->review_count}}&#41;
                                        </div>
                                        <p class="card-text">{{$store->address}}</p>
                                    </div>
                                    <div class="col-auto pt-4">
                                        {{-- 찜버튼 --}}
                                        <button class="p-2 bg-white" style="border: 1px solid #A0A0A0; border-radius: 50%;" 
                                        data-coreui-target="#wishDeleteCheckModal" data-coreui-toggle="modal">
                                            <div>
                                                <img src="/images/redheart.png" width="25" height="25">
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="d-flex justify-content-center">
                            {{ $userWishes->appends(['tab' => 'wish'])->links() }}
                        </div>
                    </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>

    {{-- 리뷰삭제 확인 모달 --}}
    <div class="modal" tabindex="-1" id="deleteCheckModal">
        <div class="modal-dialog modal-dialog-centered modalSize350">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="fw-bold text-center">리뷰를 삭제하시겠습니까?</p>
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

</div>
@endsection


                {{-- 리뷰 수정 모달 --}}
                <div class="modal" tabindex="-1" id="modifyModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold fs-3">리뷰수정</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
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
                                <button
                                    type="button"
                                    class="btn btn-dark rounded-pill btn-primary px-4"
                                    data-coreui-target="#modifyCheckModal"
                                    data-coreui-toggle="modal">확인</button>
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
                                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
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

    function summit(id){
        let button = document.getElementById(id);
        button.summit();
    }
</script>

@endsection