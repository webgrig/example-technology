@extends('admin.layouts.app_admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="jumbotron">
                    <p><span class="btn btn-block btn-info">Sectores 0</span></p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="jumbotron">
                    <p><span class="btn btn-block btn-info">Empresas 0</span></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <a href="#" class="btn btn-block btn-dark">Crear un sector</a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-action">Sector primero</h4>
                    <p class="list-group-item-action">Número de empresas</p>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="#" class="btn btn-block btn-dark">Agregar empresa</a>
                <a href="#" class="list-group-item">
                    <h4 class="list-group-item-action">La empresa primero</h4>
                    <p class="list-group-item-action">Sector</p>
                </a>
            </div>
        </div>
    </div>
@endsection
