<div class="d-flex flex-column p-2 w-100">
    <p class="mb-1">
        <span class="fw-bold"><span class="fw-bold" id="resultCount" style="color: red;">{{ $storeCounts }}</span>개의 맛집이 필터와 일치합니다</span>
    </p>
    <p class="fs-6">현재 적용된 검색필터</p>
    <div>
        @if ($categoryList != 'all')
            <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-auto" id="filterCategory" >카테고리 : @foreach ($categoryList as $id)
            @foreach ($categories as $category)
            @if($category->id == $id)
                @if($loop->parent->remaining == 0)
                    {{ $category->name }}
                @else
                    {{ $category->name }} |
                @endif
            @endif
            @endforeach
            @endforeach
            <span class="fs-6 text-black-50" style="cursor: pointer;">&nbsp; &nbsp; X</span>
        </button>
        @endif

        @if ($ratingList != 'all' )
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterRating">평점 : 
            @if($min != 5 && $max == 5.1)
                {{ $min }}점 ~
            @elseif($min == 5 && $max == 5.1)
                ~ {{ $min }}점

            {{-- @elseif($max == $min + 0.999 && $min != 5)
                {{ $min }}이상 ~ {{ $min+1 }}미만
                @elseif($max == $min + 0.999 && $min == 5)
                5 이상 --}}
            @else
            {{ $min }}점 ~ {{ $max }}점
            @endif
            
    <span class="fs-6 text-black-50" style="cursor: pointer">&nbsp; &nbsp; X</span>
</button>
        @endif

        {{-- @if ($ratingList != 'all' )
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterRating">평점 : 
            @if($max == 5)
                {{ $min }}이상 ~ {{ $max }}
            @elseif($max == $min + 0.999 && $min != 5)
                {{ $min }}이상 ~ {{ $min+1 }}미만
                @elseif($max == $min + 0.999 && $min == 5)
                5 이상
            @else
            {{ $min }}이상 ~ {{ $max+1 }}미만
            @endif
            
    <span class="fs-6 text-black-50" style="cursor: pointer">&nbsp; &nbsp; X</span>
</button>
        @endif --}}

        @if ($keyword != null)
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterkeyword">검색어 : {{ $keyword }}
            <span class="fs-6 text-black-50" style="cursor: pointer">&nbsp; &nbsp; X</span>
        </button>
        @endif
    </div>
</div>

<script>

//키워드 입력시 서버전송
$("#filterkeyword").click(function(){

let search = $("#search").val();
if (search != ''){
$("#keyword").val('');
}

let categoryList = new Array();
$("input[name=category]:checked").each(function(index, item){
    categoryList.push($(item).val());
});
$("#categoryList").val(categoryList);

let ratingList = new Array();
$("input[name=rating]:checked").each(function(index, item){
    ratingList.push($(item).val());
});
$("#ratingList").val(ratingList);


$("#Form").submit();

});


// 카테고리변경시 서버전송
$("#filterCategory").click(function() {

let search = $("#search").val();
if (search != ''){
$("#keyword").val(search);
}

$("#categoryList").val('');


let ratingList = new Array();
$("input[name=rating]:checked").each(function(index, item){
    ratingList.push($(item).val());
});
$("#ratingList").val(ratingList);


$("#Form").submit();
});

// 평점변경시 서버전송
$("#filterRating").click(function() {


let search = $("#search").val();
if (search != ''){
$("#keyword").val(search);
}

let list = new Array();
$("input[name=category]:checked").each(function(index, item){
    list.push($(item).val());
});

$("#categoryList").val(list);

$("#ratingList").val('');

$("#Form").submit();
});


</script>