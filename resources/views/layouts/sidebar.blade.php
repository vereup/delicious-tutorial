@php
    $categoryList = request()->categoryList;
    $ratingList = request()->ratingList;
@endphp

<div class="m-2">
    <div class="sidebar sidebar-show rounded-3 shadow">
        <ul class="sidebar-nav" data-coreui="navigation">
            <li class="nav-title my-2 text-white" style="font-size: 18px;">카테고리</li>
            <li class="nav-item nav-group bg-white rounded-bottom">
                <ul class="list-group p-0">
                    <form method="GET" id="Form" action={{ route('home') }}>
                        <input type="hidden" id="categoryList" name="categoryList" value="">
                    @foreach ($categories as $category)
                    <li class="list-group-item py-3 border-0 rounded-bottom">
                        <input class="form-check-input me-1 category" type="checkbox" name="category" @if(isset($categoryList) && array_search($category->id, explode(',', $categoryList)) !== false) checked @endif
                        value="{{ $category->id }}" id="category_{{ $category->id }}" data-type="category">
                        <label class="form-check-label" style="color: black; font-size:15px;">{{ $category->name }}</label>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
    <div class="my-2"></div>

    <div class="sidebar sidebar-show rounded-3 shadow">
        <ul class="sidebar-nav" data-coreui="navigation">
            <li class="nav-title my-2 text-white" style="font-size: 18px;">평점</li>
            <li class="nav-item nav-group bg-white rounded-bottom">
                <ul class="list-group p-0">
                        <input type="hidden" id="ratingList" name="ratingList" value="">
                    @for($i=0;$i<5;$i++)
                    <li class="list-group-item py-3 border-0 rounded-bottom">
                        <input class="form-check-input me-1 rating" type="checkbox" name="rating" data-type="rating" @if(isset($ratingList) && array_search($i+1, explode(',', $ratingList)) !== false) checked @endif
                        value="{{ $i+1 }}" id="rating_{{ $i+1 }}">
                            @for($j=0;$j<=$i;$j++)
                                <img src="/images/star.png">
                            @endfor
                    </li>
                    @endfor
                    <input type="hidden" id="keyword" name="keyword" value="">
                </form>
                </ul>
            </li>
        </ul>
    </div>

</div>



<script>



// 조건변경시 서버전송
$("input[data-type=category]").change(function(){
    changeCondition();
});
$(".rating").change(function(){
changeCondition();
});
    
function changeCondition(event) {
    
    let queryString = new Array();
    let host = `${window.location.protocol}//${window.location.host}`;

    let keyword = $("#keyword").val();
    
    let categoryList = new Array();
    $("input[data-type=category]:checked").each(function(index, item){
        categoryList.push($(item).val());
    });
    
    let ratingList = new Array();
    $("input[data-type=rating]:checked").each(function(index, item){
        ratingList.push($(item).val());
    });

    if(keyword.length > 0){
        queryString.push(`keyword=${keyword}`);
        console.log(queryString);
    }

    if(categoryList.length > 0){
        queryString.push(`categoryList=${categoryList.join(',')}`);
        console.log(queryString);
    }
    if(ratingList.length > 0){
        queryString.push(`ratingList=${ratingList.join(',')}`);
        console.log(queryString);
    }

    if(queryString.length > 0) window.location.href = `${host}?${queryString.join('&')}`;

    else window.location.href = `${host}`;

};


</script>





