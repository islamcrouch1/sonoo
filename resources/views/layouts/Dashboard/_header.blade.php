<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false"
        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                class="toggle-line"></span></span></button>
    <a class="navbar-brand me-1 me-sm-3" href="{{ url('/') }}">
        <div class="d-flex align-items-center"><img class="me-2" src="{{ asset('assets/img/logo-blue.png') }}"
                alt="" width="150" />
        </div>
    </a>
    <ul class="navbar-nav align-items-center d-none d-lg-block">
        <li class="nav-item">
            <div class="search-box" data-list='{"valueNames":["title"]}'>
                <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                    <input class="form-control search-input fuzzy-search" type="search"
                        value="{{ request()->search }}" name="search" autofocus placeholder="Search..."
                        aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>

                </form>
                {{-- <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none"
                    data-bs-dismiss="search">
                    <div class="btn-close-falcon" aria-label="Close"></div>
                </div>
                <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                    <div class="scrollbar list py-3" style="max-height: 24rem;">
                        <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Recently Browsed
                        </h6><a class="dropdown-item fs--1 px-card py-1 hover-primary"
                            href="app/events/event-detail.html">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-circle me-2 text-300 fs--2"></span>

                                <div class="fw-normal title">Pages <span
                                        class="fas fa-chevron-right mx-1 text-500 fs--2"
                                        data-fa-transform="shrink-2"></span> Events</div>
                            </div>
                        </a>
                        <a class="dropdown-item fs--1 px-card py-1 hover-primary" href="app/e-commerce/customers.html">
                            <div class="d-flex align-items-center">
                                <span class="fas fa-circle me-2 text-300 fs--2"></span>

                                <div class="fw-normal title">E-commerce <span
                                        class="fas fa-chevron-right mx-1 text-500 fs--2"
                                        data-fa-transform="shrink-2"></span> Customers</div>
                            </div>
                        </a>

                        <hr class="bg-200 dark__bg-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Suggested Filter
                        </h6><a class="dropdown-item px-card py-1 fs-0" href="app/e-commerce/customers.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-soft-warning">customers:</span>
                                <div class="flex-1 fs--1 title">All customers list</div>
                            </div>
                        </a>
                        <a class="dropdown-item px-card py-1 fs-0" href="app/events/event-detail.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-soft-success">events:</span>
                                <div class="flex-1 fs--1 title">Latest events in current month</div>
                            </div>
                        </a>
                        <a class="dropdown-item px-card py-1 fs-0" href="app/e-commerce/product/product-grid.html">
                            <div class="d-flex align-items-center"><span
                                    class="badge fw-medium text-decoration-none me-2 badge-soft-info">products:</span>
                                <div class="flex-1 fs--1 title">Most popular products</div>
                            </div>
                        </a>

                        <hr class="bg-200 dark__bg-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Files</h6><a
                            class="dropdown-item px-card py-2" href="#!">
                            <div class="d-flex align-items-center">
                                <div class="file-thumbnail me-2"><img class="border h-100 w-100 fit-cover rounded-3"
                                        src="assets/img/products/3-thumb.png" alt="" /></div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">iPhone</h6>
                                    <p class="fs--2 mb-0 d-flex"><span class="fw-semi-bold">Antony</span><span
                                            class="fw-medium text-600 ms-2">27 Sep at 10:30 AM</span></p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-card py-2" href="#!">
                            <div class="d-flex align-items-center">
                                <div class="file-thumbnail me-2"><img class="img-fluid"
                                        src="assets/img/icons/zip.png" alt="" /></div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Falcon v1.8.2</h6>
                                    <p class="fs--2 mb-0 d-flex"><span class="fw-semi-bold">John</span><span
                                            class="fw-medium text-600 ms-2">30 Sep at 12:30 PM</span></p>
                                </div>
                            </div>
                        </a>

                        <hr class="bg-200 dark__bg-900" />
                        <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Members</h6><a
                            class="dropdown-item px-card py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l status-online me-2">
                                    <img class="rounded-circle" src="assets/img/team/1.jpg" alt="" />

                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Anna Karinina</h6>
                                    <p class="fs--2 mb-0 d-flex">Technext Limited</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-card py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="assets/img/team/2.jpg" alt="" />

                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Antony Hopkins</h6>
                                    <p class="fs--2 mb-0 d-flex">Brain Trust</p>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item px-card py-2" href="pages/user/profile.html">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-l me-2">
                                    <img class="rounded-circle" src="assets/img/team/3.jpg" alt="" />

                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-0 title">Emma Watson</h6>
                                    <p class="fs--2 mb-0 d-flex">Google</p>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="text-center mt-n3">
                        <p class="fallback fw-bold fs-1 d-none">No Result Found.</p>
                    </div>
                </div> --}}
            </div>
        </li>
    </ul>
    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2">
                <a style="text-decoration: none" href="{{ route('setlocale') }}">
                    <div
                        style="background-color:#d8e2ef; align-items: center; display: flex; justify-content: center; padding:5px ; border-radius:50% ; width:30px; height:30px">
                        <span data-bs-toggle="tooltip" data-bs-placement="left" title="Switch language"
                            style="color:#2c7be5 !important" class="material-icons text-secondary fs-2">language</span>
                    </div>
                </a>

            </div>
        </li>
        <li class="nav-item">
            <div class="theme-control-toggle fa-icon-wait px-2">
                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle" type="checkbox"
                    data-theme-control="theme" value="dark" />
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme"><span
                        class="fas fa-sun fs-0"></span></label>
                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                    data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme"><span
                        class="fas fa-moon fs-0"></span></label>
            </div>
        </li>
        <li class="nav-item d-none d-sm-block">
            <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill fa-icon-wait"
                href="app/e-commerce/shopping-cart.html"><span class="fas fa-shopping-cart" data-fa-transform="shrink-7"
                    style="font-size: 33px;"></span><span class="notification-indicator-number">5</span></a>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link notification-indicator notification-indicator-primary notification-indicator-fill px-0 fa-icon-wait"
                id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span class="fas fa-bell"
                    data-fa-transform="shrink-6" style="font-size: 33px;"></span><span
                    class="notification-indicator-number noty-count">{{ Auth::user()->notifications->where('status', 0)->count() }}</span></a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg noty-nav"
                aria-labelledby="navbarDropdownNotification" data-local="{{ app()->getLocale() }}"
                data-id="{{ Auth::id() }}">
                <div class="card card-notification shadow-none">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <h6 class="card-header-title mb-0">Notifications</h6>
                            </div>
                            <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal"
                                    href="{{ route('notifications.change.all') }}">Mark all as
                                    read</a></div>
                        </div>
                    </div>
                    <div class="scrollbar-overlay" style="max-height:19rem">
                        <div class="list-group list-group-flush fw-normal fs--1">
                            <div class="list-group-title border-bottom">NEW</div>
                            <div class="noty-list">
                                @foreach (Auth::user()->notifications()->where('status', 0)->orderBy('id', 'desc')->limit(50)->get()
    as $notification)
                                    <div class="list-group-item">
                                        <a class="notification notification-flush notification-unread noty"
                                            href="{{ $notification->url }}"
                                            data-url="{{ route('notifications.change', ['notification' => $notification->id]) }}">
                                            <div class="notification-avatar">
                                                <div class="avatar avatar-2xl me-3">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('assets/img/fevicon.png') }}" alt="" />

                                                </div>
                                            </div>
                                            <div class="notification-body">
                                                <p class="mb-1">
                                                    <strong>{{ app()->getLocale() == 'ar' ? $notification->title_ar : $notification->title_en }}</strong>
                                                    {{ app()->getLocale() == 'ar' ? $notification->body_ar : $notification->body_en }}
                                                </p>
                                                @php
                                                    $date = Carbon\Carbon::now();
                                                    $interval = $notification->created_at->diffForHumans($date);
                                                @endphp
                                                <span class="notification-time"><span class="me-2" role="img"
                                                        aria-label="Emoji">💬</span>{{ $interval }}</span>

                                            </div>
                                        </a>

                                    </div>
                                @endforeach
                            </div>

                            <div class="list-group-title border-bottom">EARLIER</div>
                            @foreach (Auth::user()->notifications()->where('status', 1)->orderBy('id', 'desc')->limit(50)->get()
    as $notification)
                                <div class="list-group-item">
                                    <a class="notification notification-flush noty" href="{{ $notification->url }}"
                                        data-url="{{ route('notifications.change', ['notification' => $notification->id]) }}">
                                        <div class="notification-avatar">
                                            <div class="avatar avatar-2xl me-3">
                                                <img class="rounded-circle"
                                                    src="{{ asset('assets/img/fevicon.png') }}" alt="" />

                                            </div>
                                        </div>
                                        <div class="notification-body">
                                            <p class="mb-1">
                                                <strong>{{ app()->getLocale() == 'ar' ? $notification->title_ar : $notification->title_en }}</strong>
                                                {{ app()->getLocale() == 'ar' ? $notification->body_ar : $notification->body_en }}
                                            </p>
                                            @php
                                                $date = Carbon\Carbon::now();
                                                $interval = $notification->created_at->diffForHumans($date);
                                            @endphp
                                            <span class="notification-time"><span class="me-2" role="img"
                                                    aria-label="Emoji">💬</span>{{ $interval }}</span>

                                        </div>
                                    </a>

                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="card-footer text-center border-top"><a class="card-link d-block"
                            href="{{ route('notifications.index') }}">View all</a></div>
                </div>
            </div>

        </li>


        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="{{ asset('storage/images/users/' . Auth::user()->profile) }}"
                        alt="" />

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="navbarDropdownUser">
                <div class="bg-white dark__bg-1000 rounded-2 py-2">

                    {{-- <div class="dropdown-divider"></div> --}}
                    <a class="dropdown-item" href="pages/user/profile.html">Profile &amp; account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" class="dropdown-item"
                            style="padding-left:1rem !important; padding-left:1rem !important" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                </div>
            </div>
        </li>
    </ul>
</nav>
