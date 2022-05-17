@extends('layouts.dashboard.app')

@section('adminContent')
    <div class="row g-3 mb-3">
        <div class="col-xxl-6 col-xl-12">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card bg-transparent-50 overflow-hidden">
                        <div class="card-header position-relative">
                            <div class="bg-holder d-none d-md-block bg-card z-index-1"
                                style="background-image:url(../assets/img/illustrations/ecommerce-bg.png);background-size:230px;background-position:right bottom;z-index:-1;">
                            </div>
                            <!--/.bg-holder-->

                            <div class="position-relative z-index-2">
                                <div>
                                    <h3 class="text-primary mb-1">Hi, {{ $user->name }}!</h3>
                                    <p>{{ __('Here’s what happening with your dashboard today') }} </p>
                                </div>
                                <div class="d-flex py-3">
                                    <div class="pe-3">
                                        <p class="text-600 fs--1 fw-medium">Today's visit </p>
                                        <h4 class="text-800 mb-0">14,209</h4>
                                    </div>
                                    <div class="ps-3">
                                        <p class="text-600 fs--1">Today’s total sales </p>
                                        <h4 class="text-800 mb-0">$21,349.29 </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="mb-0 list-unstyled">
                                <li class="alert mb-0 rounded-0 py-3 px-card alert-warning border-x-0 border-top-0">
                                    <div class="row flex-between-center">
                                        <div class="col">
                                            <div class="d-flex">
                                                <div class="fas fa-circle mt-1 fs--2"></div>
                                                <p class="fs--1 ps-2 mb-0"><strong>5 products</strong> didn’t publish to
                                                    your Facebook page</p>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"><a
                                                class="alert-link fs--1 fw-medium" href="#!">{{ __('View products') }}<i
                                                    class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                                    </div>
                                </li>
                                <li
                                    class="alert mb-0 rounded-0 py-3 px-card greetings-item border-top border-x-0 border-top-0">
                                    <div class="row flex-between-center">
                                        <div class="col">
                                            <div class="d-flex">
                                                <div class="fas fa-circle mt-1 fs--2 text-primary"></div>
                                                <p class="fs--1 ps-2 mb-0"><strong>7 orders</strong> have payments that need
                                                    to be captured</p>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"><a
                                                class="alert-link fs--1 fw-medium" href="#!">View payments<i
                                                    class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                                    </div>
                                </li>
                                <li class="alert mb-0 rounded-0 py-3 px-card greetings-item border-top  border-0">
                                    <div class="row flex-between-center">
                                        <div class="col">
                                            <div class="d-flex">
                                                <div class="fas fa-circle mt-1 fs--2 text-primary"></div>
                                                <p class="fs--1 ps-2 mb-0"><strong>50+ orders</strong> need to be fulfilled
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"><a
                                                class="alert-link fs--1 fw-medium" href="#!">View orders<i
                                                    class="fas fa-chevron-right ms-1 fs--2"></i></a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @if (Auth::user()->hasRole('affiliate'))
            <div class="col-xxl-6 col-xl-12">
                <div class="card py-3 mb-3">
                    <div class="card-body py-3">
                        <div class="row g-0">
                            <div class="col-6 col-md-4 border-200 border-bottom border-end pb-4">
                                <h6 class="pb-1 text-700">Orders </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">15,450 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">13,675 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-primary"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 border-200 border-md-200 border-bottom border-md-end pb-4 ps-3">
                                <h6 class="pb-1 text-700">Items sold </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">1,054 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">13,675 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-warning"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                            <div
                                class="col-6 col-md-4 border-200 border-bottom border-end border-md-end-0 pb-4 pt-4 pt-md-0 ps-md-3">
                                <h6 class="pb-1 text-700">Refunds </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">$145.65 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">13,675 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-success"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                            <div
                                class="col-6 col-md-4 border-200 border-md-200 border-bottom border-md-bottom-0 border-md-end pt-4 pb-md-0 ps-3 ps-md-0">
                                <h6 class="pb-1 text-700">Gross sale </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">$100.26 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">$109.65 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-danger"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 border-200 border-md-bottom-0 border-end pt-4 pb-md-0 ps-md-3">
                                <h6 class="pb-1 text-700">Shipping </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">$365.53 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">13,675 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-success"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                            <div class="col-6 col-md-4 pb-0 pt-4 ps-3">
                                <h6 class="pb-1 text-700">Processing </h6>
                                <p class="font-sans-serif lh-1 mb-1 fs-2">861 </p>
                                <div class="d-flex align-items-center">
                                    <h6 class="fs--1 text-500 mb-0">13,675 </h6>
                                    <h6 class="fs--2 ps-3 mb-0 text-info"><span class="me-1 fas fa-caret-up"></span>21.8%
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card h-md-100 ecommerce-card-min-width">
                            <div class="card-header pb-0">
                                <h6 class="mb-0 mt-2 d-flex align-items-center">Weekly Sales<span class="ms-1 text-400"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Calculated according to last week's sales"><span
                                            class="far fa-question-circle" data-fa-transform="shrink-1"></span></span>
                                </h6>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end">
                                <div class="row">
                                    <div class="col">
                                        <p class="font-sans-serif lh-1 mb-1 fs-2">$47K</p><span
                                            class="badge badge-soft-success rounded-pill fs--2">+3.5%</span>
                                    </div>
                                    <div class="col-auto ps-0">
                                        <div class="echart-bar-weekly-sales h-100 echart-bar-weekly-sales-smaller-width">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card product-share-doughnut-width">
                            <div class="card-header pb-0">
                                <h6 class="mb-0 mt-2 d-flex align-items-center">Product Share</h6>
                            </div>
                            <div class="card-body d-flex flex-column justify-content-end">
                                <div class="row align-items-end">
                                    <div class="col">
                                        <p class="font-sans-serif lh-1 mb-1 fs-2">34.6%</p><span
                                            class="badge badge-soft-success rounded-pill"><span
                                                class="fas fa-caret-up me-1"></span>3.5%</span>
                                    </div>
                                    <div class="col-auto ps-0">
                                        <canvas class="my-n5" id="marketShareDoughnut" width="112"
                                            height="112"></canvas>
                                        <p class="mb-0 text-center fs--2 mt-4 text-500">Target: <span
                                                class="text-800">55%</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-md-100 h-100">
                            <div class="card-body">
                                <div class="row h-100 justify-content-between g-0">
                                    <div class="col-5 col-sm-6 col-xxl pe-2">
                                        <h6 class="mt-1">Market Share</h6>
                                        <div class="fs--2 mt-3">
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                        class="dot bg-primary"></span><span
                                                        class="fw-semi-bold">Falcon</span></div>
                                                <div class="d-xxl-none">57%</div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                        class="dot bg-info"></span><span
                                                        class="fw-semi-bold">Sparrow</span></div>
                                                <div class="d-xxl-none">20%</div>
                                            </div>
                                            <div class="d-flex flex-between-center mb-1">
                                                <div class="d-flex align-items-center"><span
                                                        class="dot bg-warning"></span><span
                                                        class="fw-semi-bold">Phoenix</span></div>
                                                <div class="d-xxl-none">22%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto position-relative">
                                        <div class="echart-product-share"></div>
                                        <div class="position-absolute top-50 start-50 translate-middle text-dark fs-2">
                                            26M</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header pb-0">
                                <h6 class="mb-0 mt-2 d-flex align-items-center">Total Order</h6>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-end">
                                    <div class="col">
                                        <p class="font-sans-serif lh-1 mb-1 fs-2">58.4K</p>
                                        <div class="badge badge-soft-primary rounded-pill fs--2"><span
                                                class="fas fa-caret-up me-1"></span>13.6%</div>
                                    </div>
                                    <div class="col-auto ps-0">
                                        <div class="total-order-ecommerce"
                                            data-echarts='{"series":[{"type":"line","data":[110,100,250,210,530,480,320,325]}],"grid":{"bottom":"-10px"}}'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
