@php
    use Illuminate\Support\Facades\Auth;

        $user = \auth()->user();;

@endphp
<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand border-bottom {{ $navClass ?? 'navbar-dark bg-primary' }}">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.index') }}">Client</a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="#">Invoices</a>--}}
{{--                </li>--}}
                @if($user->role_id == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Settings
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
{{--                        <a href="{{ route('profile.edit') }}" class="dropdown-item">{{ __('Profile') }}</a>--}}

                        <a href="{{ route('user.index') }}" class="dropdown-item">{{ __('User Management') }}</a>
                    </div>
                </li>
                @endif
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
