@foreach($sectors as $sectors_list)
    <option value="{{$sectors_list->id?$sectors_list->id:""}}"
        @if(old('parent_id')  == $sectors_list->id)
            selected=""
        @else
            @isset($sector->id)
                @if($sector->parent_id == $sectors_list->id)
                    selected=""
                @endif
                @if($sector->id == $sectors_list->id)
                    hidden=""
                @endif
            @endisset
        @endif
    >
        @isset($delimiter) {!! $delimiter !!} @endisset @isset($sectors_list->title) {{$sectors_list->title}} @endisset
    </option>

    @if(count($sectors_list->children))
        @include('dashboard.sectors.partials.sectors', [
            'sectors' => $sectors_list->children,
            'delimiter' => ' - ' . $delimiter,
        ])
    @endif
@endforeach
