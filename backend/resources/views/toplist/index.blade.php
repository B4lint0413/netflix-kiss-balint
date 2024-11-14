@extends("layouts.main")

@section("title",$title ?? "Cím nincs megadva!")

@section('content')
<div class="container">

    <div class="row">
        <div class="col-12">
            <h1 class="my-3">{{$title ?? "Cím nincs megadva!"}}</h1>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    Gyorsgombok
                </div>
                <div class="card-body">
                @if(Route::has("toplist.categories"))
                    <a href="{{route('toplist.categories')}}" class="btn btn-primary  mb-2">Kategóriák</a>
                @else
                    <div class="alert alert-danger">
                        A <code>toplist.categories</code> route nincs definiálva!
                    </div>
                @endif

                @if(Route::has("toplist.toplist"))
                    <a href="{{route('toplist.toplist')}}" class="btn btn-primary  mb-2">Toplista (összes)</a>
                @else
                    <div class="alert alert-danger">
                        A <code>toplist.toplist</code> route nincs definiálva!
                    </div>
                @endif

               

                </div>
            </div>
        </div>
      

        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    Egy hét alatt legtöbb órát nézték:
                </div>
                <div class="card-body">
                    <b>{{$mostWatchedTitle ?? "Nincs megadva!"}}</b>
                </div>
            </div>
        </div>

        @if(isset($lastWeek))
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    Legutóbbi hét adatai: {{$lastWeek}}
                </div>
                <div class="card-body">
                    @if(Route::has("toplist.week"))
                    <a href="{{route('toplist.week',['week' => $lastWeek])}}" class="btn btn-primary mb-2">Utolsó hét adatainak megtekintése</a>
                    @else
                      <div class="alert alert-danger">
                        A <code>toplist.week</code> route nincs definiálva!
                    </div>
                    @endif

                     @if(Route::has("toplist.top1"))
                    <a href="{{route('toplist.top1', ['week' => $lastWeek])}}" class="btn btn-primary mb-2">Legnézzettebb angol nyelvű film az utolsó héten</a>
                @else
                    <div class="alert alert-danger">
                        A <code>toplist.toplist</code> route nincs definiálva!
                    </div>
                @endif
                </div>
            </div>
        </div>
        @endif
    </div>


</div>
@endsection
