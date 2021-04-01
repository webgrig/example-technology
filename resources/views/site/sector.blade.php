@extends('layouts.app')

@section('title', $title)
@section('content')
    <div class="container">
        <h2 class="text-center">{{$title}}</h2>
        @if($sector)
            @forelse($companies as $company)
                <div class="row">
                    <div class="col-sm-12">
                        <h2><a href="{{route('company', $company)}}">{{$company->title}}</a></h2>
                    </div>
                </div>
            @empty
                <h2 class="text-center">Empty</h2>
            @endforelse
            <div class="pagination pull-right">
                {{$companies->links()}}
            </div>
        @elseif($sectors)
            @forelse($sectors as $sector)
                <div class="row">
                    <div class="col-sm-12">
                        <h2><a href="{{route('sector', $sector)}}">{{$sector->title}}</a></h2>
                    </div>
                </div>
            @empty
                <h2 class="text-center">Empty</h2>
            @endforelse
            <div class="pagination pull-right">
                {{$sectors->links()}}
            </div>
        @endif
    </div>
@endsection
