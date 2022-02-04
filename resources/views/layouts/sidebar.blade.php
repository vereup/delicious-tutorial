<div class="m-2">
    <div class="sidebar sidebar-show">
        <ul class="sidebar-nav" data-coreui="navigation">
            <li class="nav-title" style="font-size: 18px;">카테고리</li>
            <li class="nav-item nav-group bg-white">
                <ul class="list-group p-0">
                    <form method="GET" id="categoryForm" action={{ route('category') }}>
                        @csrf
                        <input type="hidden" id="categoryList" name="categoryList" value="">
                    @foreach ($categories as $category)
                    <li class="list-group-item">
                        <input class="form-check-input me-1 category" type="checkbox" name="category" value="{{ $category->id }}" id="category_{{ $category->id }}">
                        <label class="form-check-label" style="color: black; font-size:15px;">{{ $category->name }}</label>
                    </li>
                    @endforeach
                    </form>
                    {{-- @for($i=0;$i<7;$i++) 
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                        <label class="form-check-label" style="color: black; font-size:15px;" id="categoryName{{ $i }}"></label>
                    </li>
                    @endfor --}}
                </ul>
            </li>
        </ul>
    </div>

    <div class="my-2"></div>

    <div class="sidebar sidebar-show">
        <ul class="sidebar-nav" data-coreui="navigation">
            <li class="nav-title" style="font-size: 18px;">평점</li>
            <li class="nav-item nav-group bg-white">
                <ul class="list-group p-0">
                    <form method="GET" id="ratingForm" action={{ route('rating') }}>
                        @csrf
                        <input type="hidden" id="ratingList" name="ratingList" value="">
                    @for($i=0;$i<5;$i++)
                    <li class="list-group-item">
                        <input class="form-check-input me-1 rating" type="checkbox" name="rating" value="{{ $i+1 }}" aria-label="...">
                            @for($j=0;$j<=$i;$j++)
                                <img src="/images/star.png">
                            @endfor
                    </li>
                    @endfor
                </ul>
            </li>
        </ul>
    </div>

</div>



<script>



$(".category").change(function() {
    let list = new Array();
    $("input[name=category]:checked").each(function(index, item){
        list.push($(item).val());
    });

    $("#categoryList").val(list);
    $("#categoryForm").submit();
});


$(".rating").change(function() {
    let list = new Array();
    $("input[name=rating]:checked").each(function(index, item){
        list.push($(item).val());
    });
    
    $("#ratingList").val(list);
    $("#ratingForm").submit();
});


</script>





{{-- <script>


// 카테고리명 출력
let categories = new Array ("한식", "양식", "일식", "중식", "아시안 요리", "카페&디저트", "기타");
let i=0;
while(i<categories.length){
    document.getElementById('categoryName'+i+'').innerText = categories[i];
    i= i+1;
}



</script> --}}

