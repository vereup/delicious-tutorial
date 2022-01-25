@extends('layouts.main')
@extends('layouts.detailbody')
@extends('detail')


@section('detailHasReview')
        <div class="d-flex border-bottom text-white mx-1" data-coreui-target="#modifyModal" data-coreui-toggle="modal"
            style="background: #455A64; cursor:pointer;">
                <div class="col-9 ps-3 py-2">
                    <p class="card-text">
                        @php
                            $now = (strtotime(date('Ymd H:i:s')))/86400;
                            $updated_at = (strtotime($review->updated_at))/86400;
                            $interval = floor($now - $updated_at);
                        @endphp
                        @if ($interval < 1)
                            오늘
                        @else
                            {{$interval}} 일전
                        @endif
                    </p>
                    <h5 class="card-title">{{$review->title}}</h5>
                    <p class="card-text">{{$review->contents}}</p>
                    <p class="card-text">  
                        방문 날짜 : 
                        @php
                            $date = date("Y-m-d", strtotime($review->been_date));
                            echo $date;
                        @endphp
                    </p>
            </div>
        </div>

@endsection