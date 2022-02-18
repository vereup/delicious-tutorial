@extends('layouts.main')

@section('content')


<div class="container-fluid position-relative" style="background-color: #E5E5E5">
    <div class="d-flex flex-row docs-highlight mx-0 mb-0" style="background-color: #E5E5E5">
        <div class="p-2 docs-highlight">
            @include('layouts.sidebar') 
        </div>
        <div class="p-2 flex-fill docs-highlight">
            <div class="d-flex flex-column docs-highlight mb-3">
                    @if ($categoryList != 'all' || $ratingList != 'all' || $keyword != null )
                    <div class="m-2 mt-0 docs-highlight bg-white">
                        @include('layouts.filter')
                    </div>
                    @endif
                <div class="m-2 mt-0 docs-highlight">
                    <div class="d-flex flex-wrap">
                        @foreach ($stores as $store)
                        {{-- 맛집카드 --}}
                        <div class="card rounded m-2 w-auto">
                            <a href="/store/{{$store->id}}"><img src="{{$store->images[0]->path}}" class="card-img-top border-bottom w-100" alt="store->name"></a>
                                @guest
                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="alert('로그인해주세요');" id="heart{{ $store->id }}" value="1">
                                </div>
                                @else
                                @if( $userWishCount != 0)
                                    @foreach ($userWishes as $wish)
                                        @if ($wish->store_id == $store->id)
                                        <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                            <img type="button" name="{{ $store->id }}" class="wishHeart" src="/images/redheart.png" width="23" height="26" value="2">
                                            </div>  
                                        @break
                                        @else
                                            <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                            <img type="button" name="{{ $store->id }}" class="wishHeart" src="/images/whiteheart.png" width="23" height="26" value="1">
                                        </div>
                                        @endif
                                    @endforeach
                                @else
                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                    <img type="button" name="{{ $store->id }}" class="wishHeart" src="/images/whiteheart.png" width="23" height="26" value="1";>
                                </div>
                                @endif
                                @endguest
                            <div class="card-body">
                                <a class="card-title" href="/store/{{$store->id}}" style="color :black; text-decoration : none; font-weight: bold; font-size: 18px;"
                                    ><p class="mb-0">{{ $store->name }}</p></a>
                                    <a class="stars" value="{{ $store->rating_average }}">{{ $store->rating_average }}<a id="starHalf"></a></a> 
                                    <span class="ms-1">	&#40;{{ $store->review_count }}&#41;</span>
                                    <br>
                                    <p class="card-text">{{ $store->county->city->city }} {{ $store->county->county }} {{ $store->address_detail }}</p>
                        </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>  
    <div class="rounded-circle mb-3 me-3 p-0 bg-white text-center position-absolute bottom-0 end-0" style="z-index:99999999; width: 40px; height: 40px; border: 1px solid #A0A0A0; border-radius: 50%; cursor:pointer;" 
            onclick="window.scrollTo(0,0);"><span class="fs-2">^</span></div>
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

@endsection

{{-- 하기 스크립트 섹션??? --}}
@section('script')
@parent

<script>


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



// 찜하트변경

$('.wishHeart').click(function(){
    let value = $(this).attr("value");
    let storeId = $(this).attr("name");


    if (value == 1){
        $('#addWishInput').val($(this).attr("name"));
        $('#addWish').submit();
    }

    else{
        $('#removeWishInput').val($(this).attr("name"));
        $('#removeWish').submit();
    }
});


// let starCount = $(".stars").val();

// console.log(starCount);



// // 스토어카드 별세기 함수
// function countingStars(rating, star, starHalf){
//     let i=1;
//     let j=5;
//     let starCount = parseInt(rating);
//     let starHalfCount = (rating-starCount)*10;
//     let imgURL = '';

//     while(i<=starCount){
//         imgURL = imgURL + '<img src="/images/star.png">';
//         console.log(imgURL);
//         i = i+1;
//     }
//     console.log(imgURL);
//     document.getElementById(''+star+'').innerHTML = imgURL;

//     if(j<starHalfCount){
//         document.getElementById(''+starHalf+'').innerHTML = '<img src="/images/star_half.png">';
        
//     }
// }



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






// 찜 하트 변경

// function wishChange(event){

//     let wow = $(this).val();

//     alert(wow);


    



    // let heart = document.getElementById(buttonId);
    // let value = heart.getAttribute('value');
    // let storeId = document.getElementById(storeIdForm);


    // switch(value){
    //     case '1':
    //         heart.setAttribute('src','/images/redheart.png');
    //         heart.setAttribute('value','2'); 
    //         storeId.submit();
    //         break;
    //     case '2':
    //         heart.setAttribute('src','/images/whiteheart.png'); 
    //         heart.setAttribute('value','1');
    //         storeId.submit();
    //         break;    
    // }

    // console.log(storeId);
    // console.log(value);
    // console.log(buttonId);
// }

// // 찜하트읽기

// $('.wishHearts').each(function(){

//     let storeId = $(this).attr("name");

//     $.ajax({
//             type : 'post',
//             url : "{{ route('checkWish') }}",
//             data : {
//                 'storeId' : storeId,
//             },
//             success : function(data) {
//                 if(data) {
//                     if(data == 'ok') {
//                         console.log(data);
//                         alert('가입 가능한 이메일입니다.');
//                         $('#emailSignup').attr('style', 'border: solid green;');
//                         $('#emailCheck').val('check');
                        
//                     }
//                     else if(data == 'duplicate') {
//                         console.log(data);
//                         alert('사용중인 이메일주소가 있습니다.');
//                         $('#emailSignup').attr('style', 'border: solid red;');
    
//                     }
//                 }
//             },
//             error : function(error) {
//                 console.log(error);
//             }
//         }); 
//     console.log(storeId);
// });




//     let userWishes = @json($userWishes);

//     userWishes.forEach(function(wish) {
//         console.log(wish);
//         // if($(this).name() = wish.store_id){
//         //     console.log($(this).name());
//         //     console.log(wish.store_id);

//         //     $(this).attr('src','/images/redheart.png');
//         //     $(this).val(2);
//         // }
//     });


// });

</script>

@endsection