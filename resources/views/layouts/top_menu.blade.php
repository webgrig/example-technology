@foreach($sectors as $sector)
    @if($sector->children()->count())
        <li class="nav-item dropdown">
            <a href="{{url("/sector/$sector->id")}}" class="nav-link dropdown-toggle">{{$sector->title}}</a>
            <ul class="dropdown-menu submenu" role="menu">
                @include('layouts.top_menu', ['sectors' => $sector->children])
            </ul>
    @else
        <li class="nav-item">
            <a href="{{url("/sector/$sector->id")}}" class="@if($sector->parent_id){{'dropdown-item'}}@else{{'nav-link'}}@endif">{{$sector->title}}</a>
    @endif
    </li>
@endforeach
