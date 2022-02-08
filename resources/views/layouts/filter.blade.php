<div class="d-flex flex-column p-2 w-100">
    <p class="mb-1">
        <span class="fw-bold" id="resultCount" style="color: red;"></span><span class="fw-bold">{{ $storeCounts }}개의 맛집이 필터와 일치합니다</span>
    </p>
    <p class="fs-6">현재 적용된 검색필터</p>
    <div>
        @if ($categoryList != 'all')
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterCategory">카테고리 : @foreach ($categoryList as $id)
        @foreach ($categories as $category)
         @if($category->id == $id)
          {{ $category->name }}
          @endif
          @endforeach
        @endforeach
        </button>
        @endif
        @if ($ratingList != null )
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterRating">평점 : @foreach ($ratingList as $rating)
        {{ $rating }}
    @endforeach</button>
        @endif
        @if ($keyword != null)
        <button type="button" class="btn bg-white btn-light rounded-pill px-4 w-25" id="filterkeyword">검색어 : {{ $keyword }}</button>
        @endif
    </div>
</div>

<script>

</script>