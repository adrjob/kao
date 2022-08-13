@php
    use Illuminate\Support\Facades\Auth;

        $user = \auth()->user();;

@endphp
<style>
    .flag-vuv {
        max-width: 20%;
        box-shadow: 1px 2px #000000;

    }
</style>
<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand border-bottom {{ $navClass ?? 'navbar-dark bg-primary' }}" style="background-image: linear-gradient(to left top, #229f45, #5f8f0f, #827d00, #9c6600, #af4a00, #be4c06, #ce4e0e, #de4f16, #ee7800, #f8a100, #fbc900, #f6f208); !important">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->

            <ul class="navbar-nav mr-auto">
                <li class="nav-item"  style="margin-right: -40%">
                    <img class="flag-vuv" src="data:image/png;base64,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" alt="">
                </li>
                <style>
                    .mnav {
                        color: #ffffff !important;
                    }
                </style>
                <li class="nav-item">
                    <a class="nav-link mnav" href="{{ route('client.index') }}">New Clients</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mnav" href="{{ route('client.edit', 1) }}">Old Clients</a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Invoices</a>--}}
{{--                </li>--}}
{{--                @if($user->role_id == 1)--}}
{{--                <li class="nav-item dropdown">--}}
{{--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        Settings--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                        <a href="{{ route('profile.edit') }}" class="dropdown-item">{{ __('Profile') }}</a>--}}

{{--                        <a href="{{ route('user.index') }}" class="dropdown-item">{{ __('User Management') }}</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                @endif--}}
            </ul>
            <ul class="navbar-nav align-items-right ml-auto" id="logout">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                        </div>
{{--                        <a href="{{ route('profile.edit') }}" class="dropdown-item">--}}
{{--                            <i class="ni ni-single-02"></i>--}}
{{--                            <span>{{ __('My profile') }}</span>--}}
{{--                        </a>--}}

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" id="logout-btn" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
