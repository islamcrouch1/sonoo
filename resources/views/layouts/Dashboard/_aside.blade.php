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

        </div><a class="navbar-brand" href="{{ route('home') }}">
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
                            <div class="col-auto navbar-vertical-label">{{ __('Users & Roles') }}
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
                                        <span class="badge badge-soft-primary">{{ \app\models\User::all()->count() - 1 }}</span>
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

                        @if (auth()->user()->hasPermission('logs-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('logs*') ? 'active' : '' }}"
                                href="{{ route('logs.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-file"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Logs') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('bonus-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('bonus*') ? 'active' : '' }}"
                                href="{{ route('bonus.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-money-bill"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Bonus') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('messages-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('messages*') ? 'active' : '' }}"
                                href="{{ route('messages.admin.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-comments"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Messages') }}</span>
                                       
                                </div>
                            </a>
                        @endif

                        <a class="nav-link {{ Route::is('notifications*') ? 'active' : '' }}"
                            href="{{ route('notifications.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-bell"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Notification') }}</span>
                            </div>
                        </a>

                    </li>
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
                                        <span class="badge badge-soft-primary">{{ \App\Models\Product::all()->count()  }}</span>
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

                        @if (auth()->user()->hasPermission('stock_management-read'))
                            <!-- parent pages--><a
                                class="nav-link {{ Route::is('stock.management*') ? 'active' : '' }}"
                                href="{{ route('stock.management.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-layer-group"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Stock Management') }}</span>
                                </div>
                            </a>
                        @endif

                    </li>


                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- Orders -  -->
                            <div class="col-auto navbar-vertical-label">{{ __('Orders') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        @if (auth()->user()->hasPermission('orders-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('orders*') ? 'active' : '' }}"
                                href="{{ route('orders.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-receipt"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Orders') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('orders-read'))
                            <!-- parent pages--><a
                                class="nav-link {{ Route::is('orders-vendor*') ? 'active' : '' }}"
                                href="{{ route('orders-vendor') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-receipt"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Vendors Orders') }}</span>
                                </div>
                            </a>
                        @endif

                    </li>


                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- Orders -  -->
                            <div class="col-auto navbar-vertical-label">{{ __('Finance') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        @if (auth()->user()->hasPermission('withdrawals-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('withdrawals*') ? 'active' : '' }}"
                                href="{{ route('withdrawals.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-credit-card"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Withdrawals Requests') }}</span>
                                </div>
                            </a>
                        @endif

                        @if (auth()->user()->hasPermission('finances-read'))
                            <!-- parent pages--><a class="nav-link {{ Route::is('finances*') ? 'active' : '' }}"
                                href="{{ route('finances.index') }}" role="button" data-bs-toggle=""
                                aria-expanded="false">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-credit-card"></span></span><span
                                        class="nav-link-text ps-1">{{ __('Finances') }}</span>
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
                        <!-- parent pages-->
                        <a class="nav-link {{ Route::is('affiliate.products*') ? 'active' : '' }}"
                            href="{{ route('affiliate.products.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-box-open"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Products') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('mystore.show*') ? 'active' : '' }}"
                            href="{{ route('mystore.show') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-store"></span></span><span
                                    class="nav-link-text ps-1">{{ __('My Store') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('favorite*') ? 'active' : '' }}"
                            href="{{ route('favorite') }}" role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-heart"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Favorite') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('cart.*') ? 'active' : '' }}" href="{{ route('cart') }}"
                            role="button" data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-cart-plus"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Shopping Cart') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('shipping_rates.affiliate.*') ? 'active' : '' }}"
                            href="{{ route('shipping_rates.affiliate') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-truck"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Shipping Rates') }}</span>
                            </div>
                        </a>

                    </li>

                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">{{ __('Orders') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        <!-- parent pages-->
                        <a class="nav-link {{ Route::is('orders.affiliate*') ? 'active' : '' }}"
                            href="{{ route('orders.affiliate.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-receipt"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Orders') }}</span>
                            </div>
                        </a>



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
                        <!-- parent pages-->

                        <a class="nav-link {{ Route::is('withdrawals.user*') ? 'active' : '' }}"
                            href="{{ route('withdrawals.user.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-wallet"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Wallet') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('notifications*') ? 'active' : '' }}"
                            href="{{ route('notifications.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-bell"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Notification') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('messages*') ? 'active' : '' }}"
                            href="{{ route('messages.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-comments"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Messages') }}</span>
                            </div>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->hasRole('vendor'))
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
                        <!-- parent pages-->
                        <a class="nav-link {{ Route::is('vendor-products*') ? 'active' : '' }}"
                            href="{{ route('vendor-products.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-box-open"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Products') }}</span>
                            </div>
                        </a>

                    </li>

                    <li class="nav-item">
                        <!-- label-->
                        <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                            <!-- users - roles - countries - settings -->
                            <div class="col-auto navbar-vertical-label">{{ __('Orders') }}
                            </div>
                            <div class="col ps-0">
                                <hr class="mb-0 navbar-vertical-divider" />
                            </div>
                        </div>
                        <!-- parent pages-->
                        <a class="nav-link {{ Route::is('vendor.orders*') ? 'active' : '' }}"
                            href="{{ route('vendor.orders.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-receipt"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Orders') }}</span>
                            </div>
                        </a>



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
                        <!-- parent pages-->

                        <a class="nav-link {{ Route::is('withdrawals.user*') ? 'active' : '' }}"
                            href="{{ route('withdrawals.user.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-wallet"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Wallet') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('notifications*') ? 'active' : '' }}"
                            href="{{ route('notifications.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-bell"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Notification') }}</span>
                            </div>
                        </a>

                        <a class="nav-link {{ Route::is('messages*') ? 'active' : '' }}"
                            href="{{ route('messages.index') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        class="fas fa-comments"></span></span><span
                                    class="nav-link-text ps-1">{{ __('Messages') }}</span>
                            </div>
                        </a>
                    </li>
                @endif

            </ul>

        </div>
    </div>
</nav>
