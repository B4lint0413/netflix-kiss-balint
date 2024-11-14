@php
$menuItems = [
["route" => "home", "text" => "Főoldal"],
["route" => "toplist.toplist", "text" => "Összes"],
["route" => "toplist.categories", "text" => "Kategóriák"],
["route" => "toplist.films", "text" => "Filmek"],
["route" => "toplist.tvs", "text" => "Sorozatok"],
["route" => "toplist.popular", "text" => "Népszerű"],
]
@endphp
<nav class="navbar navbar-expand-md" data-bs-theme="dark" style="background-color:rgb(0 0 0)">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route("home")}}">Netflix Toplista</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach($menuItems as $menuItem)
                @if(Route::has($menuItem["route"]))
                <li class="nav-item">
                    <a 
                        class="nav-link {{Route::currentRouteName() == $menuItem["route"] ? "active": ""}}"
                        href="{{route($menuItem["route"])}}"
                    >
                        {{$menuItem["text"]}}
                    </a>
                </li>
                @endif
                @endforeach

            </ul>
        </div>
    </div>
</nav>
