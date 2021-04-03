@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="jumbotron">
                    <a href="{{route('sector')}}" class="btn btn-block btn-info">Sectors {{$count_sectors}}</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <a href="{{route('company')}}" class="btn btn-block btn-info">Companies {{$count_companies}}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                @foreach($sectors as $sector)
                    <div class="list-group-item">
                        <h4 class="list-group-item-action"><a href="{{route('sector', $sector)}}">{{$sector->title}}</a></h4>
                        <p class="list-group-item-action">{{$sector->companies()->pluck('title')->implode(', ')}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-6">
                @foreach($companies as $company)
                    <div class="list-group-item">
                        <h4 class="list-group-item-action"><a href="{{route('company', $company)}}">{{$company->title}}</a></h4>
                        <p class="list-group-item-action">{{$company->sectors()->pluck('title')->implode(', ')}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @component('dashboard.components.modal-currency')@endcomponent
@endsection
