@foreach($sectors as $sector)
    @isset($user->id)
        @if($sector->isUsersChildren($user->id))
            <option value="{{$sector->id?$sector->id:""}}" selected="selected">@isset($delimiter) {!! $delimiter !!} @endisset @isset($sector->title) {{$sector->title}} @endisset
            </option>
        @else
            <option value="{{$sector->id?$sector->id:""}}">@isset($delimiter) {!! $delimiter !!} @endisset @isset($sector->title) {{$sector->title}} @endisset
            </option>
        @endif
    @else
        <option value="{{$sector->id?$sector->id:""}}">@isset($delimiter) {!! $delimiter !!} @endisset @isset($sector->title) {{$sector->title}} @endisset
        </option>
    @endisset

    @if(count($sector->children))
        @include('dashboard.companies.partials.sectors', [
            'sectors' => $sector->children,
            'delimiter' => ' - ' . $delimiter,
        ])
    @endif
@endforeach
