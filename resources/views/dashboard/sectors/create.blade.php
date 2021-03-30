@extends('dashboard.layouts.app_admin')
@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Creating a sector @endslot
            @slot('parent') Main @endslot
            @slot('active') Sectors @endslot
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
        <form action="{{route('dashboard.sector.store')}}" method="post">
            @csrf
            {{-- Form include --}}
            @include('dashboard.sectors.partials.form')
        </form>
    </div>
@endsection
