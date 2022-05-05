<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>

        </div><a class="navbar-brand" href="{{ url('/') }}">
            <div class="d-flex align-items-center py-3"><img class="me-2"
                    src="{{ asset('assets/img/logo-blue.png') }}" alt="" width="150" />
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">

                @if (Auth::user()->hasRole('administrator|superadministrator'))
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">Users & Roles
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        @if (auth()->user()->hasPermission('users-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('users*') ? 'active' : '' }}"
                                href="{{ route('users.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-user"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Users') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('roles-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('roles*') ? 'active' : '' }}"
                                href="{{ route('roles.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-user-tag"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Roles') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('countries-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('countries*') ? 'active' : '' }}"
                                href="{{ route('countries.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-globe"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Countries') }}</span>
                                </div>
                            </a>
                        @endif

                    </li>

                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">{{ __('Settings') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        @if (auth()->user()->hasPermission('settings-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('settings*') ? 'active' : '' }}"
                                href="{{ route('settings.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-cogs"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Settings') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('slides-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('slides*') ? 'active' : '' }}"
                                href="{{ route('slides.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-images"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Slides') }}</span>
                                </div>
                            </a>
                        @endif

                    </li>
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">Products
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        @if (auth()->user()->hasPermission('categories-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('categories*') ? 'active' : '' }}"
                                href="{{ route('categories.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-sitemap"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Categories') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('products-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('products*') ? 'active' : '' }}"
                                href="{{ route('products.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-box-open"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Products') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('colors-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('colors*') ? 'active' : '' }}"
                                href="{{ route('colors.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-paint-brush"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Colors') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('sizes-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('sizes*') ? 'active' : '' }}"
                                href="{{ route('sizes.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-th"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Sizes') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('shipping_rates-read'))
                            <!-- parent pages--><a
                                class="nav-link {{ Route::is('shipping_rates*') ? 'active' : '' }}"
                                href="{{ route('shipping_rates.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-truck"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Shipping Rates') }}</span>
                                </div>
                            </a>
                        @endif

                    </li>
                @endif

                @if (Auth::user()->hasRole('affiliate'))
                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">{{ __('Products') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        <!-- parent pages--><a
                            class="nav-link {{ Route::is('affiliate.products*') ? 'active' : '' }}"
                            href="{{ route('affiliate.products.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-box-open"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Products') }}</span>
                            </div>
                        </a>

                    </li>
                @endif

                @if (Auth::user()->hasRole('vendor'))
                @endif

            </ul>

        </div>
    </div>
</nav>
