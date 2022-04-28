@extends('layouts.dashboard.app')

@section('adminContent')
    <div class="card mb-3" id="customersTable"
        data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">
                        @if ($users->count() > 0 && $users[0]->trashed())
                            {{ __('Users trash') }}
                        @else
                            {{ __('Users') }}
                        @endif
                    </h5>
                </div>
                <div class="col-8 col-sm-auto text-end ps-2">
                    <div class="d-none" id="table-customers-actions">
                        <div class="d-flex">
                            <select class="form-select form-select-sm" aria-label="Bulk actions">
                                <option selected="">Bulk actions</option>
                                <option value="Refund">Refund</option>
                                <option value="Delete">Delete</option>
                                <option value="Archive">Archive</option>
                            </select>
                            <button class="btn btn-falcon-default btn-sm ms-2" type="button">Apply</button>
                        </div>
                    </div>
                    <div id="table-customers-replace-element">
                        <form style="display: inline-block" action="">

                            <div class="d-inline-block">
                                <select name="role_id" class="form-select form-select-sm" id="autoSizingSelect">
                                    <option value="" selected>{{ __('All Roles') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ request()->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-inline-block">
                                <select name="status" class="form-select form-select-sm" id="autoSizingSelect">
                                    <option value="" selected>{{ __('All Status') }}</option>
                                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}>
                                        {{ __('avtive') }}</option>
                                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : '' }}>
                                        {{ __('inactive') }}</option>
                                    <option value="blocked" {{ request()->status == 'blocked' ? 'selected' : '' }}>
                                        {{ __('blocked') }}</option>
                                </select>
                            </div>

                            <div class="d-inline-block">
                                <select name="country_id" class="form-select form-select-sm" id="autoSizingSelect">
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
                        @if (auth()->user()->hasPermission('users-create'))
                            <a href="{{ route('users.create') }}" class="btn btn-falcon-default btn-sm"
                                type="button"><span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span><span
                                    class="d-none d-sm-inline-block ms-1">New</span></a>
                        @endif
                        <a href="{{ route('users.trashed') }}" class="btn btn-falcon-default btn-sm" type="button"><span
                                class="fas fa-trash" data-fa-transform="shrink-3 down-2"></span><span
                                class="d-none d-sm-inline-block ms-1">Trash</span></a>
                        <button class="btn btn-falcon-default btn-sm mx-2" type="button"><span class="fas fa-filter"
                                data-fa-transform="shrink-3 down-2"></span><span
                                class="d-none d-sm-inline-block ms-1">Filter</span></button>
                        <button class="btn btn-falcon-default btn-sm" type="button"><span class="fas fa-external-link-alt"
                                data-fa-transform="shrink-3 down-2"></span><span
                                class="d-none d-sm-inline-block ms-1">Export</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive scrollbar">
                @if ($users->count() > 0)
                    <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                        <thead class="bg-200 text-900">
                            <tr>
                                <th>
                                    <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                        <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox"
                                            data-bulk-select='{"body":"table-customers-body","actions":"table-customers-actions","replacedElement":"table-customers-replace-element"}' />
                                    </div>
                                </th>
                                <th class="sort pe-1 align-middle white-space-nowrap" data-sort="name">Name</th>
                                <th class="sort pe-1 align-middle white-space-nowrap" data-sort="phone">Phone</th>
                                <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">User Type</th>
                                <th class="sort pe-1 align-middle white-space-nowrap" data-sort="email">Status</th>
                                <th class="sort pe-1 align-middle white-space-nowrap" style="min-width: 100px;"
                                    data-sort="joined">Joined</th>
                                @if ($users->count() > 0 && $users[0]->trashed())
                                    <th class="sort pe-1 align-middle white-space-nowrap" style="min-width: 100px;"
                                        data-sort="joined">Deleted at</th>
                                @endif
                                <th class="align-middle no-sort"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-customers-body">
                            @foreach ($users as $user)
                                <tr class="btn-reveal-trigger">
                                    <td class="align-middle py-2" style="width: 28px;">
                                        <div class="form-check fs-0 mb-0 d-flex align-items-center">
                                            <input class="form-check-input" type="checkbox" id="customer-0"
                                                data-bulk-select-row="data-bulk-select-row" />
                                        </div>
                                    </td>
                                    <td class="name align-middle white-space-nowrap py-2"><a
                                            href="{{ route('users.show', ['user' => $user->id]) }}">
                                            <div class="d-flex d-flex align-items-center">
                                                <div class="avatar avatar-xl me-2">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/images/users/' . $user->profile) }}"
                                                        alt="" />
                                                </div>
                                                <div class="flex-1">
                                                    <h5 class="mb-0 fs--1">{{ $user->name }}</h5>
                                                </div>
                                            </div>
                                        </a></td>
                                    <td class="phone align-middle white-space-nowrap py-2"><a
                                            href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                    <td class="address align-middle white-space-nowrap py-2">
                                        @foreach ($user->roles as $role)
                                            <div style="display: inline-block">
                                                <span class="badge badge-soft-primary">{{ $role->name }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="phone align-middle white-space-nowrap py-2">

                                        @if (hasVerifiedPhone($user))
                                            <span class='badge badge-soft-success'>{{ __('Active') }}</span>
                                        @elseif (!hasVerifiedPhone($user))
                                            <span class='badge badge-soft-danger'>{{ __('Not Active') }}</span>
                                        @endif
                                        @if ($user->status == 1)
                                            <span class='badge badge-soft-danger'>{{ __('blocked') }}</span>
                                        @endif
                                    </td>
                                    <td class="joined align-middle py-2">{{ $user->created_at }} <br>
                                        {{ interval($user->created_at) }} </td>
                                    @if ($user->trashed())
                                        <td class="joined align-middle py-2">{{ $user->deleted_at }} <br>
                                            {{ interval($user->deleted_at) }} </td>
                                    @endif
                                    <td class="align-middle white-space-nowrap py-2 text-end">
                                        <div class="dropdown font-sans-serif position-static">
                                            <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal"
                                                type="button" id="customer-dropdown-0" data-bs-toggle="dropdown"
                                                data-boundary="window" aria-haspopup="true" aria-expanded="false"><span
                                                    class="fas fa-ellipsis-h fs--1"></span></button>
                                            <div class="dropdown-menu dropdown-menu-end border py-0"
                                                aria-labelledby="customer-dropdown-0">
                                                <div class="bg-white py-2">
                                                    @if ($user->trashed() &&
    auth()->user()->hasPermission('users-restore'))
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.restore', ['user' => $user->id]) }}">Restore</a>
                                                    @elseif(auth()->user()->hasPermission('users-update'))
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.activate', ['user' => $user->id]) }}">{{ hasVerifiedPhone($user) ? __('Deactivate') : __('Activate') }}</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.block', ['user' => $user->id]) }}">{{ $user->status == 0 ? __('Block') : __('Unblock') }}</a>
                                                    @endif
                                                    @if (auth()->user()->hasPermission('users-delete') ||
    auth()->user()->hasPermission('users-trash'))
                                                        <form method="POST"
                                                            action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item text-danger"
                                                                type="submit">{{ $user->trashed() ? __('Delete') : __('Trash') }}</button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                @else
                    <h3 class="p-4">{{ __('No Users To Show') }}</h3>
                @endif
            </div>
        </div>


        <div class="card-footer d-flex align-items-center justify-content-center">
            {{ $users->appends(request()->query())->links() }}
        </div>

    </div>
@endsection
