@extends("layouts.main")

@section("title",$title)

@section('content')
<div class="container">
    <h1 class="my-3">{{$title}}</h1>

    <p>A legnézetteb angolnyelvű film: <b>{{$showTitle}}</b></p>

</div>
@endsection