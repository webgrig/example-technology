@foreach($sectors as $sector)
    <option value="{{$sector->id?$sector->id:""}}"
        @isset($company->id)
            @foreach($company->sectors as $sector_company)
                @if($sector->id == $sector_company->id)
                selected="selected"
                @endif
            @endforeach
        @endisset
    >
        @isset($delimiter) {!! $delimiter !!} @endisset @isset($sector->title) {{$sector->title}} @endisset
    </option>

    @if(count($sector->children))
        @include('dashboard.companies.partials.sectors', [
            'sectors' => $sector->children,
            'delimiter' => ' - ' . $delimiter,
        ])
    @endif
@endforeach
