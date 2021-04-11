@extends('dashboard.layouts.app_dashboard')
@section('content')
    <div class="container">
        @component('dashboard.components.breadcrumb')
            @slot('title') Creating a sector @endslot
            @slot('parent') Main @endslot
            @slot('level2') <a href="{{route('dashboard.sector.index')}}">Sectors</a> @endslot
            @slot('active') New sector @endslot
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
        <form action="{{route('dashboard.sector.store')}}" method="post">
            @csrf
            {{-- Form include --}}
            @include('dashboard.sectors.partials.form')
        </form>
    </div>
@endsection
