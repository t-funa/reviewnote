@extends('layouts.app')
@section('content')
  <main class="main">
    <form method="POST" action="delete" onSubmit="return checkDelete()">
    @csrf
      <input class="btn btn-outline-danger" type="submit" value="1つの項目を削除">
      @if(session('success'))
        <div class="alert alert-success" role="alert">
        {{ session('success') }}
        </div>
      @endif
      <div class="row overflow-auto" style='max-height: 66vh; --bs-gutter-x: 0rem;'>
        <div class="col-md-2 p-0">
          <div class="card h-100">
            <div class="card-header">教科</div>
            <div class="card-body py-2 px-4">
            @foreach($subjects as $subject)
              <fieldset>
                <input type="checkbox" name="subjectIds[]" value="{{ $subject->id }}"> {{ $subject->name }}
              </fieldset>
            @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-2 p-0">
          <div class="card h-100">
            <div class="card-header d-flex">単元</div>
            <div class="card-body py-2 px-4">
            @foreach($units as $unit)
              <fieldset>
                <input type="checkbox" name="unitIds[]" value="{{ $unit->id }}"> {{ $unit->name }}
              </fieldset>
            @endforeach
            </div>
          </div>
        </div>

        <div class="col-md-4 p-0">
          <div class="card h-100">
            <div class="card-header d-flex">授業のめあて</div>
            <div class="card-body p-2">
            @foreach($purposes as $purpose)
              <fieldset>
                <input type="checkbox" name="purposeIds[]" value="{{ $purpose->id }}"> {{ $purpose->content }}
              </fieldset>
            @endforeach
            </div>
          </div>    
        </div>

        <div class="col-md-4 p-0">
          <div class="card h-100">
            <div class="card-header d-flex">ふりかえり</div>
            <div class="card-body p-2">
            @foreach($reviews->sortByDesc('created_at') as $review)
              <fieldset>
                <input type="checkbox" name="reviewIds[]" value="{{ $review->id }}">{{ $review->number }}  {{ $review->first_name }}
              </fieldset>
            @endforeach
            </div>
          </div>   
        </div>
      </div>
    </form>

  <script>
  function checkDelete(){
    if(window.confirm('選択した項目を削除してよろしいですか？')){
      return true;
    }else{
      return false;
    }
  }
  </script>
  </main>
@endsection
