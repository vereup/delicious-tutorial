<div class="d-flex flex-column p-2 w-100">
    <p class="mb-1">
        <span class="fw-bold"><span class="fw-bold" id="resultCount" style="color: red;">{{ $stores->count() }}</span>개의 맛집이 필터와 일치합니다</span>
    </p>
    <p class="fs-6">현재 적용된 검색필터</p>
    <div>
        @if (request()->categoryList)
        @php
            $categoryList = explode(',', request()->categoryList);
        @endphp
            <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-auto" id="filterCategory" >카테고리 : @foreach ($categoryList as $id)
                @if(array_search($id, $categories->pluck('id')->toArray()) !== false)
                    @if($loop->last == 0)
                    {{ $categories->find($id)->name }} |
                    @else
                    {{ $categories->find($id)->name }} 
                    @endif
                @endif
            @endforeach
            <span class="fs-6 text-black-50" style="cursor: pointer;">&nbsp; &nbsp; X</span>
        </button>
        @endif

        @if (request()->ratingList)
        @php
            $min = min($ratingList = explode(',', request()->ratingList));
            $max = max($ratingList = explode(',', request()->ratingList));
        @endphp
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterRating">평점 : 
            @if($min == $max && $min != 5)
                {{ $min }}점 ~
            @elseif($min == $max && $min == 5)
                ~ {{ $min }}점
            @else
            {{ $min }}점 ~ {{ $max }}점
            @endif
            
    <span class="fs-6 text-black-50" style="cursor: pointer">&nbsp; &nbsp; X</span>
</button>
        @endif
        @if (request()->keyword)
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterkeyword">검색어 : {{ request()->keyword }}
            <span class="fs-6 text-black-50" style="cursor: pointer">&nbsp; &nbsp; X</span>
        </button>
        @endif
    </div>
</div>

<script>

// 각 검색결과 클릭시 필터 해제
$("#filterCategory").click(function(){
    $("input[data-type=category]").prop("checked", false);
    changeCondition();
});

$("#filterRating").click(function(){
    $("input[data-type=rating]").prop("checked", false);
    changeCondition();
});

$("#filterkeyword").click(function(){
    $("input[data-type=keyword]").val('');
    changeCondition();
});


</script>