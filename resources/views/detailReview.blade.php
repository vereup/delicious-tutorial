@extends('layouts.main')
@extends('layouts.detailbody')

@section('detailContent')
    <div class="p-2 docs-highlight">
        <div class="row">
            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;리뷰개수&#41;</h2>
        </div>

        <div class="d-flex border-bottom text-white" data-coreui-target="#modifyModal" data-coreui-toggle="modal"
            style="background: #455A64; cursor:pointer;">
            <div class="col-9 ps-3 py-2">
                <p class="card-text">2일전</p>
                <h5 class="card-title">카츠샌드짱</h5>
                <p class="card-text">엄청맛있어요~!</p>
                <p class="card-text">방문 날짜 : 2021-09-10</p>
            </div>

        </div>
    </div>
    <div class="p-2 docs-highlight my-0 py-0">
        <div class="d-flex border-bottom">
            <div class="col-9 ps-3 py-2">
                <p class="card-text">2일전</p>
                <h5 class="card-title">카츠샌드짱</h5>
                <p class="card-text">엄청맛있어요~!</p>
                <p class="card-text">방문 날짜 : 2021-09-10</p>
            </div>
        </div>
    </div>
@endsection


{{-- 리뷰 수정 모달 --}}
<div class="modal" tabindex="-1" id="modifyModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold fs-3">리뷰수정</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="reviewTitle" class="form-label">제목</label>
                    <input type="email" class="form-control" id="reviewTitle" placeholder="제목">
                </div>
                <div class="mb-3">
                    <label for="reviewContents" class="form-label">내용</label>
                    <textarea class="form-control" id="reviewContents" rows="7" placeholder="내용"></textarea>
                </div>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4"
                    data-coreui-target="#modifyCheckModal" data-coreui-toggle="modal">확인</button>
                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
                    data-coreui-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>

{{-- 수정 확인 모달 --}}
<div class="modal" tabindex="-1" id="modifyCheckModal">
    <div class="modal-dialog modal-dialog-centered modalSize350">
        <div class="modal-content">
            <div class="modal-body">
                <p class="fw-bold text-center">리뷰를 수정하시겠습니까?</p>
            </div>
            <div class="modal-footer" style="justify-content: center;">
                <button type="button" class="btn btn-dark rounded-pill btn-primary px-4">확인</button>
                <button type="button" class="btn btn-gray rounded-pill btn-secondary px-4"
                    data-coreui-dismiss="modal">취소</button>
            </div>
        </div>
    </div>
</div>



<script>
    // 찜하트 변경

    function heartChange(id) {
        let heart;
        let value;
        heart = document.getElementById(id);
        value = heart.getAttribute('value');
        switch (value) {
            case '1':
                heart.setAttribute('src', '/images/redheart.png');
                heart.setAttribute('value', '2');
                break;
            case '2':
                heart.setAttribute('src', '/images/whiteheart.png');
                heart.setAttribute('value', '1');
                break;

        }
        console.log(value);
        console.log(heart.src);
        console.log(id);
    }
</script>
