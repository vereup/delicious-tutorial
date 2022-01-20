@extends('layouts.main')
@extends('layouts.detailbody')

@section('detailContent')
    <div class="p-2 docs-highlight">
        <div class="row">
            <h2 class="fs-5 fw-bold ps-4 pt-4 pb-2">리뷰 &#40;리뷰개수&#41;</h2>
        </div>
        <div class="row px-3">
            <button class="btn btn-dark" type="button" data-coreui-target="#loginModal" data-coreui-toggle="modal">로그인 후
                리뷰를 작성하실 수 있습니다.
        </div>
        <div class="d-flex border-top border-bottom">
            <div class="col-9 ps-3 py-2">
                <p class="card-text">2일전</p>
                <h5 class="card-title">카츠샌드짱</h5>
                <p class="card-text">엄청맛있어요~!</p>
                <p class="card-text">방문 날짜 : 2021-09-10</p>
        </div>

    </div>
    @endsection


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
