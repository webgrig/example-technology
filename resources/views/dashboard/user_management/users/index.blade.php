@extends('dashboard.layouts.app_dashboard')

@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') User list @endslot
            @slot('parent') Main @endslot
            @slot('active') Users @endslot
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
        <table class="table table-striped">
            <thead>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-right">Actions</th>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-center">
                        {{$user->name}}
                    </td>
                    <td class="text-center">{{$user->email}}</td>
                    <td class="text-center">
                        @foreach($allRoles as $role)
                            @if($user->hasAnyRole($role->name))
                                <p>{{$role->name}}</p>
                            @endif
                        @endforeach</td>
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
                    <td colspan="4" class="text-center">
                        <h2>Data not available</h2>
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <td colspan="4">
                <div class="pagination pull-right">
                    {{$users->links()}}
                </div>
            </td>
            </tfoot>
        </table>
    </div>
    @component('dashboard.components.modal-confirm')@endcomponent
@endsection
