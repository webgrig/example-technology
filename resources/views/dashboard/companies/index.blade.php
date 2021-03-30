@extends('dashboard.layouts.app_admin')

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
                <th class="text-right">Action</th>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td class="text-center">{{$company->name}}</td>
                        <td class="text-center">{{$company->phone}}</td>
                        <td class="text-center">{{$company->email}}</td>
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
                        <td colspan="4" class="text-center">
                            <h2>Data not available</h2>
                        </td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <td colspan="4">
                    <ul class="pagination pull-right">
                        {{$companies->links()}}
                    </ul>
                </td>
            </tfoot>
        </table>
    </div>
{{-- modal confirm--}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="">
                    <button type="button" class="close pt-1 pr-2" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="w-100 text-center pt-3 pb-3" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-si">Yes</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection
