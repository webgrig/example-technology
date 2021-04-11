<h2>{{$title}}</h2>
@if(!Route::is('dashboard.index'))
    <ol  class="breadcrumb">
        @if(isset($parent))
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{$parent}}</a></li>
            <li class="inline">&nbsp;{{$separator}}&nbsp;</li>
        @endif
        @if(isset($level2))
            <li class="breadcrumb-item">{{$level2}}</li>
            <li class="inline">&nbsp;{{$separator}}&nbsp;</li>
        @endif
        @if(isset($level3))
            <li class="breadcrumb-item">{{$level3}}</li>
            <li class="inline">&nbsp;{{$separator}}&nbsp;</li>
        @endif
        @if(isset($level4))
            <li class="breadcrumb-item">{{$level4}}</li>
            <li class="inline">&nbsp;{{$separator}}&nbsp;</li>
        @endif
        @if(isset($level5))
            <li class="breadcrumb-item">{{$level5}}</li>
            <li class="inline">&nbsp;{{$separator}}&nbsp;</li>
        @endif
        @if(isset($active))
            <li class="breadcrumb-item active">{{$active}}</li>
        @endif
    </ol>
@endif
