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
                        
                        <input class="form-check-input me-1 category" type="checkbox" name="category" value="{{ $category->id }}" id="category_{{ $category->id }}">
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
                        <input class="form-check-input me-1 rating" type="checkbox" name="rating_{{ $i+1 }}" value="{{ $i+1 }}" id="rating_{{ $i }}">
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

let list = new Array();
$("input[name=category]:checked").each(function(index, item){
    list.push($(item).val());
});
$("#categoryList").val(list);

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
    $("#Form").submit();
});


let categoryList = @json($categoryList);

if(categoryList != 'all'){
categoryList.forEach(selectId => {
    console.log(selectId);
    document.getElementById('category_'+selectId+'').setAttribute('checked', 'checked');
});
}


let rating_1 = @json($rating_1);
if(rating_1 !== null){
    document.getElementById('rating_0').setAttribute('checked', 'checked');
}
else{
    document.getElementById('rating_0').removeAttribute('checked');
}

let rating_2 = @json($rating_2);
if(rating_2 !== null){
    document.getElementById('rating_1').setAttribute('checked', 'checked');
}
else{
    document.getElementById('rating_1').removeAttribute('checked');
}

let rating_3 = @json($rating_3);
if(rating_3 !== null){
    document.getElementById('rating_2').setAttribute('checked', 'checked');
}
else{
    document.getElementById('rating_2').removeAttribute('checked');
}

let rating_4 = @json($rating_4);
if(rating_4 !== null){
    document.getElementById('rating_3').setAttribute('checked', 'checked');
}
else{
    document.getElementById('rating_3').removeAttribute('checked');
}

let rating_5 = @json($rating_5);
if(rating_5 !== null){
    document.getElementById('rating_4').setAttribute('checked', 'checked');
}
else{
    document.getElementById('rating_4').removeAttribute('checked');
}





</script>





