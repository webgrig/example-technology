@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        @component('admin.components.breadcrumb')
            @slot('title') Lista de sectores @endslot
            @slot('parent') La principal @endslot
            @slot('active') Los sectores @endslot
        @endcomponent
        <hr>
        <a href="{{route('dashboard.sector.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Crearte un sector</a>
        <table class="table table-striped">
            <thead>
                <th>Nombre</th>
                <th class="text-right">Actuar</th>
            </thead>
            <tbody>
                @forelse($sectores as $sector)
                    <tr>
                        <td>{{$sector->title}}</td>
                        <td>
                            <a href="{{route('dashboard.sector.edit', ['id'=>$sector->id])}}"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">
                            <h2>Datos no disponibles</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <td colspan="2">
                    <ul class="pagination pull-right">
                        {{$sectores->links()}}
                    </ul>
                </td>
            </tfoot>
        </table>
    </div>
@endsection
