<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner scroll-scrollx_visible">
        <div class="sidenav-header d-flex align-items-center">
{{--            <a class="navbar-brand" href="{{ route('home') }}">--}}
{{--                <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">--}}
{{--            </a>--}}
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item {{ $elementName == 'client' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('client.index','index') }}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="nav-link-text">{{ __('Client') }}</span>
                        </a>
                    </li>
                    <li class="nav-item {{ $elementName == 'widgets' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('page.index','widgets') }}">
                            <i class="fa fa-sticky-note" aria-hidden="true"></i>
                            <span class="nav-link-text">{{ __('Invoices') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-examples" data-toggle="collapse" role="button" aria-controls="navbar-examples">
                            <i class="fa fa-cogs" aria-hidden="true"></i>

                            <span class="nav-link-text">{{ __('Settings') }}</span>
                        </a>
                        <div class="collapse" id="navbar-examples">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item {{ $elementName == 'profile' ? 'active' : '' }}">
                                    <a href="{{ route('profile.edit') }}" class="nav-link">{{ __('Profile') }}</a>
                                </li>

                                @can('manage-users', App\Models\User::class)
                                    <li class="nav-item {{ $elementName == 'user-management' ? 'active' : '' }}">
                                        <a href="{{ route('user.index') }}" class="nav-link">{{ __('User Management') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>
