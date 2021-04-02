@extends('dashboard.layouts.app_dashboard')
@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Editing a user @endslot
            @slot('parent') Main @endslot
            @slot('active') User @endslot
        @endcomponent
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <hr>
        @if(isset($edit_access))
            @if(!$edit_access)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-danger">
                            <ul>
                                <li>Operation canceled!</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <form action="{{route('dashboard.user_management.user.update', $user)}}" method="post">
            @method('put')
            @csrf
            {{-- Form include --}}
            @include('dashboard.user_management.users.partials.form')
        </form>
    </div>
@endsection
