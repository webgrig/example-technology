@extends('layouts.app')
@php
    $title = !empty($sector)? $sector->title : '';
    $links = !empty($companies)? $companies->links() : '';
@endphp
@section('title', $title)

@section('content')
    <div class="container">
        @forelse($companies as $company)
            <div class="row">
                <div class="col-sm-12">
                    <h2><a href="{{route('company', $company)}}">{{$company->name}}</a></h2>
                </div>
            </div>
        @empty
            <h2 class="text-center">Empty</h2>
        @endforelse
        {{$links}}
    </div>
@endsection
