@if(auth()->check() && !in_array(request()->route()->getName(), ['welcome', 'page.pricing', 'page.lock']))
    @include('layouts.navbars.navs.auth')
    <style>
        .page-item.active .page-link{
            background-color: #4cb04f !important;
            border: #4cb04f !important;
        }
    </style>
@endif

@if(!auth()->check() || in_array(request()->route()->getName(), ['welcome', 'page.pricing', 'page.lock']))
    @include('layouts.navbars.navs.guest')
@endif
