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
                    @if ($categoryList != 'all' || $ratingList != null || $keyword != null )
                        @include('layouts.filter')
                    @endif
                </div>

                <div class="m-2 docs-highlight">
                    <div class="d-flex flex-wrap" style="justify-content: space-between;">

                        
                        @foreach ($stores as $store)
                            
                        
                        {{-- 맛집카드 --}}
                        <div class="card rounded my-1" style="width: 18rem;">
                            <a href="/store/{{$store->id}}">                                 
                                    @foreach ($images as $image)
                                        @if($image->store_id == $store->id)
                                            <img
                                            src="{{$image->path}}"
                                            {{-- src="/images/store_thum_{{ $k+1 }}.png" --}}
                                            class="card-img-top border-bottom w-100"
                                            alt="store->name"
                                            >
                                            @break
                                        @endif
                                    @endforeach
                            </a>
                            


                            
                                @guest
                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="alert('login plz');" id="heart{{ $store->id }}" value="1";>
                                </div>

                                @else
                                    @foreach ($userWishes as $wish)
                                        @if ($store->id == $wish->store_id)
                                            <form method="POST" id="storeSelect_{{ $store->id }}" action="{{ route('removeWish') }}">
                                                @csrf
                                                <input type="hidden" name="storeId" value="{{ $store->id }}">
                                                <input type="hidden" name="wishId" value="{{ $wish->id }}">
                                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                                <img type="button" src="/images/redheart.png" width="23" height="26" onclick="wishChange(this.id, 'storeSelect_{{ $store->id }}')" id="heart{{ $store->id }}" value="2";>
                                                </div>
                                            </form>
                                            @break
                                        @else
                                            <form method="POST" id="storeSelect_{{ $store->id }}" action="{{ route('addWish') }}">
                                                @csrf
                                                <input type="hidden" name="storeId" value="{{ $store->id }}">
                                                <input type="hidden" name="wishId" value="{{ $wish->id }}">
                                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="wishChange(this.id, 'storeSelect_{{ $store->id }}')" id="heart{{ $store->id }}" value="1";>
                                                </div>
                                            </form>
                                            @break
                                        @endif
                                    @endforeach
                                @endguest


                                

                            <div class="card-body">
                                <a class="card-title" href="/store/{{$store->id}}" style="color :black; text-decoration : none; font-weight: bold; font-size: 18px;"
                                    ><p class="mb-0">{{ $store->name }}</p></a>
                                <a id="star_{{ $store->id }}">{{ $store->id }}<a id="starHalf_{{ $store->id }}"></a></a> 
                                    {{--  찜 카운트에 따라 변경  --}}
                                    <span class="ms-1">	&#40;{{ $store->review_count }}&#41;</span>
                                    <br>
                                    <p class="card-text">{{ $store->address }}</p>
                            </div>
                        </div>
                        @endforeach


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

// // 평점에 따라 출력하기

// let stores = @json($stores);
// stores.forEach((store, index) => {
//     console.log(store);
//     console.log(store.id);
//     console.log(store.name);
//     let rating = store.rating_average;
//     console.log(rating);
//     let id = index+1;
//     console.log(id);
//     let star = 'star_'+''+id+'';
//     console.log(star);
//     let starHalf = 'starHalf_'+''+id+'';
//     console.log(starHalf);
//     countingStars(rating, star, starHalf);
// });


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


// 찜 하트 변경

function wishChange(buttonId, storeIdForm){
    
    let heart = document.getElementById(buttonId);
    let value = heart.getAttribute('value');
    let storeId = document.getElementById(storeIdForm);


    switch(value){
        case '1':
            heart.setAttribute('src','/images/redheart.png');
            heart.setAttribute('value','2'); 
            storeId.submit();
            break;
        case '2':
            heart.setAttribute('src','/images/whiteheart.png'); 
            heart.setAttribute('value','1');
            storeId.submit();
            break;    
    }

    console.log(storeId);
    console.log(value);
    console.log(buttonId);
}



</script>

@endsection