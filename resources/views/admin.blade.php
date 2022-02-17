@extends('layouts.main')

@section('content')


<div class="container-fluid">



    <div class="d-flex flex-row docs-highlight mx-0 mb-0 justify-content-center" style="background-color: #E5E5E5">

        <div class="coutainer w-100 m-3 p-3 bg-white">
            {{-- 상단제목 --}}
            <div class="p-2 flex-column docs-highlight">
              <h2 class="fw-bold">맛집목록</h2>
            </div>
            
            {{-- 검색창 --}}
            
            <div class="p-2 flex-column docs-highlight border">
                <form method="GET" action="{{ route('adminSearch') }}">
<div class="row m-2">
<div class="col-md-10">
                <div class="d-flex m-3">
                  <div class="input-group">
                    <select class="form-select" aria-label="Default select example">
                      <option value="1">가게명</option>
                      <option value="2">전화번호</option>
                    </select>
                    <input type="text" class="form-control w-75">
                  </div>

                  <div class="input-group align-items-center">
                    <span class="input-group-text bg-white border-0 ms-3">카테고리</span>
                    <select class="form-select" aria-label="Default select example">
                        <option value="none">카테고리</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
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
                    <select class="form-select" aria-label="Default select example">
                      <option value="none">광역시도</option>
                      @foreach ($addresses as $address)
                      <option value="{{ $address->id }}">
                        {{ $address->city}}</option>
                      @endforeach
                    </select>
                    <select class="form-select" aria-label="Default select example">
                      <option value="none">시/군/구</option>
                      @foreach ($counties as $county)
                      <option value="{{ $county->id }}">
                        {{ $county->county}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="input-group w-25">
                  </div>

                </div>          
</div>
                <div class="col-md-2 align-self-center">
                <div class="d-flex justify-content-center">
                <button class="btn btn-secondary btn-gray text-white rounded-pill w-75"><img class="w-50" src="/images/magnifying_glass.png"></button>
                </div>
                </div>
</div>
              </form>
              </div>
            

            {{-- 테이블 --}}
            <div class="p-2 flex-column docs-highlight">
              <table class="table">
                <thead>
                  <tr class="bg-dark text-white">
                    <th scope="col">#</th>
                    <th scope="col">이름</th>
                    <th scope="col">카테고리</th>
                    <th scope="col">주소</th>
                    <th scope="col">전화번호</th>
                    <th scope="col">평점</th>
                    <th scope="col">찜 개수</th>
                    <th scope="col">보기</th>
                    <th scope="col">수정</th>
                    <th scope="col">삭제</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                    <tr>
                    
                  <th scope="row">{{ $store->id }}</th>
                  <td>{{ $store->name }}</td>
                  <td>{{ $store->category_id }}</td>
                  <td>{{ $store->address_detail }}</td>
                  <td>{{ $store->telephone_number }}</td>
                  <td>{{ $store->rating_average }}</td>
                  <td>{{ $store->rating_count }}</td>
                  <td>보기</td>
                  <td>수정</td>
                  <td>삭제</td>
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




    </div>


@endsection