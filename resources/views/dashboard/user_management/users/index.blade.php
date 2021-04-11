@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') User list @endslot
            @slot('parent') Main @endslot
            @slot('active') Users @endslot
            @slot('separator') / @endslot
        @endcomponent
        <hr>
        @if(isset($delete_access))
            @if(!$delete_access)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <ul>
                                <li>Unable to delete superuser!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <a href="{{route('dashboard.user_management.user.create')}}" class="btn btn-primary pull-right mb-3"><i
                class="fa fa-plus-square-o"></i> Create user</a>
        <table class="table table-striped table-hover">
            <thead>
                <th class="w5pr">Name</th>
                <th class="w15pr">Email</th>
                <th class="w5pr">Role</th>
                <th class="w50pr">Sectors</th>
                <th class="w25pr text-right">Action</th>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-center">
                        {{$user->name}}
                    </td>
                    <td>{{$user->email}}</td>
                    <td>
                        @foreach($allRoles as $role)
                            @if($user->hasAnyRole($role->name))
                                <p>{{$role->name}}</p>
                            @endif
                        @endforeach</td>
                    <td>{{$user->sectors()->pluck('title')->implode(' || ')}}</td>
                    <td class="text-right">
                        <form action="{{route('dashboard.user_management.user.destroy', $user)}}" method="post" id="{{'form-delete-' . $user->id}}">
                            @method('delete')
                            @csrf
                            <a href="{{route('dashboard.user_management.user.edit', $user)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-primary btn-modal-confirm" data-form-id="{{'form-delete-' . $user->id}}"><i class="fa fa-trash"></i></button>
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
                    {{$users->links()}}
                </div>
            </td>
            </tfoot>
        </table>
    </div>
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
