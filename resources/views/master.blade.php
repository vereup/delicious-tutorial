@extends('layouts.main')

@section('content')


<div class="container-fluid">
    <div class="d-flex flex-row docs-highlight mx-0 mb-0" style="background-color: #E5E5E5">
        <div class="p-2 docs-highlight">
            @include('layouts.sidebar') 
        </div>
        <div class="p-2 flex-fill docs-highlight">
            <div class="d-flex flex-column docs-highlight mb-3">

                <div class="m-2 docs-highlight bg-white">
                    {{-- 필터 필요시 사용 --}}
                    @include('layouts.filter')
                </div>

                <div class="m-2 docs-highlight">
                    <div class="d-flex flex-wrap" style="justify-content: space-between;">

                        
                        @foreach ($stores as $store)
                            
                        
                        {{-- 맛집카드 --}}
                        <div class="card rounded me-2 my-1" style="width: 275px; height: 350px;">
                            <a href="/store/{{$store->id - 1}}">                                 
                                    @foreach ($images as $image)
                                        @if($image->store_id == $store->id)
                                            <img
                                            src="{{$image->path}}"
                                            {{-- src="/images/store_thum_{{ $k+1 }}.png" --}}
                                            class="card-img-top border-bottom"
                                            alt="store->name"
                                            style="width: 273px; height: 236.49px;"
                                            >
                                            @break
                                        @endif
                                    @endforeach
                            </a>
                            <div
                                class="p-2 bg-white"
                                style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="heartChange(this.id)" id="heart" value="1";>
                                {{-- <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="heartChange(this.id)" id="heart{{ $k }}" value="1";> --}}
                                    {{-- 로그인후 찜여부에따라 하트변경 --}}
                            </div>
                            <div class="card-body">
                                <a class="card-title" href="/store/{{$store->id -1 }}" style="color :black; text-decoration : none; font-weight: bold; font-size: 18px;"><p class="mb-0">{{ $store->name }}</p></a>
                                <a id="star_{{ $store->id }}">{{ $store->id }}<a id="starHalf_{{ $store->id }}"></a></a> 
                                    {{--  찜 카운트에 따라 변경  --}}
                                    <a id="test"></a>
                                    <span class="ms-1">	&#40;{{ $store->review_count }}&#41;</span>
                                    <br>
                                    <p class="card-text">{{ $store->address }}</p>
                            </div>
                        </div>
                        @endforeach

                        {{-- @for($k=0;$k<6;$k++) --}}
                        {{-- 맛집카드 --}}
                        {{-- <div class="card rounded me-2 my-1" style="width: 275px; height: 350px;">
                            <a href="/detail">
                            <img
                                src="/images/store_thum_{{ $k+1 }}.png"
                                class="card-img-top border-bottom"
                                alt="store->name"
                                style="width: 273px; height: 236.49px;"
                                >
                            </a>
                            <div
                                class="p-2 bg-white"
                                style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="heartChange(this.id)" id="heart{{ $k }}" value="1";>
                                    로그인후 찜여부에따라 하트변경 --}}
                            {{-- </div>
                            <div class="card-body">
                                <a class="card-title" href="/detail" style="color :black; text-decoration : none; font-weight: bold; font-size: 18px;"><p class="mb-0" id="storeName{{ $k }}"></p></a>
                                <a id="stars_{{ $k }}"><a id="starHalf_{{ $k }}"></a></a> --}}
                                    {{--  찜 카운트에 따라 변경  --}}
                                    {{-- <span class="ms-1" id="ratingCount{{ $k }}"></span>
                                    <br>
                                    <p class="card-text" id="address{{ $k }}"></p>
                            </div>
                        </div>
                        @endfor --}}

                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>


@endsection

{{-- 하기 스크립트 섹션??? --}}
@section('script')
@parent

<script>

// // 스토어카드 상호출력
// let storeArray = new Array ("수박화채 1호점", "라멘집", "베이커리&샌드위치", "샤브샤브&훠궈", "도너츠", "스테이크");
// i = 0;
// while(i<storeArray.length){
//     document.getElementById('storeName'+i+'').innerText = storeArray[i];
//     i= i+1;
// }

// // 스토어카드 주소출력
// let addressArray = new Array ("서울시 서초구", "서울시 강남구", "서울시 마포구", "경기도 분당구", "경기도 일산동구", "서울시 용산구");
// i = 0;
// while(i<addressArray.length){
//     document.getElementById('address'+i+'').innerText = addressArray[i];
//     i= i+1;
// }

// // 스토어카드 평점개수출력
// let ratingCountArray = new Array (123, 333, 221, 21, 11, 2);
// i = 0;
// while(i<ratingCountArray.length){
//     document.getElementById('ratingCount'+i+'').innerText = '('+ratingCountArray[i]+')';
//     i= i+1;
// }

// 스토어카드 별세기 함수
function countingStars(rating, star, starHalf){
    let i=1;
    let j=5;
    let starCount = parseInt(rating);
    let starHalfCount = (rating-starCount)*10;
    let imgURL = '';

    while(i<=starCount){
        imgURL = imgURL + '<img src="/images/star.png">';
        console.log(imgURL);
        i = i+1;
    }
    console.log(imgURL);
    document.getElementById(''+star+'').innerHTML = imgURL;

    if(j<starHalfCount){
        document.getElementById(''+starHalf+'').innerHTML = '<img src="/images/star_half.png">';
        
    }
}

// 평점에 따라 출력하기

let stores = @json($stores);
stores.forEach((store, index) => {
    console.log(store);
    console.log(store.id);
    console.log(store.name);
    let rating = store.rating_average;
    console.log(rating);
    let id = index+1;
    console.log(id);
    let star = 'star_'+''+id+'';
    console.log(star);
    let starHalf = 'starHalf_'+''+id+'';
    console.log(starHalf);
    countingStars(rating, star, starHalf);
});


// k = 0;
// while (k<6){
//     let stars = 'stars_' + k;
//     let starHalf = 'starHalf_' + k;
//     console.log(stars, starHalf);
//     countingStars(ratingArray[k], stars, starHalf);
//     console.log(ratingArray[k]);
//     k=k+1;
// }

// 찜 하트 변경

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

// // 스토어카드 이미지출력 - 미완성

// let images = @json($images);
// function printImage(stores, images){
//     let path = '';
//     let image= '';
//     images.forEach(image => {
//         console.log(image.store_id);
//         console.log(store.id);
//         if(image.store_id == store.id){
//             path = image.path;
//         }
//     });
// }

// let pathIndex;
// stores.forEach(store => {
//     console.log(store);
//     pathIndex = store.id;
//     imagePath = document.getElementById('imagePath_'+pathIndex+'');
    
//     console.log(pathIndex);
//     console.log(imagePath);

//     printImage(stores, images);
// });


</script>

@endsection