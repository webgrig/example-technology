@extends('dashboard.layouts.app_admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="jumbotron">
                    <p><span class="btn btn-block btn-info">Sectors 0</span></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <p><span class="btn btn-block btn-info">Companies 0</span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{route('dashboard.sector.create')}}" class="btn btn-block btn-dark">Create a sector</a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-action">Sector first</h4>
                    <p class="list-group-item-action">Number of companies</p>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{route('dashboard.company.create')}}" class="btn btn-block btn-dark">Add company</a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-action">Company first</h4>
                    <p class="list-group-item-action">Sector</p>
                </a>
            </div>
        </div>
    </div>
@endsection
