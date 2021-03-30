@extends('dashboard.layouts.app_admin')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Sector list @endslot
            @slot('parent') Main @endslot
            @slot('active') Sectors @endslot
        @endcomponent
        <hr>
        <a href="{{route('dashboard.sector.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create a sector</a>
        <table class="table table-striped">
            <thead>
                <th>Name</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @forelse($sectors as $sector)
                    <tr>
                        <td>{{$sector->title}}</td>
                        <td class="text-right">
                            <form action="{{route('dashboard.sector.destroy', $sector)}}" onsubmit="if(confirm('Delete?')){return true;}else{return false;}" method="post">
                                @method('delete')
                                @csrf
                                <a href="{{route('dashboard.sector.edit', $sector)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">
                            <h2>Data not available</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <td colspan="2">
                    <ul class="pagination pull-right">
                        {{$sectors->links()}}
                    </ul>
                </td>
            </tfoot>
        </table>
    </div>
@endsection
