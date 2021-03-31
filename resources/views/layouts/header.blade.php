<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @include('layouts.top_menu', ['sectors' => $sectors])
                @if($companies_without_category->count())
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle">{{'Companies without category'}}</a>
                        <ul class="dropdown-menu submenu">
                            @foreach($companies_without_category as $company_item)
                                <li class="nav-item">
                                    <a href="{{url("/company/$company_item->id")}}" class="dropdown-item">{{$company_item->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            </ul>
            <script>
                window.onload = function () {
                    $(function () {
                        $(document).on('click', 'body', function (e) {
                            $('.dropdown .submenu').hide();
                            e.stopPropagation();
                        });

                        // make it as accordion for smaller screens
                        $('.dropdown a').mouseover(function (e) {
                            e.preventDefault();
                            if ($(this).next('.submenu').length) {
                                $(this).next('.submenu').slideToggle(100);
                            }
                        });
                    });
                };
            </script>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">{{ __('Dashboard') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>
