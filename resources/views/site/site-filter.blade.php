@extends('layouts.app')

@section('title', $title)
@section('content')
    <div class="container">
        <h2 class="text-center">{{$title}}</h2>
        @foreach($resourcesCompanies as $company)
            @php $filterStrings = $company->getFilterStrings() @endphp
            <div class="row">
                <div class="col-sm-12">
                    @foreach($filterStrings as $key => $val)
                        @if($key == $company->filterableFields[0])
                            <h2><a href="{{route('company', $company)}}">{!!$val!!}</a></h2>
                        @else
                            <p>{!!$key.': ' . $val!!}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
        @foreach($resourcesSectors as $sector)
            @php $filterStrings = $sector->getFilterStrings() @endphp
            <div class="row">
                <div class="col-sm-12">
                    @foreach($filterStrings as $key => $val)
                        @if($key == $sector->filterableFields[0])
                            <h2><a href="{{route('sector', $sector)}}">{!!$val!!}</a></h2>
                        @else
                            <p>{!!$key.': ' . $val!!}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
