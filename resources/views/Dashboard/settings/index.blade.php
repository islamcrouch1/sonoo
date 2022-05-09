@extends('layouts.dashboard.app')

@section('adminContent')
    <div class="card mb-3" id="customersTable"
        data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">Settings</h5>
                </div>
            </div>
        </div>
        <div class="card-body p-0">

            <div class="row g-0 h-100">
                <div class="col-md-12 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                        <form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-3">
                                <label class="form-label" for="tax">Tax %</label>
                                <input name="tax" class="form-control @error('tax') is-invalid @enderror"
                                    value="{{ setting('tax') }}" type="number" autocomplete="on" id="tax" autofocus
                                    required />
                                @error('tax')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="max_price">Max Price %</label>
                                <input name="max_price" class="form-control @error('max_price') is-invalid @enderror"
                                    value="{{ setting('max_price') }}" type="number" autocomplete="on" id="max_price"
                                    required />
                                @error('max_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="commission">{{ __('Suggested commission %') }}</label>
                                <input name="commission" class="form-control @error('commission') is-invalid @enderror"
                                    value="{{ setting('commission') }}" type="number" autocomplete="on" id="commission"
                                    required />
                                @error('commission')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- <div class="mb-3">
                                <label class="form-label" for="image">Country flag</label>
                                <input name="image" class="img form-control @error('image') is-invalid @enderror"
                                    type="file" id="image" />
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">

                                <div class="col-md-10">
                                    <img src="" style="width:100px; border: 1px solid #999" class="img-thumbnail img-prev">
                                </div>

                            </div> --}}

                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
