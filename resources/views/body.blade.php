<main class="c-main">

    <div class="container-fluid pb-3">

        <div class="d-flex flex-row docs-highlight mb-3">
            <div class="col-2 p-2 docs-highlight">
                <div class="d-flex flex-column docs-highlight mb-3">
                    <div class="row m-2 shadow p-0 mb-2 bg-body rounded">
                        <div class="sidebar sidebar-show">
                            <ul class="sidebar-nav" data-coreui="navigation">
                                <li class="nav-title" style="font-size: 18px;">카테고리</li>
                                <li class="nav-item nav-group bg-white">
                                    <ul class="list-group p-0">
                                        @for($i=0;$i<7;$i++) 
                                        <li class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                                                <label class="form-check-label" style="color: black; font-size:15px;" id="categoryName{{ $i }}"></label>
                                                </li>
                                        @endfor
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row m-2 shadow p-0 mb-5 bg-body rounded">
                        <div class="sidebar sidebar-show">
                            <ul class="sidebar-nav" data-coreui="navigation">
                                <li class="nav-title" style="font-size: 18px;">평점</li>
                                <li class="nav-item nav-group bg-white">
                                    <ul class="list-group p-0">
                                        @for($i=0;$i<5;$i++)
                                        <li class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
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
                </div>
            </div>

            <div class="col-10 p-2 docs-highlight">
                <div class="d-flex flex-column docs-highlight mb-3">
                    <div class="m-2 docs-highlight bg-white">
                        <div class="d-flex flex-column p-2">
                            <p class="mb-1">
                                <span class="fw-bold" id="resultCount" style="color: red;"></span><span class="fw-bold">개의 맛집이 필터와 일치합니다</span>
                            </p>
                            <p class="fs-6">현재 적용된 검색필터</p>
                            <div>
                                <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterCategory">카테고리 : 카페&디저트</button>
                                <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterRating">평점 : 5</button>
                                <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterkeyword">검색어 : </button>
                            </div>
                        </div>
                    </div>
                    <div class="m-2 docs-highlight">
                        <div class="d-flex flex-wrap">
                            @for($k=0;$k<6;$k++)
                            {{-- 맛집카드 --}}
                            <div class="card rounded me-2 my-1" style="width: 275px; height: 350px;">
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
                                        {{-- 로그인후 찜여부에따라 하트변경 --}}
                                </div>
                                <div class="card-body">
                                    <a class="card-title" href="/detail" style="color :black; text-decoration : none; font-weight: bold; font-size: 18px;"><p class="mb-0" id="storeName{{ $k }}"></p></a>
                                    <a id="stars_{{ $k }}"><a id="starHalf_{{ $k }}"></a></a>
                                        {{--  찜 카운트에 따라 변경  --}}
                                        <span class="ms-1" id="ratingCount{{ $k }}"></span>
                                        <br>
                                        <p class="card-text" id="address{{ $k }}"></p>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</main>


<script>


// 카테고리명 출력
let categories = new Array ("한식", "양식", "일식", "중식", "아시안 요리", "카페&디저트", "기타");
let i=0;
while(i<categories.length){
    document.getElementById('categoryName'+i+'').innerText = categories[i];
    i= i+1;
}

// 스토어카드 상호출력
let storeArray = new Array ("수박화채 1호점", "라멘집", "베이커리&샌드위치", "샤브샤브&훠궈", "도너츠", "스테이크");
i = 0;
while(i<storeArray.length){
    document.getElementById('storeName'+i+'').innerText = storeArray[i];
    i= i+1;
}

// 스토어카드 주소출력
let addressArray = new Array ("서울시 서초구", "서울시 강남구", "서울시 마포구", "경기도 분당구", "경기도 일산동구", "서울시 용산구");
i = 0;
while(i<addressArray.length){
    document.getElementById('address'+i+'').innerText = addressArray[i];
    i= i+1;
}

// 스토어카드 평점개수출력
let ratingCountArray = new Array (123, 333, 221, 21, 11, 2);
i = 0;
while(i<ratingCountArray.length){
    document.getElementById('ratingCount'+i+'').innerText = '('+ratingCountArray[i]+')';
    i= i+1;
}

// 검색결과 출력
document.getElementById('resultCount').innerText = storeArray.length;

// 스토어카드 별세기 함수
function countingStars(rating, stars, starHalf){
    let i=1;
    let j=5;
    let starCount = parseInt(rating);
    let starHalfCount = (rating-starCount)*10;
    let imgURL = '';

    while(i<=starCount){
        imgURL = imgURL + '<img src="/images/star.png">';
        i = i+1;
    }
    document.getElementById(''+stars+'').innerHTML = imgURL;

    if(j<starHalfCount){
        document.getElementById(''+starHalf+'').innerHTML = '<img src="/images/star_half.png">';
        
    }
}

// 평점에 따라 출력하기
let ratingArray = new Array (4.6, 3.7, 2.3, 4.3, 1.5, 2.0);

k = 0;
while (k<6){
    let stars = 'stars_' + k;
    let starHalf = 'starHalf_' + k;
    console.log(stars, starHalf);
    countingStars(ratingArray[k], stars, starHalf);
    console.log(ratingArray[k]);
    k=k+1;
}

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


</script>

