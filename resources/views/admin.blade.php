@extends('layouts.main')

@section('content')


<div class="container-fluid">





    <div class="d-flex flex-row docs-highlight mx-0 mb-0" style="background-color: #E5E5E5">

        <div class="d-flex flex-column docs-highlight mb-3 bg-white">
            {{-- 상단제목 --}}
            <div class="p-2 docs-highlight"><h1 class="fw-bold">맛집목록</h1></div>
            
            {{-- 검색창 --}}
            <form method="GET" action="{{ route('adminSearch') }}">
            <div class="p-2 docs-highlight">
                <div class="col-9">
                    <input>
                    <input>
                    <input>
                    <input>
                </div>

                <div class="col-3"><button>돋보기</button></div>

            </div>
            </form>

            {{-- 테이블 --}}
            <div class="p-2 docs-highlight">
                <table class="table">
                    <thead>
                      <tr>
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
                      <td>{{ $store->address }}</td>
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
            <div class="p-2 docs-highlight">{{ $stores->links() }}</div>
          </div>




    </div>
</div>

@endsection