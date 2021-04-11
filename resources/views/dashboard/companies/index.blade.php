@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Company list @endslot
            @slot('parent') Main @endslot
            @slot('active') Companies @endslot
            @slot('separator') / @endslot
        @endcomponent
        <hr>
        <a href="{{route('dashboard.company.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create company</a>
            <table class="table table-striped table-hover">
                <thead>
                    <th class="w5pr">Title</th>
                    <th class="w10pr">Phone</th>
                    <th class="w15pr">Email</th>
                    <th class="w30pr">Sectors</th>
                    <th class="w15pr">Users</th>
                    <th class="w25pr text-right">Action</th>
                </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{{$company->title}}</td>
                        <td>{{$company->phone}}</td>
                        <td>{{$company->email}}</td>
                        <td>{{$company->sectors->pluck('title')->implode(' || ')}}</td>
                        <td>{{$company->listUsersOfCompany()->pluck('name')->implode(' || ')}}</td>
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
                        <td colspan="6" class="text-center">
                            <h2>Data not available</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <td colspan="6">
                    <div class="pagination pull-right">
                        {{$companies->links()}}
                    </div>
                </td>
            </tfoot>
        </table>
    </div>
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
