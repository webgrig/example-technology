@foreach($sectors as $sector)
    @if($sector->companies()->count())
        @php
            $next_iteration = false;
            $next_children = $sector->children->first();
            if($next_children){
                if($next_children->companies()->count()){
                    $next_iteration = true;
                }
            }
        @endphp
        <li class="nav-item dropdown">
            <a href="{{url("/sector/$sector->id")}}" class="nav-link @if($next_iteration) dropdown-toggle @endif">{{$sector->title}}</a>
{{--            @dd($sector->children->first()->companies()->count())--}}
            @if($next_iteration)
                <ul class="dropdown-menu submenu" role="menu">
                    @include('layouts.top_menu', ['sectors' => $sector->children])
                </ul>
            @endif
        </li>
    @endif
@endforeach
