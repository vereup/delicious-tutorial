<main class="c-main">
  <div class="container-fluid">
    
      <div class="row">
        <div class="col-2" style="width: 250px;">
          <div class="row m-2 shadow p-0 mb-5 bg-body rounded"  style="width: 234px;">
            <div class="list-group-title p-2" style="background: #455A64;">
                cartegory
            </div>
            <ul class="list-group p-0">
                @for($i=0;$i<5;$i++)
                <li class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    category->name
                </li>
                @endfor
            </ul>
          </div>
              
          <div class="row m-2 shadow p-0 mb-5 bg-body rounded"  style="width: 234px;">
              <div class="list-group-title p-2" style="background: #455A64;">
                  rating
              </div>
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
          </div>
          </div>

        <div class="col">
          <div class="bg-white m-3">
            <div class="d-flex">
                <p class="fw-bold" style="color: red;">...</p>
                <p class="fw-bold">개의 맛집이 필터와 일치합니다</p>
            </div>
          </div>
          <div class="d-flex flex-wrap m-2">
            {{-- 맛집카드 --}}
            @for($k=0;$k<10;$k++)
              <div class="card rounded mx-1 my-1" style="width: 275px; height: 350px;">
                      <img src="..." class="card-img-top border-bottom" alt="store->name" style="width: 275px; height: 236.49px;">
                      <div class="p-2 bg-white"
                      style="position: absolute; top: 10px; right: 10px; border: 1px solid #A0A0A0; border-radius: 50%;">
                      <img src="/images/whiteheart.png" width="23" height="26"> {{-- 로그인여부에따라 하트변경 --}}
                  </div>{{-- 하트 --}}
                  <div class="card-body" onclick=""> {{-- 클릭시스토어로 연결 --}}
                      <h5 class="card-title">store->name</h5>
                      <img src="/images/star.png"> {{--  평점에따라별갯수출력  --}}
                      <span class="ms-1">ratingcount</span><br>
                      <p class="card-text">address</p>
                  </div>
              </div>
            @endfor

          </div>
        </div>
      </div>
  </div>  
</main>
