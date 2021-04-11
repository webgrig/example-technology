@extends('dashboard.layouts.app_dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="jumbotron">
                    <a href="{{route('dashboard.sector.index')}}" class="btn btn-block btn-info">Sectors {{$count_sectors}}</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <a href="{{route('dashboard.company.index')}}" class="btn btn-block btn-info">Companies {{$count_companies}}</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{route('dashboard.sector.create')}}" class="btn btn-block btn-dark">Create a sector</a>
                @foreach($sectors as $sector)
                    <div class="list-group-item">
                        <a href="{{route('dashboard.sector.edit', $sector)}}">
                            <h4 class="list-group-item-action">{{$sector->title}}</h4>
                        </a>
                        <p class="list-group-item-action">{{$sector->companies()->pluck('title')->implode(' || ')}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-6">
                <a href="{{route('dashboard.company.create')}}" class="btn btn-block btn-dark">Create company</a>
                @foreach($companies as $company)
                    <div class="list-group-item">
                        <a href="{{route('dashboard.company.edit', $company)}}">
                            <h4 class="list-group-item-action">{{$company->title}}</h4>
                        </a>
                        <p class="list-group-item-action">{{$company->sectors()->pluck('title')->implode(' || ')}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
