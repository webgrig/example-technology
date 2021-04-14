@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Sector list @endslot
            @slot('parent') Main @endslot
            @slot('active') Sectors @endslot
            @slot('separator') / @endslot
        @endcomponent
        <hr>

        @if(isset($delete_access))
            @if(!$delete_access)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <ul>
                                <li>Operation canceled! To delete this sector, you first need to delete all elements included in it (companies and sectors).</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <a href="{{route('dashboard.sector.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create sector</a>
        <table class="table table-striped table-hover">
            <thead>
                <th class="w5pr">Title</th>
                <th class="w15pr">Parent sector</th>
                <th class="w30pr">Companies</th>
                <th class="w25pr">Users</th>
                <th class="w25pr text-right">Actions</th>
            </thead>
            <tbody>
                @forelse($sectors as $sector)
                    <tr>
                        <td>{{$sector->title}}</td>
                        <td>{{$sector->patentSectorTile()}}</td>
                        <td>{{$sector->companies()->pluck('title')->implode(' || ')}}</td>
                        <td>{{$sector->users()->pluck('name')->implode(' || ')}}</td>
                        <td class="text-right">
                            <form action="{{route('dashboard.sector.destroy', $sector)}}" method="post" id="{{'form-delete-' . $sector->id}}">
                                @method('delete')
                                @csrf
                                <a href="{{route('dashboard.sector.edit', $sector)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-primary btn-modal-confirm" data-form-id="{{'form-delete-' . $sector->id}}"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <h2>Data not available</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <td colspan="5">
                    <div class="pagination pull-right">
                        {{$sectors->links()}}
                    </div>
                </td>
            </tfoot>
        </table>
    </div>
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
