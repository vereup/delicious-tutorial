@section('content')
                <div class="container-fluid p-2">
                    <div class="d-flex flex-column docs-highlight bg-white">
                        <div class="d-flex">
                            <div class="col-11 ps-3 py-4">
                                <p class="card-title fs-3 fw-bold">{{$store->name}}
                                    <img src="/images/star.png">
                                    <span class="text" style="font-size: 10pt;">&#40;{{$store->review_count}}&#41;</span>
                                </p>
                                <p class="card-text pb-2"><img src="/images/location.png">&nbsp;{{$store->address}}
                                    <span class="fw-bold" style="color: #a0a0a0;">&nbsp;|</span>
                                    <img src="/images/telephone.png">&nbsp;&nbsp;{{$store->telephone_number}}
                                </p>
                            </div>
                            <div class="col-1 pt-5">
                                {{-- 찜버튼 --}}
                                <button
                                    class="p-2 bg-white"
                                    style="border: 1px solid #A0A0A0; border-radius: 50%;">
                                    <div>
                                        @guest
                                        <img src="/images/whiteheart.png" onclick="alert('로그인해주세요');" name="{{ $store->id }}" value="1" width="25" height="25">
                                        @else
                                        @if($userWish == true)
                                        <img src="/images/redheart.png" onclick="heartChange(this.id)" name="{{ $store->id }}" value="2" width="25" height="25" id="heart">
                                        @else
                                        <img src="/images/whiteheart.png" onclick="heartChange(this.id)" name="{{ $store->id }}" value="1" width="25" height="25" id="heart">
                                        @endif
                                        @endguest
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="d-flex flex-row border-top border-bottom">
                            <div class="col-6 p-2 border-end text-center">
                                <div
                                    id="carouselExampleFade"
                                    class="carousel slide carousel-fade"
                                    data-coreui-ride="carousel"
                                    >
                                    <div class="carousel-inner">
                                            <div class="carousel-item active text-center">
                                            <img
                                                src="{{$store->images[0]->path}}"
                                                width="550"
                                                height="350">
                                                        
                                            </div>
                                        @foreach ($store->images as $storeImage)
                                            @if ($loop->first)
                                                @continue
                                            @endif
                                            <div class="carousel-item text-center">
                                                <img
                                                    src="{{$storeImage->path}}"
                                                    width="550"
                                                    height="350">
                                            </div>
                                        @endforeach

                                    </div>
                                    <button
                                        class="carousel-control-prev"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button
                                        class="carousel-control-next"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>

                            <div class="p-2 pt-3 ps-4">
                                <p class="text-start">{{$store->category->name}}</p>
                                <p class="text-start">{{$store->introduction}}</p>
                            </div>
                        </div>

                    </div>

@yield('detailContent')

        <div class="p-2 docs-highlight">
            <div class="d-flex justify-content-center">
                {{ $noUserReviews->links() }}
            </div>
        </div>
    </div>
</div>


@endsection

