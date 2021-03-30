@extends('dashboard.layouts.app_admin')
@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Editing a company @endslot
            @slot('parent') Main @endslot
            @slot('active') Companies @endslot
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
        <form action="{{route('dashboard.company.update', $company)}}" method="post">
            @method('put')
            @csrf
            {{-- Form include --}}
            @include('dashboard.companies.partials.form')
        </form>
    </div>
@endsection
