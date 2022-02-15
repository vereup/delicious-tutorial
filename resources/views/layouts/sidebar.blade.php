<div class="m-2">
    <div class="sidebar sidebar-show">
        <ul class="sidebar-nav" data-coreui="navigation">
            <li class="nav-title" style="font-size: 18px;">카테고리</li>
            <li class="nav-item nav-group bg-white">
                <ul class="list-group p-0">
                    <form method="GET" id="Form" action={{ route('home') }}>
                        @csrf
                        <input type="hidden" id="categoryList" name="categoryList" value="">
                    @foreach ($categories as $category)
                    <li class="list-group-item">
                        <input class="form-check-input me-1 category" type="checkbox" name="category" 
                        value="{{ $category->id }}" id="category_{{ $category->id }}">
                        <label class="form-check-label" style="color: black; font-size:15px;">{{ $category->name }}</label>
                    </li>
                    @endforeach
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
                        <input type="hidden" id="ratingList" name="ratingList" value="">
                    @for($i=0;$i<5;$i++)
                    <li class="list-group-item">
                        <input class="form-check-input me-1 rating" type="checkbox" name="rating" value="{{ $i+1 }}" id="rating_{{ $i+1 }}">
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

//키워드 입력시 서버전송
$("#keywordButton").click(function(){

    let search = $("#search").val();
    if (search != ''){
    $("#keyword").val(search);
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
$(".category").change(function() {

    let search = $("#search").val();
    if (search != ''){
    $("#keyword").val(search);
    }
    
    let list = new Array();
    $("input[name=category]:checked").each(function(index, item){
        list.push($(item).val());
    });
    $("#categoryList").val(list);


    let ratingList = new Array();
    $("input[name=rating]:checked").each(function(index, item){
        ratingList.push($(item).val());
    });
    $("#ratingList").val(ratingList);


    $("#Form").submit();
});

// 평점변경시 서버전송
$(".rating").change(function() {

    let search = $("#search").val();
    if (search != ''){
    $("#keyword").val(search);
    }

    let list = new Array();
    $("input[name=category]:checked").each(function(index, item){
        list.push($(item).val());
    });

    $("#categoryList").val(list);

    let ratingList = new Array();
    $("input[name=rating]:checked").each(function(index, item){
        ratingList.push($(item).val());
    });
    $("#ratingList").val(ratingList);



    $("#Form").submit();
});


let categoryList = @json($categoryList);

if(categoryList != 'all'){
categoryList.forEach(selectId => {
    console.log(selectId);
    document.getElementById('category_'+selectId+'').setAttribute('checked', 'checked');
});
}

let ratingList = @json($ratingList);

if(ratingList != 'all'){
ratingList.forEach(selectId => {
    console.log(selectId);
    document.getElementById('rating_'+selectId+'').setAttribute('checked', 'checked');
});
}







</script>





