@extends('layouts.app')

@section('content')
<main class="main">
@if(session('success'))
    <div class="alert alert-success" role="alert">
    {{ session('success') }}
    </div>
@endif
    <div class="row overflow-auto" style='max-height:70vh; --bs-gutter-x: 0rem;'>
        <div class="col-md-3 p-0">
            <div class="card h-100">
                <div class="card-header">教科</div>
                <div class="card-body py-2 px-4">
                    <p class='d-block'>{{ $subject->name }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 p-0">
            <div class="card h-100" style="border-width: 3px;">
                <div class="card-header d-flex">単元</div>
                <div class="card-body py-2 px-4">
                @foreach($subject->units as $unit)
                    <a href="/unit/{{ $unit->id }}" class='d-block'>{{ $unit->name }}</a>
                @endforeach
                    <form method='POST' action="/store" style="display:flex; height:37px; margin-top:24px;">
                    @csrf
                        <div class="form-group"> 
                            <input type='hidden' name='user_id' value="{{ $user->id }}">
                            <input type='hidden' name='subject_id' value="{{ $subject->id }}">
                            <input name='unit' type="text" class="form-control" id="unit" style="width:20vh" placeholder="単元名" required>
                        </div>
                        <button name="unitAdd" type='submit' class="btn btn-outline-secondary btn-sm">追加</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-0">
            <div class="card h-100">
                <div class="card-header d-flex">授業のめあて</div>
                <div class="card-body p-2">
                @foreach($subject->purposes as $purpose)
                    <a href="/purpose/{{ $purpose->id }}" class='d-block'>{{ $purpose->content }}</a>
                @endforeach
                </div>
            </div>    
        </div>

        <div class="col-md-2 p-0">
            <div class="card h-100">
                <div class="card-header d-flex">ふりかえり</div>
                <div class="card-body p-2">
                @foreach($subject->reviews->sortBy('number') as $review)
                    <p class='d-block'>{{ $review->number }}  {{ $review->first_name }}</p>
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