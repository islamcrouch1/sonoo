@extends('layouts.Dashboard.app')

@section('adminContent')

    <form id="bulk-form" method="POST" action="{{ route('orders.status.bulk') }}">
        @csrf

        <div class="card mb-3" id="customersTable"
            data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
            <div class="card-header">
                <div class="row flex-between-center">
                    <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                        <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">
                            {{ __('orders') }}
                        </h5>
                    </div>
                    <div class="col-8 col-sm-auto text-end ps-2">
                        <div class="d-none" id="table-customers-actions">
                            <div class="d-flex">
                                <select name="selected_status" class="form-select form-select-sm" aria-label="Bulk actions"
                                    required>
                                    <option value="">{{ __('Change status') }}</option>
                                    <option value="pending">
                                        {{ __('pending') }}</option>
                                    <option value="confirmed">
                                        {{ __('confirmed') }}</option>
                                    <option value="on the way">
                                        {{ __('on the way') }}</option>
                                    <option value="in the mandatory period">
                                        {{ __('in the mandatory period') }}</option>
                                    <option value="delivered">
                                        {{ __('delivered') }}</option>
                                    <option value="canceled">
                                        {{ __('canceled') }}</option>
                                    <option value="returned">
                                        {{ __('returned') }}</option>
                                    <option value="RTO">
                                        {{ __('RTO') }}</option>
                                </select>
                                <button class="btn btn-falcon-default btn-sm ms-2"
                                    type="submit">{{ __('Apply') }}</button>
                            </div>

                        </div>

                        <form action=""></form>

                        <div id="table-customers-replace-element">
                            <form style="display: inline-block" action="">

                                <div class="d-inline-block">
                                    {{-- <label class="form-label" for="from">{{ __('From') }}</label> --}}
                                    <input type="date" id="from" name="from" class="form-control form-select-sm"
                                        value="{{ request()->from }}">
                                </div>

                                <div class="d-inline-block">
                                    {{-- <label class="form-label" for="to">{{ __('To') }}</label> --}}
                                    <input type="date" id="to" name="to"
                                        class="form-control form-select-sm sonoo-search" value="{{ request()->to }}">
                                </div>

                                <div class="d-inline-block">
                                    <select name="status" class="form-select form-select-sm sonoo-search"
                                        id="autoSizingSelect">
                                        <option value="" selected>{{ __('All Status') }}</option>
                                        <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>
                                            {{ __('pending') }}</option>
                                        <option value="confirmed"
                                            {{ request()->status == 'confirmed' ? 'selected' : '' }}>
                                            {{ __('confirmed') }}</option>
                                        <option value="on the way"
                                            {{ request()->status == 'on the way' ? 'selected' : '' }}>
                                            {{ __('on the way') }}</option>
                                        <option value="in the mandatory period"
                                            {{ request()->status == 'in the mandatory period' ? 'selected' : '' }}>
                                            {{ __('in the mandatory period') }}</option>
                                        <option value="delivered"
                                            {{ request()->status == 'delivered' ? 'selected' : '' }}>
                                            {{ __('delivered') }}</option>
                                        <option value="canceled" {{ request()->status == 'canceled' ? 'selected' : '' }}>
                                            {{ __('canceled') }}</option>
                                        <option value="returned" {{ request()->status == 'returned' ? 'selected' : '' }}>
                                            {{ __('returned') }}</option>
                                        <option value="RTO" {{ request()->status == 'RTO' ? 'selected' : '' }}>
                                            {{ __('RTO') }}</option>
                                    </select>
                                </div>

                                <div class="d-inline-block">
                                    <select name="country_id" class="form-select form-select-sm sonoo-search"
                                        id="autoSizingSelect">
                                        <option value="" selected>{{ __('All Countries') }}</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ request()->country_id == $country->id ? 'selected' : '' }}>
                                                {{ app()->getLocale() == 'ar' ? $country->name_ar : $country->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                            </form>

                            <a href="{{ route('orders.mandatory') }}" class="btn btn-falcon-default btn-sm"
                                type="button"><span class="fas fa-receipt" data-fa-transform="shrink-3 down-2"></span><span
                                    class="d-none d-sm-inline-block ms-1">{{ __('Mandatory') }}</span></a>
                            <a href="{{ route('orders.refunds') }}" class="btn btn-falcon-default btn-sm"
                                type="button"><span class="fas fa-backward"
                                    data-fa-transform="shrink-3 down-2"></span><span
                                    class="d-none d-sm-inline-block ms-1">{{ __('Refunds Requsets') }}</span></a>
                            <a href="{{ route('orders.export', ['status' => request()->status, 'from' => request()->from, 'to' => request()->to]) }}"
                                class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt"
                                    data-fa-transform="shrink-3 down-2"></span><span
                                    class="d-none d-sm-inline-block ms-1">{{ __('Export') }}</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive scrollbar">
                    @if ($orders->count() > 0)
                        <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                            <thead class="bg-200 text-900">
                                <tr>
                                    <th>
                                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                            <input class="form-check-input" id="checkbox-bulk-customers-select"
                                                type="checkbox"
                                                data-bulk-select='{"body":"table-customers-body","actions":"table-customers-actions","replacedElement":"table-customers-replace-element"}' />
                                        </div>
                                    </th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="id">
                                        {{ __('Order ID') }}
                                    </th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">
                                        {{ __('Affiliate Name') }}</th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="status">
                                        {{ __('Status') }}</th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">
                                        {{ __('Total') }}
                                    </th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">
                                        {{ __('Affiliate Profit') }}
                                    </th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">
                                        {{ __('Sonoo Profit') }}</th>
                                    <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">
                                        {{ __('Shipping') }}</th>

                                    <th class="sort pe-1 align-middle white-space-nowrap" style="min-width: 100px;"
                                        data-sort="joined">{{ __('Created At') }}</th>
                                    <th class="align-middle no-sort"></th>
                                </tr>
                            </thead>
                            <tbody class="list" id="table-customers-body">
                                @foreach ($orders as $order)
                                    <tr class="btn-reveal-trigger">
                                        <td class="align-middle py-2" style="width: 28px;">
                                            <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                                <input name="selected_items[]" value="{{ $order->id }}"
                                                    class="form-check-input" type="checkbox" id="customer-0"
                                                    data-bulk-select-row="data-bulk-select-row" />
                                            </div>
                                        </td>
                                        <td class="name align-middle white-space-nowrap py-2">
                                            <div class="d-flex d-flex align-items-center">
                                                <div class="flex-1">
                                                    <h5 class="mb-0 fs--1">{{ $order->id }}</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="address align-middle white-space-nowrap py-2">
                                            <a href="{{ route('users.show', ['user' => $order->user_id]) }}">{{ $order->user_name }}
                                            </a>
                                        </td>
                                        <td class="phone align-middle white-space-nowrap py-2">
                                            {!! getOrderHistory($order->status) !!}

                                            @if ($order->refund != null && $order->status != 'returned')
                                                @if ($order->refund->status == 0)
                                                    <br><span
                                                        class="badge badge-soft-danger ">{{ __('There is a return request') }}</span>
                                                @elseif ($order->refund->status == 1)
                                                    <br><span
                                                        class="badge badge-soft-danger ">{{ __('Return request denied') }}</span>
                                                @endif
                                            @endif


                                            {{-- @if ($order->prefunds->count() != 0)
                                        @if ($order->status != 'returned' && $order->status != 'canceled')
                                            @foreach ($order->prefunds as $prefund)
                                                @if ($prefund->status == 0)
                                                    <br><span
                                                        class="badge badge-soft-danger ">{{ __('There is a partial refund request') }}</span>
                                                @elseif ($prefund->status == 1)
                                                    <br><span
                                                        class="badge badge-soft-danger ">{{ __('Partial refund request denied') }}</span>
                                                @elseif ($prefund->status == 2)
                                                    <br><span
                                                        class="badge badge-soft-danger ">{{ __('Partial refund request approved') }}
                                                        <br>
                                                        {{ __('Order ID : ') . $prefund->orderid }}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif --}}

                                        </td>
                                        <td class="address align-middle white-space-nowrap py-2">
                                            {{ $order->total_price . ' ' . $order->country->currency }}
                                        </td>
                                        <td class="address align-middle white-space-nowrap py-2">
                                            {{ $order->total_commission . ' ' . $order->country->currency }}
                                        </td>
                                        <td class="address align-middle white-space-nowrap py-2">
                                            {{ $order->total_profit . ' ' . $order->country->currency }}
                                        </td>
                                        <td class="address align-middle white-space-nowrap py-2">
                                            {{ $order->shipping . ' ' . $order->country->currency }}
                                        </td>
                                        <td class="joined align-middle py-2">{{ $order->created_at }} <br>
                                            {{ interval($order->created_at) }} </td>
                                        <td class="align-middle white-space-nowrap py-2 text-end">
                                            <div class="dropdown font-sans-serif position-static">
                                                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                    type="button" id="customer-dropdown-0" data-bs-toggle="dropdown"
                                                    data-boundary="window" aria-haspopup="true"
                                                    aria-expanded="false"><span
                                                        class="fas fa-ellipsis-h fs--1"></span></button>
                                                <div class="dropdown-menu dropdown-menu-end border py-0"
                                                    aria-labelledby="customer-dropdown-0">
                                                    <div class="bg-white py-2">

                                                        @if (auth()->user()->hasPermission('orders-update'))
                                                            <a class="dropdown-item"
                                                                href="{{ route('users.show', ['user' => $order->user_id]) }}">{{ __('Affiliate
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        Info') }}</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('orders.show', ['order' => $order->id]) }}">{{ __('Display
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        order') }}</a>
                                                            <a href="" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#status-modal-{{ $order->id }}">{{ __('Change Status') }}</a>
                                                            @if ($order->refund)
                                                                <a href="" class="dropdown-item"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#refund-modal-{{ $order->id }}">{{ __('reason for refund request') }}</a>
                                                            @endif
                                                            <a href="" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#track-modal-{{ $order->id }}">{{ __('Track order') }}</a>
                                                        @endif

                                                        @if (auth()->user()->hasPermission('orders_notes-read'))
                                                            <a href="" class="dropdown-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#notes-modal-{{ $order->id }}">{{ __('Order Notes') }}</a>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @if (auth()->user()->hasPermission('orders-update'))
                                        <!-- start change status modal for each order -->
                                        <div class="modal fade" id="status-modal-{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 500px">
                                                <div class="modal-content position-relative">
                                                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                        <button
                                                            class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form method="POST"
                                                        action="{{ route('orders.status', ['order' => $order->id]) }}">
                                                        @csrf
                                                        <div class="modal-body p-0">
                                                            <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                <h4 class="mb-1" id="modalExampleDemoLabel">
                                                                    {{ __('Change status - order ID') . ' - #' . $order->id }}
                                                                </h4>
                                                            </div>
                                                            <div class="p-4 pb-0">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="bonus">{{ __('Change order
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        status') }}</label>
                                                                    <select
                                                                        class="form-control @error('status') is-invalid @enderror"
                                                                        name="status" required>
                                                                        <option value="pending"
                                                                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                                            {{ __('pending') }}</option>
                                                                        <option value="confirmed"
                                                                            {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                                                                            {{ __('confirmed') }}</option>
                                                                        <option value="on the way"
                                                                            {{ $order->status == 'on the way' ? 'selected' : '' }}>
                                                                            {{ __('on the way') }}</option>
                                                                        <option value="in the mandatory period"
                                                                            {{ $order->status == 'in the mandatory period' ? 'selected' : '' }}>
                                                                            {{ __('in the mandatory period') }}</option>
                                                                        <option value="delivered"
                                                                            {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                                            {{ __('delivered') }}</option>
                                                                        <option value="canceled"
                                                                            {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                                                            {{ __('canceled') }}</option>
                                                                        <option value="returned"
                                                                            {{ $order->status == 'returned' ? 'selected' : '' }}>
                                                                            {{ __('returned') }}</option>
                                                                        <option value="RTO"
                                                                            {{ $order->status == 'RTO' ? 'selected' : '' }}>
                                                                            {{ __('RTO') }}</option>
                                                                    </select>
                                                                    @error('status')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            <button class="btn btn-primary"
                                                                type="submit">{{ __('Save') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end change status modal for each user -->
                                        <!-- start order track modal for each order -->
                                        <div class="modal fade" id="track-modal-{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 500px">
                                                <div class="modal-content position-relative">
                                                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                        <button
                                                            class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-0">
                                                        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                            <h4 class="mb-1" id="modalExampleDemoLabel">
                                                                {{ __('Track your order') . ' #' . $order->id }}
                                                            </h4>
                                                        </div>
                                                        <div class="m-2">
                                                            <div class="timeline-vertical">
                                                                <div class="timeline-item timeline-item-start">
                                                                    <div
                                                                        class="timeline-icon icon-item icon-item-lg text-primary border-300">
                                                                        <span class="fs-1 fas fa-check"></span>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6 timeline-item-time">
                                                                            <div>
                                                                                <p class="fs--1 mb-0 fw-semi-bold">
                                                                                    {{ $order->created_at }}</p>
                                                                                <p class="fs--2 text-600">
                                                                                    <span
                                                                                        class="badge badge-soft-light">{{ interval($order->created_at) }}</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="timeline-item-content">
                                                                                <div style="padding: 10px"
                                                                                    class="timeline-item-card">
                                                                                    <span
                                                                                        class="badge badge-soft-success ">{{ __('Order created') }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @foreach ($order->histories as $history)
                                                                    <div class="timeline-item timeline-item-start">
                                                                        <div
                                                                            class="timeline-icon icon-item icon-item-lg text-primary border-300">
                                                                            <span class="fs-1 fas fa-check"></span>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-6 timeline-item-time">
                                                                                <div>
                                                                                    <p class="fs--1 mb-0 fw-semi-bold">
                                                                                        {{ $history->created_at }}</p>
                                                                                    <p class="fs--2 text-600">
                                                                                        <span
                                                                                            class="badge badge-soft-light">{{ interval($history->created_at) }}</span>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="timeline-item-content">
                                                                                    <div style="padding: 10px"
                                                                                        class="timeline-item-card">
                                                                                        {!! getOrderHistory($history->status) !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end order track modal for each user -->
                                        @if ($order->refund)
                                            <!-- start order refund modal for each order -->
                                            <div class="modal fade" id="refund-modal-{{ $order->id }}"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document"
                                                    style="max-width: 500px">
                                                    <div class="modal-content position-relative">
                                                        <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                            <button
                                                                class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form method="POST"
                                                            action="{{ route('orders.refund.reject', ['order' => $order->id]) }}">
                                                            @csrf
                                                            <div class="modal-body p-0">
                                                                <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                    <h4 class="mb-1" id="modalExampleDemoLabel">
                                                                        {{ __('reason for refund request') . ' #' . $order->id }}
                                                                    </h4>
                                                                </div>
                                                                <div class="mb-2">

                                                                    <div class="d-flex mt-3">
                                                                        <div class="flex-1 ms-2 fs--1">
                                                                            <p class="mb-1 bg-200 rounded-3 p-2">
                                                                                {{ __('Reason for refund request: ') . $order->refund->reason }}
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                    @if ($order->refund->refuse_reason != null)
                                                                        <div class="d-flex mt-3">
                                                                            <div class="flex-1 ms-2 fs--1">
                                                                                <p class="mb-1 bg-200 rounded-3 p-2">
                                                                                    {{ __('Reason for refuse refund request: ') . $order->refund->refuse_reason }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    @endif


                                                                </div>
                                                                <div class="p-4 pb-0">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="reason">{{ __('Reason for rejection') }}</label>
                                                                        <input name="reason"
                                                                            class="form-control @error('reason') is-invalid @enderror"
                                                                            type="text" id="reason" required />
                                                                        @error('reason')
                                                                            <div class="alert alert-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary" type="button"
                                                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                                @if (auth()->user()->hasPermission('orders-update'))
                                                                    <button class="btn btn-primary"
                                                                        type="submit">{{ __('Reject the return request') }}</button>
                                                                @endif
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end order refund modal for each user -->
                                        @endif
                                    @endif


                                    @if (auth()->user()->hasPermission('orders_notes-read'))
                                        <!-- start order notes modal for each order -->
                                        <div class="modal fade" id="notes-modal-{{ $order->id }}" tabindex="-1"
                                            role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document"
                                                style="max-width: 500px">
                                                <div class="modal-content position-relative">
                                                    <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                                                        <button
                                                            class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST"
                                                        action="{{ route('orders.note', ['order' => $order->id]) }}">
                                                        @csrf
                                                        <div class="modal-body p-0">
                                                            <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                                                                <h4 class="mb-1" id="modalExampleDemoLabel">
                                                                    {{ __('Order Notes') . ' #' . $order->id }}
                                                                </h4>
                                                            </div>
                                                            <div class="mb-2">
                                                                @if ($order->order_notes->count() > 0)
                                                                    @foreach ($order->order_notes as $note)
                                                                        <div class="d-flex mt-3">
                                                                            <div class="avatar avatar-xl">
                                                                                <a
                                                                                    href="{{ route('users.show', ['user' => $note->user->id]) }}">
                                                                                    <img class="rounded-circle"
                                                                                        src="{{ asset('storage/images/users/' . $note->user->profile) }}"
                                                                                        alt="" />
                                                                                </a>
                                                                            </div>
                                                                            <div class="flex-1 ms-2 fs--1">
                                                                                <p class="mb-1 bg-200 rounded-3 p-2">
                                                                                    {{ $note->note }}
                                                                                </p>
                                                                                <div class="px-2">
                                                                                    {{ $note->created_at }}
                                                                                    <span class="badge badge-soft-info">
                                                                                        {{ interval($note->created_at) }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <p class="m-2">
                                                                        {{ __('There are currently no notes for this order') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                            <div class="p-4 pb-0">
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="note">{{ __('Note') }}</label>
                                                                    <input name="note"
                                                                        class="form-control @error('note') is-invalid @enderror"
                                                                        type="text" id="note" required />
                                                                    @error('note')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                            @if (auth()->user()->hasPermission('orders_notes-update'))
                                                                <button class="btn btn-primary"
                                                                    type="submit">{{ __('Save') }}</button>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end order notes modal for each user -->
                                    @endif
                                @endforeach
                            </tbody>

                        </table>
                    @else
                        <h3 class="p-4">{{ __('No orders To Show') }}</h3>
                    @endif
                </div>
            </div>


            <div class="card-footer d-flex align-items-center justify-content-center">
                {{ $orders->appends(request()->query())->links() }}
            </div>

        </div>
    </form>

@endsection
