<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true"
     data-img="{{url('/')}}/theme/app-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('index') }}">
                {{-- <img class="brand-logo" --}}
                                                                                                  {{-- alt="Boatek logo" src="{{ asset('public/theme/app-assets/images/logo/logo.png') }}" /> --}}
                    <h3 class="brand-text">Speak2Impact</h3>
                </a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
    </div>
    <div class="navigation-background"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item">
                <a href="{{ route('admin.index') }}"><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="">
                        Dashboard
                    </span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="{{ route('subscription.list') }}"><i class="la la-plus"></i>
                    <span class="menu-title" data-i18n="">
                        Subscriptions
                    </span>
                </a>
   <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a href="{{route('subscription.add')}}">
                            <span class="menu-title" data-i18n="">
                                Add New Plan
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('subscription.list')}}">
                            <span class="menu-title" data-i18n="">
                                All Plans
                            </span>
                        </a>
                    </li>

                </ul>
            </li>
            {{-- <li class=" nav-item"> --}}
            {{-- <a href="{{route('admin.boatTypes.index')}}"><i class="la la-bars"></i> --}}
            {{-- <span class="menu-title" data-i18n=""> --}}
            {{-- Boat Type --}}
            {{-- </span> --}}
            {{-- </a> --}}
            {{-- </li> --}}
            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="la la-bars"></i>
                    <span class="menu-title" data-i18n="">
                        Boat
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a href="{{ route('admin.boatTypes.index') }}">
                            <span class="menu-title" data-i18n="">
                                Boat Type
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.boatServices.index') }}">
                            <span class="menu-title" data-i18n="">
                                Boat Services
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.requiredDocuments.index') }}">
                            <span class="menu-title" data-i18n="">
                                Documents
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.boats.reports.index', ['type' => 'reported']) }}">
                            <span class="menu-title" data-i18n="">
                                Reported
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.boats.reports.index', ['type' => 'blocked']) }}">
                            <span class="menu-title" data-i18n="">
                                Blocked
                            </span>
                        </a>
                    </li>

                </ul>
            </li> --}}



            <li class=" nav-item">
                <a href="#">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">
                        Studends
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{ route('students.index') }}">All</a>
                    </li>
                    {{-- <li>
                        <a class="menu-item"
                           href="{{ route('customers.index', ['type' => 'active']) }}">Active</a>
                    </li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('customers.index', ['type' => 'blocked']) }}">Blocked</a>
                    </li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('customers.index', ['type' => 'deleted']) }}">Deleted</a>
                    </li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('customers.index', ['type' => 'not_verified']) }}">Not Verified</a>
                    </li> --}}

                </ul>
            </li>
            </li>
            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="ft-share-2"></i>
                    <span class="menu-title" data-i18n="">
                        Posts
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('admin.posts.index', ['type' => 'reported']) }}">Reported</a>
                    </li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('admin.posts.index', ['type' => 'blocked']) }}">Blocked</a>
                    </li>

                </ul>
            </li> --}}
            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="ft-share-2"></i>
                    <span class="menu-title" data-i18n="">
                        Stories
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('admin.stories.index', ['type' => 'reported']) }}">Reported</a>
                    </li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('admin.stories.index', ['type' => 'blocked']) }}">Blocked</a>
                    </li>

                </ul>
            </li> --}}
            </li>
            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="la la-dollar"></i>
                    <span class="menu-title" data-i18n="">
                        Revenue
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item"
                           href="{{ route('admin.revenues.earning', ['type' => 'blocked']) }}">Earning</a>
                    </li>
                </ul>
            </li> --}}
            </li>
            {{-- <li class=" nav-item">
                <a href="#">
                    <i class="ft-flag"></i>
                    <span class="menu-title" data-i18n="">
                        Countries
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{ route('admin.countryListing') }}">List of Countries</a>
                    </li>
                </ul>
            </li> --}}
            <li class=" nav-item">
                <a href="#">
                    <i class="ft-settings"></i>
                    <span class="menu-title" data-i18n="">
                        Settings
                    </span>
                </a>
                <ul class="menu-content">
                    {{-- <li class="navigation-divider"></li>
                    <li>
                        <a class="menu-item" href="{{ route('admin.messageCodes') }}">Message Codes</a>
                    </li>
                    <li>
                        <a class="menu-item" href="{{ route('admin.settings.index') }}">System Settings</a>
                    </li> --}}

                </ul>
            </li>
            </li>

        </ul>
    </div>
</div>
