@extends('dashboard.layouts.app_dashboard')
@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Creating a user @endslot
            @slot('parent') Main @endslot
            @slot('level2') <a href="{{route('dashboard.user_management.user.index')}}">Users</a> @endslot
            @slot('active') New user @endslot
            @slot('separator') / @endslot
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
        <form action="{{route('dashboard.user_management.user.store')}}" method="post">
            @csrf
            {{-- Form include --}}
            @include('dashboard.user_management.users.partials.form')
        </form>
    </div>
@endsection
