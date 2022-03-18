@extends('layouts.main')

@section('content')


<div class="container-fluid position-relative" style="background-color: #E5E5E5">
    <div class="d-flex flex-row docs-highlight mx-0 mb-0" style="background-color: #E5E5E5">
        <div class="p-2 docs-highlight">
            @include('layouts.sidebar') 
        </div>
        <div class="p-2 flex-fill docs-highlight">
            <div class="d-flex flex-column docs-highlight mb-3">
                @if (request()->categoryList || request()->ratingList || request()->keyword )
                <div class="m-2 ms-3 docs-highlight bg-white">
                        @include('layouts.filter')
                    </div>
                    @endif
                <div class="m-2 mt-0 docs-highlight">
                    <div class="d-flex flex-wrap">
                        @foreach ($stores as $store)
                        {{-- 맛집카드 --}}
                        <div class="card rounded m-2 w-auto" style="min-width: 274px; max-width: 274px; min-height: 238px;">
                            <a style="min-height: 238px; background-image: url({{$store->images[0]->path}}); background-size:cover;" href="/store/{{$store->id}}"></a>
                                @guest
                                <div class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                <img type="button" src="/images/whiteheart.png" width="23" height="26" onclick="alert('로그인해주세요');" id="heart{{ $store->id }}" value="1">
                                </div>
                                @else
                                @php
                                    $wish = $store->wishes()->where('user_id', request()->user()->id)->first();
                                @endphp

                                <form method="POST" action="{{ $wish ? route('removeWish', ['storeId' => $store->id]) : route('addWish', ['storeId' => $store->id]) }}">
                                    @csrf
                                        <button type="submit" class="p-2 bg-white" style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                                            <img name="{{ $store->id }}" src="/images/{{ $wish ? 'redheart' : 'whiteheart' }}.png" width="23" height="26">
                                        </button>
                                </form>
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
{{-- <form method="POST" id="addWish" action="{{ route('addWish') }}">
    @csrf
    <input type="hidden" id="addWishInput" name="storeId" value="">
</form>
<form method="POST" id="removeWish" action="{{ route('removeWish') }}">
    @csrf
    <input type="hidden" id="removeWishInput" name="storeId" value="">
</form> --}}

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


</script>

@endsection