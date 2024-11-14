@extends("layouts.main")

@section("title",$title)

@section('content')
<div class="container">
    <h1 class="my-3">{{$title}}</h1>

    @if(!Route::has("toplist.category"))
        <div class="alert alert-danger">
            A <code>toplist.category</code> route nincs definiálva, így nem lesz kattintható egyik kategória sem!
        </div>
    @endif

    <ul>
    @foreach($categories as $category)
        @if(Route::has("toplist.category"))
            <li><a href="{{route("toplist.category",["category_name" => $category])}}">{{$category}}</a></li>
        @else
            <li>{{$category}}</li>
        @endif
    @endforeach
    </ul>

</div>
@endsection