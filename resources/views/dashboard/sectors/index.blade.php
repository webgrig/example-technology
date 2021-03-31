@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Sector list @endslot
            @slot('parent') Main @endslot
            @slot('active') Sectors @endslot
        @endcomponent
        <hr>

        @if(isset($delete_access))
            @if(!$delete_access)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <ul>
                                <li>To delete this sector, you must first change the parent sector for the companies and sectors included in it!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <a href="{{route('dashboard.sector.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create sector</a>
        <table class="table table-striped">
            <thead>
                <th>Title</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @forelse($sectors as $sector)
                    <tr>
                        <td>{{$sector->title}}</td>
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
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
