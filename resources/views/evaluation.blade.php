@extends('layouts.app')

@section('content')
<main class="main">

  <h2 style="font-size:16px;">ふりかえり評価</h2>
  @if(session('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
  @endif

  <div class="row overflow-auto" style='max-height:64vh; --bs-gutter-x: 0rem;'>

    <div class="col-md-3 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">1~10</div>
        <div class="card-body p-2">
        @foreach($reviews->sortBy('number') as $review)
        @if($review->number <11)
          <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
          <em name='count' class="form-control">{{ $review['point'] }}</em>
        @endif
        @endforeach
        </div>
      </div>   
    </div>

    <div class="col-md-3 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">11~20</div>
        <div class="card-body p-2">
        @foreach($reviews->sortBy('number') as $review)
        @if($review->number >10 && $review->number<21)
          <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
          <em name='count' class="form-control">{{ $review['point'] }}</em>
        @endif
        @endforeach   
        </div>
      </div>   
    </div>

    <div class="col-md-3 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">21~30</div>
        <div class="card-body p-2">
        @foreach($reviews->sortBy('number') as $review)
        @if($review->number >20 && $review->number<31)
          <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
          <em name='count' class="form-control">{{ $review['point'] }}</em>
        @endif
        @endforeach
        </div>
      </div>   
    </div>

    <div class="col-md-3 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">31~40</div>
        <div class="card-body p-2">
        @foreach($reviews->sortBy('number') as $review)
        @if($review->number >30 && $review->number<41)
          <p style="margin:2px;">{{ $review->number }}  {{ $review->first_name }}</p>
          <em name='count' class="form-control">{{ $review['point'] }}</em>
        @endif
        @endforeach
        </div>
      </div>   
    </div>

  </div>
</main>
@endsection
