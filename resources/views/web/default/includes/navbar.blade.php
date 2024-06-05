
<link rel="stylesheet" href="/assets/aaipi/css/web/default/cart.css">

@php
    if (empty($authUser) and auth()->check()) {
        $authUser = auth()->user();
    }

    $navBtnUrl = null;
    $navBtnText = null;

    if(request()->is('forums*')) {
        $navBtnUrl = '/forums/create-topic';
        $navBtnText = trans('update.create_new_topic');
    } else {
        $navbarButton = getNavbarButton(!empty($authUser) ? $authUser->role_id : null, empty($authUser));

        if (!empty($navbarButton)) {
            $navBtnUrl = $navbarButton->url;
            $navBtnText = $navbarButton->title;
        }
    }
@endphp

<div id="navbarVacuum"></div>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="{{ (!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'}}">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order d-flex align-items-center justify-content-center mr-0 p-0 {{ (empty($navBtnUrl) and empty($navBtnText)) ? 'ml-auto' : '' }}" href="https://aaipi.id">
                @if(!empty($generalSettings['logo']))
                    <img src="{{ $generalSettings['logo'] }}" class="img-cover site-logo" alt="site logo">
                @endif
            </a>

            <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mx-lg-30 d-none d-lg-flex navbar-toggle-content" id="navbarContent">
                <div class="navbar-toggle-header text-right d-lg-none">
                    <button class="btn-transparent" id="navbarClose">
                        <i data-feather="x" width="32" height="32"></i>
                    </button>
                </div>

                <ul class="navbar-nav mr-auto d-flex align-items-center">
                    @if(!empty($navbarPages) and count($navbarPages))
                        @foreach($navbarPages as $navbarPage)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ $navbarPage['link'] }}">{{ $navbarPage['title'] }}</a>
                            </li>
                        @endforeach
                    @endif

                    @auth
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <li class="nav-item d-flex d-lg-none">
                        <a href="{{ $navBtnUrl }}" class="nav-link">
                            {{ $navBtnText }}
                        </a>
                    </li>
                    <li class="nav-item d-flex d-lg-none">
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                            {{ trans('auth.logout') }}
                        </a>
                    </li>
                    @else
                    @if(!empty($navBtnUrl))
                        <li class="nav-item">
                            <a href="/register" class="d-flex d-lg-none nav-link">
                                {{ $navBtnText }}
                            </a>
                        </li>
                    @endif
                    @endauth
                </ul>
            </div>

            <div class="d-flex nav-icons-or-start-live navbar-order align-items-center">
                @auth
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="d-none d-lg-flex btn btn-sm btn-primary btn-color-login  rounded-pill ">
                    {{ trans('auth.logout') }}
                </a>
            @else
                <a href="/login" class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14 mx-5">
                    {{ trans('auth.login') }}
                </a>
                <a href="/login" class="d-none d-lg-flex btn btn-sm btn-primary btn-color-login nav-start-a-live-btn rounded-pill mx-5 px-3 py-3">
                    {{ trans('auth.login') }}
                </a>
            @endauth

                @if(auth()->check())
                    @if(auth()->user()->isTeacher() || auth()->user()->isOrganization() || auth()->user()->isUser())
                        @if(!empty($navBtnUrl))
                            <a href="{{ $navBtnUrl }}" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn rounded-pill mx-5 py-3">
                                {{ $navBtnText }}
                            </a>
                        @endif
                    @endif
                @else
                    @if(!empty($navBtnUrl))
                        <a href="{{ $navBtnUrl }}" class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn rounded-pill mx-5 py-3">
                            {{ $navBtnText }}
                        </a>
                    @endif
                @endif

                @if(!empty($authUser))
                <div class="group-cart mr-40">
                    <a href="/cart">
                        @php
                            $cartCount = $userCarts->count();
                            $displayCount = $cartCount > 99 ? '99+' : $cartCount;
                        @endphp
                        <div id="cart" class="cart" data-totalitems="{{ $displayCount }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</nav>


@push('scripts_bottom')
    <script src="/assets/default/js/parts/navbar.min.js"></script>

    <script>
        $(document).ready(function() {
            var currentPath = window.location.pathname + window.location.search;
           
            $('#navbarContent ul.navbar-nav li.nav-item').each(function() {
                var navLink = $(this).find('a.nav-link');
                var linkPath = navLink.attr('href');

                var hasQueryString = window.location.search !== '';
    
                if (currentPath === linkPath || (hasQueryString && linkPath.includes('classes') && linkPath.includes('resources'))) {
                    navLink.addClass('active');
                }
            });
        });
    </script>
    
@endpush