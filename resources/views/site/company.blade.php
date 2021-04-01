@extends('layouts.app')

@section('title', $title)
@section('content')
    <div class="container">
        <h2 class="text-center">{{$title}}</h2>
        @if($company)
            <div class="row">
                <div class="col-sm-12">
                    <p>{{$company->phone}}</p>
                    <p>{{$company->email}}</p>
                </div>
            </div>
        @elseif($companies)
            @foreach($companies as $companiy)
                <div class="row">
                    <div class="col-sm-12">
                        <h2><a href="{{route('company', $companiy)}}">{{$companiy->title}}</a></h2>
                    </div>
                </div>
            @endforeach
            <div class="pagination pull-right">
                {{$companies->links()}}
            </div>
        @else
            <h2 class="text-center">Empty</h2>
        @endif
    </div>
@endsection
