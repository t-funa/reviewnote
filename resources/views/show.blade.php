@extends('layouts.app')

@section('content')
<main class="main">
@if(session('success'))
  <div class="alert alert-success" role="alert">
  {{ session('success') }}
  </div>
@endif
  <div class="row" style='--bs-gutter-x: 0rem;'>
    
    <div class="col-md-3 p-0">
      <div class="card h-100" style="border-width: 3px;">
        <div class="card-header">教科</div>
        <div class="card-body py-2 px-4">
        @foreach($subjects as $subject)
          <a href="/subject/{{ $subject->id }}" class='d-block'>{{ $subject['name'] }}</a>
        @endforeach
          <form method='POST' action="/store" style="display:flex; height:37px; margin-top:24px;">
          @csrf
            <input type='hidden' name='user_id' value="{{ $user->id }}">
            <input type='hidden' name='semester_id' value="{{ $semester->id }}">
            <div class="form-group">
              <input name='subject' type="text" class="form-control" id="subject" style="width:12vh;" placeholder="教科名" required>
            </div>
            <button name="subjectAdd" type='submit' class="btn btn-outline-secondary btn-sm">追加</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-3 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">単元</div>
        <div class="card-body py-2 px-4">
        @foreach($units as $unit)
          <a href="/unit/{{ $unit->id }}" class='d-block'>{{ $unit['name'] }}</a>
        @endforeach
        </div>
      </div>
    </div>

    <div class="col-md-4 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">授業のめあて</div>
        <div class="card-body p-2">
        @foreach($purposes as $purpose)
          <a href="/purpose/{{ $purpose->id }}" class='d-block'>{{ $purpose['content'] }}</a>
        @endforeach
        </div>
      </div>    
    </div>

    <div class="col-md-2 p-0">
      <div class="card h-100">
        <div class="card-header d-flex">ふりかえり</div>
        <div class="card-body p-2">
        @foreach($reviews->sortByDesc('created_at') as $review)
          <p class='d-block'>{{ $review['number'] }}  {{ $review['first_name'] }}</p>
        @if($loop->iteration == 10)
        @break
        @endif
        @endforeach
        </div>
      </div>   
    </div>
  </div>
</main>
@endsection
