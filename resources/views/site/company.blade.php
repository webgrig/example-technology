@extends('layouts.app')

@php
    $title = !empty($company)? $company->name : '';
@endphp
@section('title', $title)

@section('content')
    <div class="container">
    @if($company)
        <div class="row">
            <div class="col-sm-12">
                <h1><a href="{{route('company'), $company->id}}">{{$company->name}}</a></h1>
                <p>{{$company->phone}}</p>
                <p>{{$company->email}}</p>
            </div>
        </div>
    @else
        <h2 class="text-center">Empty</h2>
    @endif
    </div>
@endsection
