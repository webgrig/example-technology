@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Company list @endslot
            @slot('parent') Main @endslot
            @slot('active') Companies @endslot
        @endcomponent
        <hr>
        <a href="{{route('dashboard.company.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create company</a>
        <table class="table table-striped">
            <thead>
                <th class="text-center">Name</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Email</th>
                <th class="text-center">Sectors</th>
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td class="text-center">{{$company->title}}</td>
                        <td class="text-center">{{$company->phone}}</td>
                        <td class="text-center">{{$company->email}}</td>
                        <td class="text-center">{{$company->sectors()->pluck('title')->implode(', ')}}</td>
                        <td class="text-right">
                            <form action="{{route('dashboard.company.destroy', $company)}}" method="post" id="{{'form-delete-' . $company->id}}">
                                @method('delete')
                                @csrf
                                <a href="{{route('dashboard.company.edit', $company)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button type="button" class="btn btn-primary btn-modal-confirm" data-form-id="{{'form-delete-' . $company->id}}"><i class="fa fa-trash"></i></button>
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
                        {{$companies->links()}}
                    </div>
                </td>
            </tfoot>
        </table>
    </div>
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
