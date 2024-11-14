@extends("layouts.main")

@section("title",$title)

@section('content')
<div class="container">
    <div class="row my-2" style="align-items:end">
        <div class="col-lg-5">
            <h1 class="my-1">{{$title}}</h1>
        </div>
        <div class="col-lg-7">
            <a href="{{route("toplist.week",["week" => "$week","order_by" => "category"])}}" class="btn btn-primary mb-1">Kategória szerint növekvő</a>
            <a href="{{route("toplist.week",["week" => "$week","order_by" => "weekly_rank"])}}" class="btn btn-primary mb-1">Heti eredmény szerint növekvő</a>
            <a href="{{route("toplist.week",["week" => "$week","order_by" => "weekly_hours_viewed"])}}" class="btn btn-primary mb-1">Heti óraszám szerint csökkenő</a>
        </div>
    </div>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Kategória</th>
                <th>Heti eredmény</th>
                <th>Cím</th>
                <th>Heti nézettség (órákban)</th>
                <th>Hány hete toplistás</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key => $item)
            <tr>
                <td>{{$item->category}}</td>
                <td>{{$item->weekly_rank}}</td>
                <td>{{$item->show_title}}</td>
                <td>{{number_format($item->weekly_hours_viewed,0,","," ")}}</td>
                <td>{{$item->cumulative_weeks_in_top_ten}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
