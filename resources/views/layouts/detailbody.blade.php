@section('content')
                <div class="container-fluid p-2">
                    <div class="d-flex flex-column docs-highlight bg-white">
                        <div class="d-flex">
                            <div class="col-11 ps-3 py-4">
                                <p class="card-title fs-3 fw-bold">{{$store->name}}
                                    <a class="stars" value="{{ $store->rating_average }}">{{ $store->rating_average }}<a id="starHalf"></a></a> 
                                    <span class="text" style="font-size: 10pt;">&#40;{{$store->review_count}}&#41;</span>
                                </p>
                                <p class="card-text pb-2"><img src="/images/location.png">&nbsp;{{ $store->county->city->city }} {{ $store->county->county }} {{$store->address_detail}}
                                    <span class="fw-bold" style="color: #a0a0a0;">&nbsp;|</span>
                                    <img src="/images/telephone.png">&nbsp;&nbsp;<span id="telephone">{{ $store->localCode->number }} {{$store->telephone_number}}</span>
                                </p>
                            </div>
                            <div class="col-1 pt-5">
                                {{-- 찜버튼 --}}
                                    <div>
                                        @guest
                                        <button type="submit" class="p-2 bg-white" style="border: 1px solid #A0A0A0; border-radius: 50%;">
                                        <img src="/images/whiteheart.png" onclick="alert('로그인해주세요');" name="{{ $store->id }}" value="1" width="25" height="25">
                                        </button>
                                        @else

                                        @php
                                            $wish = $store->wishes()->where('user_id', request()->user()->id)->first();
                                        @endphp

                                        <form method="POST" action="{{ $wish ? route('removeWish', ['storeId' => $store->id]) : route('addWish', ['storeId' => $store->id]) }}">
                                            @csrf
                                                <button type="submit" class="p-2 bg-white" style="border: 1px solid #A0A0A0; border-radius: 50%;">
                                                    <img name="{{ $store->id }}" src="/images/{{ $wish ? 'redheart' : 'whiteheart' }}.png" width="23" height="26">
                                                </button>
                                        </form>

                                        @endguest
                                </div>
                        </div>
                    </div>
                    <div class="p-2 docs-highlight">
                        <div class="d-flex flex-row border-top border-bottom">
                            <div class="col-6 p-2 border-end text-center">
                                <div id="carouselExampleFade" class="carousel slide" data-coreui-interval="false" data-coreui-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active px-5">
                                            <img class="d-block w-100" src="{{$store->images[0]->path}}">
                                        </div>
                                        @foreach ($store->images as $storeImage)
                                            @if ($loop->first)
                                                @continue
                                            @endif
                                            <div class="carousel-item px-5">
                                                <img class="d-block w-100" src="{{$storeImage->path}}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button
                                        class="carousel-control-prev"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="prev">
                                            <img src="/images/left.png" width="30" height="30">
                                    </button>
                                    <button
                                        class="carousel-control-next"
                                        type="button"
                                        data-coreui-target="#carouselExampleFade"
                                        data-coreui-slide="next">
                                            <img src="/images/right.png" width="30" height="30">
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
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>


@endsection

