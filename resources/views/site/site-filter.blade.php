@extends('layouts.app')

@section('title', $title)
@section('content')
    <div class="container">
        <h2 class="text-center">{{$title}}</h2>
        @forelse($resources as $company)
            <div class="row">
                <div class="col-sm-12">
                    <h2><a href="{{route('company', $company)}}">{{$company->title}}</a></h2>
                </div>
            </div>
        @endforeach
    </div>
@endsection
