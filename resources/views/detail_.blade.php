@extends('layouts.main')

@section('content')
                <div class="container-fluid p-2">
                    <div class="d-flex flex-column docs-highlight bg-white">
                        <div class="d-flex">
                            <div class="col-11 ps-3 py-4">
                                <p class="card-title fs-3 fw-bold">베이커리&샌드위치
                                    <img src="/images/star.png">
                                    <span class="text" style="font-size: 10pt;">&#40;리뷰개수&#41;</span>
                                </p>
                                <p class="card-text pb-2"><img src="/images/location.png">&nbsp;주소
                                    <span class="fw-bold" style="color: #a0a0a0;">&nbsp;|</span>
                                    <img src="/images/telephone.png">&nbsp;&nbsp;전화번호
                                </p>
                            </div>
                            <div class="col-1 pt-5">
                                {{-- 찜버튼 --}}
                                <button
                                    class="p-2 bg-white"
                                    style="border: 1px solid #A0A0A0; border-radius: 50%;">
                                    <div>
                                        <img src="/images/redheart.png" onclick="heartChange(this.id)" value="2" width="25" height="25" id="heart">
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="d-flex flex-row border-top border-bottom">
                            <div class="col-6 p-2 border-end text-center">
                                <div
                                    id="carouselExampleFade"
                                    class="carousel slide carousel-fade"
                                    data-coreui-ride="carousel"
                                    >
                                    <div class="carousel-inner">
                                        <div class="carousel-item active text-center">
                                            <img
                                                src="/images/sample-1.png"
                                                width="550"
                                                height="350"
                                            ></div>
                                        <div class="carousel-item text-center">
                                            <img
                                                src="/images/star.png"
                                                width="550"
                                                height="350"
                                                ></div>
                                        <div class="carousel-item text-center">
                                            <img
                                                src="/images/telephone.png"
                                                width="550"
                                                height="350"
                                                ></div>
                                    </div>
                                    <button
                                        class="carousel-control-prev"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button
                                        class="carousel-control-next"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="p-2 pt-3 ps-4">
                                <p class="text-start">
                                    카페 & 디저트</p>
                                <p class="text-start">
                                    베이커리 & 샌드위치 맛집 소개</p>
                            </div>
                        </div>

                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="row">
                            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;리뷰개수&#41;</h2>
                        </div>
                        <div class="row px-3">
                            <button class="btn btn-dark" type="button" data-coreui-target="#loginModal" data-coreui-toggle="modal">로그인 후 리뷰를 작성하실 수 있습니다.
                        </div>
                        <div class="d-flex border-top border-bottom">
                            <div class="col-9 ps-3 py-2">
                                <p class="card-text">2일전</p>
                                <h5 class="card-title">카츠샌드짱</h5>
                                <p class="card-text">엄청맛있어요~!</p>
                                <p class="card-text">방문 날짜 : 2021-09-10</p>
                            </div>
                        
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        pignation
                    </div>
                </div>
            </div>

@endsection


@section('script')
<script>

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