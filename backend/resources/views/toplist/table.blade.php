@extends("layouts.main")

@section("title",$title)

@section('content')
<div class="container">
    <h1 class="my-3">{{$title}}</h1>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Hét</th>
                <th>Kategória</th>
                <th>Heti sorrend</th>
                <th>Cím</th>
                <th>Heti nézettség (órákban)</th>
                <th>Hány hete toplistás</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $key => $item)
            <tr>
                <td>{{$item->week}}</td>
                <td>{{$item->category}}</td>
                <td>{{$item->weekly_rank}}</td>
                <td>{{$item->show_title}}</td>
                <td>{{number_format($item->weekly_hours_viewed,0,","," ")}}</td>
                <td>{{$item->cumulative_weeks_in_top_ten}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if(
    $items instanceof \Illuminate\Pagination\Paginator ||
    $items instanceof Illuminate\Pagination\LengthAwarePaginator
    )

    {{$items->links('vendor.pagination.bootstrap-5')}}
    @else
    <div class="alert alert-info">
        A lapozó megjelenítéséhez majd a <code>paginate(10)</code> metódust kell meghívni a QueryBuilder legvégén.
    </div>
    @endif
</div>
@endsection
