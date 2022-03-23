@extends('layouts.adminMain')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid d-flex flex-row docs-highlight px-0 mx-0 mb-0 justify-content-center" style="background-color: #E5E5E5">

  <div class="coutainer w-100 m-3 p-3 bg-white">
    {{-- 상단제목 --}}
  <div class="p-2 flex-column docs-highlight">
    <h2 class="fw-bold">맛집목록</h2>
  </div>
      
  {{-- 검색창 --}}
  <div class="m-2 flex-column docs-highlight border">
      <form method="GET" action="{{ route('adminSearch') }}">
        <div class="row m-2">
        <div class="col-sm-10">
      <div class="d-flex m-3">
        <div class="input-group" style="border-radius: 3px">
          <select class="form-select" aria-label="searchByKeyword"  onchange="select(event)">
            <option @if (isset($_REQUEST['storeName'])) selected @else @endif value="1">가게명</option>
            <option @if (isset($_REQUEST['storeTelephoneNumber'])) selected @else @endif value="2">전화번호</option>
          </select>
          @if (isset($_REQUEST['storeName']))
          <input type="text" class="form-control"  style="width: 50%" aria-label="searchByKeyword" 
          id="searchByKeyword" name="storeName" value="{{ $_REQUEST['storeName'] }}">
          @elseif (isset($_REQUEST['storeTelephoneNumber']))
          <input type="text" class="form-control" style="width: 50%" aria-label="searchByKeyword" 
          id="searchByKeyword" name="storeTelephoneNumber" value="{{ $_REQUEST['storeTelephoneNumber'] }}">
          @else
          <input type="text" class="form-control" style="width: 50%" aria-label="searchByKeyword" 
          id="searchByKeyword" name="storeName" value="">
          @endif
        </div>
        <div class="input-group ps-3 align-items-center">
          <span class="input-group-text bg-white border-0 ms-3">카테고리</span>
          <select class="form-select" style="border-radius: 3px" aria-label="Default select example" name="adminCategory">
              <option value="">카테고리</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" @if (isset($_REQUEST['adminCategory']) && $_REQUEST['adminCategory'] == $category->id ) selected @else @endif>
                {{ $category->name }}</option>
              @endforeach
            </select>
        </div>
        <div class="input-group w-25">
        </div>

      </div>



      <div class="d-flex m-3">
        <div class="input-group w-75">
          <span class="input-group-text bg-white border-0">주소</span>
          <select class="form-select" style="border-radius: 3px" aria-label="Default select example" onchange="selectCity(event)" name="adminCity">
            <option value="">광역시도</option>
            @foreach ($cities as $city)
            <option value="{{ $city->id }}" @if (isset($_REQUEST['adminCity']) && $_REQUEST['adminCity'] == $city->id ) selected @else @endif>
              {{ $city->city}}</option>
            @endforeach
          </select>
          <span class="px-3"></span>
          <select class="form-select countyList" style="border-radius: 3px" aria-label="Default select example" name="adminCounty" id="countyList">
            <option value="none">시/군/구</option>
            @if (isset($_REQUEST['adminCity']) && ($_REQUEST['adminCity']) != "")
            @foreach ($counties as $county)
              @if ($county->city_id == ($_REQUEST['adminCity']))
              <option value="{{ $county->id }}" @if (isset($_REQUEST['adminCounty']) && $_REQUEST['adminCounty'] == $county->id ) selected @else @endif>
              {{ $county->county }}</option>
              @endif
              @endforeach
            {{-- @else
            @foreach ($counties as $county)
            <option value="{{ $county->id }}">
              {{ $county->county }}</option>
              @endforeach --}}
            @endif
          </select>
        </div>

        <div class="input-group w-25">
        </div>

      </div>          
    </div>
      <div class="col-sm-2 align-self-center">
      <div class="d-flex justify-content-center">
      <button type="submit" id="searchSubmit" class="btn btn-secondary text-white rounded-pill w-75" style="background-color: #DFDFDF; border-color:#DFDFDF;"><img class="w-50" src="/images/magnifying_glass.png" ></button>
      </div>
      </div>
    </div>
    </form>
    </div>
            

      {{-- 테이블 --}}
      <div class="p-2 flex-column docs-highlight">
        <table class="table">
          <thead>
            <tr class="bg-dark" style="height: 3rem">
              <th scope="col" class="text-white text-center border-start border-end border-secondary" style="vertical-align: middle">#</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">이름</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">카테고리</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">주소</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">전화번호</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">평점</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">찜 개수</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">보기</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">수정</th>
              <th scope="col" class="text-white text-center border-end border-secondary" style="vertical-align: middle">삭제</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($stores as $store)
              <tr style="height: 3rem">
              
            <th class="text-center border-end border-start border-light" scope="row" style="vertical-align: middle">{{ ($loop->index+1)+(($stores->currentPage()-1)*5) }}</th>
            <td class="text-center border-end border-light" style="vertical-align: middle">{{ $store->name }}</td>
            <td class="text-center border-end border-light" style="vertical-align: middle">{{ $store->category->name }}</td>
            <td class="text-center border-end border-light" style="vertical-align: middle">{{ $store->county->city->city }} {{ $store->county->county }} {{$store->address_detail}}</td>
            <td class="text-center border-end border-light" style="vertical-align: middle"><span class="telephone">{{ $store->localCode->number }}{{$store->telephone_number}}</span></td>
            @php
              $rating_average = number_format($store->rating_average, 1);
            @endphp
            <td class="text-center border-end border-light" style="vertical-align: middle">{{ $rating_average }} &#40;{{ $store->review_count }}&#41;</td>
            <td class="text-center border-end border-light" style="vertical-align: middle">{{ $store->wishes->count() }}</td>
            <td class="text-center border-end border-light" style="vertical-align: middle"><a class="text-dark" data-coreui-toggle="modal" data-coreui-target="#viewStoreModal" style="cursor: pointer"
              data-storeName="{{ $store->name }}"
              data-storeCategory="{{ $store->category->name }}"
              data-storeAddress="{{ $store->county->city->city }} {{ $store->county->county }} {{$store->address_detail}}"
            data-storeTelephoneNumber="{{ $store->localCode->number }}{{$store->telephone_number}}"
              data-storeContents="{{ $store->introduction }}"
              data-storeImage="{{ $store->images }}"
              data-storeRating="{{ $store->rating_average }}"
              data-storeReviewCount="{{ $store->review_count }}"
              data-storeWishCount="{{ $store->wishes->count() }}"
              >보기</a></td>
            <td class="text-center border-end border-light" style="vertical-align: middle"><a class="text-dark" href="/admin/store/{{ $store->id }}" style="cursor: pointer">수정</a></td>
            <td class="text-center border-end border-light" style="vertical-align: middle"><a class="text-dark" style="cursor: pointer" data-coreui-toggle="modal" data-coreui-target="#deleteCheckModal" data-storeId="{{ $store->id }}">삭제</a></td>
          </tr>
            @endforeach
          </tbody>
        </table>

      </div>
          
      <div class="p-2 flex-column docs-highlight">
        <div class="d-flex justify-content-center">
        {{ $stores->links() }}</div>
        </div>
    </div>



        {{-- 상세보기 모달 --}}
        <div class="modal" tabindex="-1" id="viewStoreModal">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title fw-bold fs-3 ps-3" >상세보기</h5>
                      <div data-coreui-dismiss="modal" data-coreui-whatever="@mdo" aria-label="Close" style="cursor: pointer">
                          <span class="fw-bold">X</span>
                      </div>
                  </div>
                  <div class="modal-body">
                          <div class="mb-3">
                            <div class="row">
                            <div class="col-2">이름</div>
                            <div class="col" id="storeName"></div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <div class="row">
                            <div class="col-2">카테고리</div>
                            <div class="col" id="storeCategory"></div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <div class="row">
                            <div class="col-2">주소</div>
                            <div class="col" id="storeAddress"></div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <div class="row">
                            <div class="col-2">전화번호</div>
                            <div class="telephone col" id="storeTelephoneNumber"></div>
                            </div>
                          </div>
                          <div class="mb-3">
                            <div class="mb-2">상세설명</div>
                            <textarea class="form-control bg-white" id="storeContents" rows="5" disabled></textarea>
                          </div>
                          <div class="mb-3">
                            <div>이미지</div>
                            <div>
                                <div id="carouselExampleDark" class="carousel carousel-dark slide"
                                    data-coreui-interval="false">
                                    <div class="carousel-inner imageLists">
                                    {{-- 이미지들 --}}
                                    </div>
                                    <button
                                    class="carousel-control-prev"
                                    type="button"
                                    data-coreui-target="#carouselExampleDark"
                                    data-coreui-slide="prev">
                                        <img src="/images/left.png" width="30" height="30">
                                </button>
                                <button
                                    class="carousel-control-next"
                                    type="button"
                                    data-coreui-target="#carouselExampleDark"
                                    data-coreui-slide="next">
                                        <img src="/images/right.png" width="30" height="30">
                                </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                          <div class="row">
                          <div class="col-2 me-0 pe-0">리뷰 개수</div>
                          <p class="col-auto pe-0" id="storeRating" style="display: inline;"></p>&#40;
                          <p class="col-auto px-0" id="storeReviewCount" style="display: inline;"></p>&#41;
                          </div>
                        </div>
                        <div class="mb-3">
                          <div class="row">
                          <div class="col-2 me-0 pe-0">찜 개수</div>
                          <div  class="col" id="storeWishCount"></div>
                          </div>
                        </div>


                      {{-- </form> --}}
                  </div>
                  <div class="modal-footer" style="justify-content: center;">
                      <button
                          type="button"
                          class="btn btn-gray text-white rounded-pill btn-secondary px-4"
                          data-coreui-dismiss="modal">닫기</button>

                      <button type="button" style="display: none" data-coreui-target="#modifyCheckModal" data-coreui-toggle="modal" id="emptyCheckConfirm"></button>

                  </div>
              </div>
          </div>
      </div>

      {{-- 스토어 삭제 확인 모달 --}}
      <div class="modal" tabindex="-1" id="deleteCheckModal">
          <div class="modal-dialog modal-dialog-centered modalSize350">
              <div class="modal-content">
                  <div class="modal-body">
                      <p class="fw-bold text-center">맛집을 삭제하시겠습니까?</p>
                  </div>
                  <div class="modal-footer" style="justify-content: center;">
                      <button type="button" id="deleteOk" class="btn btn-dark rounded-pill btn-primary px-4" onclick="deleteStore()">확인</button>
                      <button
                          type="button"
                          class="btn btn-gray rounded-pill btn-secondary px-4"
                          data-coreui-dismiss="modal">취소</button>
                  </div>
              </div>
          </div>
      </div>
      

<script>

// 전화번호 형식변경 
$('.telephone').each(function(){
  var number = $(this).text(); 
$(this).text(number.replace(/[^0-9]/, '').replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1)$2$3`));
});

// 상세보기 모달

var detailModal = document.getElementById('viewStoreModal');
detailModal.addEventListener('show.coreui.modal', function (event) {
  var name = event.relatedTarget.getAttribute('data-storeName');
  var category = event.relatedTarget.getAttribute('data-storeCategory');
  var address = event.relatedTarget.getAttribute('data-storeAddress');
  var telephoneNumber = event.relatedTarget.getAttribute('data-storeTelephoneNumber');
  telephoneNumber = telephoneNumber.replace(/[^0-9]/, '').replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  var contents = event.relatedTarget.getAttribute('data-storeContents');
  var rating = event.relatedTarget.getAttribute('data-storeRating');
  var reviewCount = event.relatedTarget.getAttribute('data-storeReviewCount');
  var wishCount = event.relatedTarget.getAttribute('data-storeWishCount');
  var images = event.relatedTarget.getAttribute('data-storeImage');
  images = JSON.parse(images);

  var modalName = document.querySelector("#storeName");
  var modalCategory = document.querySelector("#storeCategory");
  var modalAddress = document.querySelector("#storeAddress");
  var modalTelephoneNumber = document.querySelector("#storeTelephoneNumber");
  var modalContents = document.querySelector("#storeContents");
  var modalRating = document.querySelector("#storeRating");
  var modalReviewCount = document.querySelector("#storeReviewCount");
  var modalWishCount = document.querySelector("#storeWishCount");
  
  modalName.textContent = name;
  modalCategory.textContent = category;
  modalAddress.textContent = address;
  modalTelephoneNumber.textContent = telephoneNumber;
  modalContents.textContent = contents;
  modalRating.textContent = rating;
  modalReviewCount.textContent = reviewCount;
  modalWishCount.textContent = wishCount;
  

  // 이미지틀 초기화
  var imageForm = document.querySelector('.imageLists');
  while(imageForm.hasChildNodes()){
  imageForm.removeChild(imageForm.firstChild);
  }

  // 첫번째 이미지  
  var firstImageElement = document.createElement('div');
  firstImageElement.className = 'carousel-item active px-5';
  firstImageElement.innerHTML = "<img class='d-block w-100' style='max-height:300px;' src="+images[0].path+">";
  firstImageElement.width = "250";

  imageForm.appendChild(firstImageElement);

  // 나머지 이미지
  for(i=1;i<images.length;i++){
    var imagesElement = document.createElement('div');
    imagesElement.className = 'carousel-item px-5';
    imagesElement.innerHTML = "<img class='d-block w-100' style='max-height:300px;' src="+images[i].path+">";
    imagesElement.width = "250";

    imageForm.appendChild(imagesElement);
  }

})


// 키워드 선택시 요소값 변경
function select(event){

  console.log(event.target.value);
  if(event.target.value == '1'){
    $('#searchByKeyword').attr('name', 'storeName');
    // $('#searchByKeyword').attr('value', '1');
  }
  else{
    $('#searchByKeyword').attr('name', 'storeTelephoneNumber');
    // $('#searchByKeyword').attr('value', '2');
  }
}

// 시도 선택시 시군구 요소값 변경
function selectCity(event){

  var cityId = event.target.value;
  console.log(cityId);

  if(cityId == ''){

    console.log(cityId);

    //시군구 요소 초기화
    var countyList = document.querySelector('.countyList');
    while(countyList.hasChildNodes()){
    countyList.removeChild(countyList.firstChild);
    }
    //시군구 첫번째 요소 추가
    var countyElementFirst = document.createElement('option');
    countyElementFirst.value = "none";
    countyElementFirst.innerText = '시/군/구';
    countyList.appendChild(countyElementFirst);
  }

 
  else{
  $.ajax({
            type : 'GET',
            url : "{{ route('selectCity') }}",
            data : {
                'cityId' : cityId,
            },
            success : function(data) {

                //시군구 요소 초기화
                var countyList = document.querySelector('.countyList');
                while(countyList.hasChildNodes()){
                  countyList.removeChild(countyList.firstChild);
                }
                //시군구 첫번째 요소 추가
                var countyElementFirst = document.createElement('option');
                countyElementFirst.value = "none";
                countyElementFirst.innerText = '시/군/구';
                countyList.appendChild(countyElementFirst);

                //시군구 요소들 추가
                for(i=0;i<data.length;i++){
                    var countyElement = document.createElement('option');
                    countyElement.value = data[i].id;
                    countyElement.innerText = data[i].county;
                    countyList.appendChild(countyElement);
                  }
            },
            
            error : function(error) {
                console.log(error);
            }
        });
      }
}

// 스토어 삭제 **check 삭제 성공시 메세지 변경 session??

var deleteCheckModal = document.getElementById('deleteCheckModal');
deleteCheckModal.addEventListener('show.coreui.modal', function (event) {
    var id = event.relatedTarget.getAttribute('data-storeId');
    var deleteOkButton = document.getElementById('deleteOk');
    deleteOkButton.setAttribute('data-storeId', id);
  });

function deleteStore(){
  
  var deleteOkButton = document.getElementById('deleteOk');
  var id = deleteOkButton.getAttribute('data-storeId');

  console.log(id);
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type : 'delete',
            url : "{{ route('deleteStore') }}",
            data : {
                'id' : id,
            },
            success : function(data) {
                        console.log(data);
                        $('#searchSubmit').click();                        
            },
            error : function(error) {
                console.log(error);
            }
  });

}
</script>
@endsection