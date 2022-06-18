@extends('layouts.Dashboard.app')

@section('adminContent')
    <div class="card mb-3" id="customersTable"
        data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">{{ __('Add New Slide') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body p-0">

            <div class="row g-0 h-100">
                <div class="col-md-12 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                        <form method="POST" action="{{ route('slides.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="slider_id">{{ __('Slider ID') }}</label>
                                <input name="slider_id" class="form-control @error('slider_id') is-invalid @enderror"
                                    value="{{ old('slider_id') }}" type="number" autocomplete="on" id="slider_id"
                                    autofocus required />
                                @error('slider_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="url">{{ __('Slide URL') }}</label>
                                <input name="url" class="form-control @error('url') is-invalid @enderror"
                                    value="{{ old('url') }}" type="text" autocomplete="on" id="url" autofocus
                                    required />
                                @error('url')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="image">{{ __('Slide image') }}</label>
                                <input name="image" class="img form-control @error('image') is-invalid @enderror"
                                    type="file" id="image" required />
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">

                                <div class="col-md-10">
                                    <img src="" style="width:300px; border: 1px solid #999"
                                        class="img-thumbnail img-prev">
                                </div>

                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit">{{ __('Add New
                                                                        Slide') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
