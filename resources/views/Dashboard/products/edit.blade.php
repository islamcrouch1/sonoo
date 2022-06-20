@extends('layouts.Dashboard.app')

@section('adminContent')
    <div class="card mb-3" id="customersTable"
        data-list='{"valueNames":["name","email","phone","address","joined"],"page":10,"pagination":true}'>
        <div class="card-header">
            <div class="row flex-between-center">
                <div class="col-4 col-sm-auto d-flex align-items-center pe-0">
                    <h5 class="fs-0 mb-0 text-nowrap py-2 py-xl-0">{{ __('Edit Product') }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body p-0">

            <div class="row g-0 h-100">
                <div class="col-md-12 d-flex flex-center">
                    <div class="p-4 p-md-5 flex-grow-1">
                        <form method="POST" action="{{ route('products.update', ['product' => $product->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label" for="name_ar">{{ __('product name - arabic') }}</label>
                                <input name="name_ar" class="form-control @error('name_ar') is-invalid @enderror"
                                    value="{{ $product->name_ar }}" type="text" autocomplete="on" id="name_ar"
                                    required />
                                @error('name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="name_en">{{ __('product name - english') }}</label>
                                <input name="name_en" class="form-control @error('name_en') is-invalid @enderror"
                                    value="{{ $product->name_en }}" type="text" autocomplete="on" id="name_en"
                                    required />
                                @error('name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="sku">{{ __('SKU') }}</label>
                                <input name="sku" class="form-control @error('sku') is-invalid @enderror"
                                    value="{{ $product->sku }}" type="text" autocomplete="on" id="sku"
                                    required />
                                @error('sku')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"
                                    for="description_ar">{{ __('product description - arabic') }}</label>
                                <textarea id="description_ar" class="form-control tinymce d-none @error('description_ar') is-invalid @enderror"
                                    name="description_ar">{!! $product->description_ar !!}</textarea>
                                @error('description_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label"
                                    for="description_en">{{ __('product description - english') }}</label>
                                <textarea id="description_en" class="form-control tinymce d-none @error('description_en') is-invalid @enderror"
                                    name="description_en">{!! $product->description_en !!}</textarea>
                                @error('description_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="vendor_price">{{ __('Vendor price') }}</label>
                                <input name="vendor_price" class="form-control @error('vendor_price') is-invalid @enderror"
                                    value="{{ $product->vendor_price }}" type="number" min="0" autocomplete="on"
                                    id="vendor_price" required />
                                @error('vendor_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="extra_fee">{{ __('Extra fee') }}</label>
                                <input name="extra_fee" class="form-control @error('extra_fee') is-invalid @enderror"
                                    type="number" min="0" value="{{ $product->extra_fee }}" autocomplete="on"
                                    id="extra_fee" />
                                @error('extra_fee')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="limited">{{ __('Unlimited Quantity') }}</label>
                                <div>
                                    <label class="switch">
                                        <input id="limited" class="form-control @error('limited') is-invalid @enderror"
                                            name="limited" type="checkbox"
                                            {{ $product->unlimited == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('limited')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="categories">{{ __('Select Categories') }}</label>

                                <select class="form-select js-choice @error('categories') is-invalid @enderror"
                                    multiple="multiple" name="categories[]" id="categories"
                                    data-options='{"removeItemButton":true,"placeholder":true}' required>
                                    <option value="">
                                        {{ __('Select Categories') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->categories()->where('category_id', $category->id)->first()? 'selected': '' }}>
                                            {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
                                        </option>

                                        @if ($category->children->count() > 0)
                                            @foreach ($category->children as $subCat)
                                                @include('Dashboard.categories._category_options_product_edit',
                                                    [
                                                        'scategory' => $subCat,
                                                        'product' => $product,
                                                    ])
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('categories')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label" for="colors">Product Colors</label>
                                <select class="form-select js-choice @error('colors') is-invalid @enderror" name="colors[]"
                                    multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'
                                    required>
                                    <option value="">
                                        {{ __('Select Colors') }}</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ app()->getLocale() == 'ar' ? $color->color_ar : $color->color_en }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('colors')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="sizes">Product Sizes</label>
                                <select class="form-select js-choice @error('sizes') is-invalid @enderror" name="sizes[]"
                                    multiple="multiple" data-options='{"removeItemButton":true,"placeholder":true}'
                                    required>
                                    <option value="">
                                        {{ __('Select Sizes') }}</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ app()->getLocale() == 'ar' ? $size->size_ar : $size->size_en }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sizes')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div> --}}


                            <div class="mb-3">
                                <label class="form-label" for="status">{{ __('Product Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" aria-label=""
                                    name="status" id="status" required>
                                    <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>
                                        {{ __('Pending') }}
                                    </option>
                                    <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                        {{ __('Active') }}
                                    </option>
                                    <option value="rejected" {{ $product->status == 'rejected' ? 'selected' : '' }}>
                                        {{ __('Rejected') }}
                                    </option>
                                    <option value="paused" {{ $product->status == 'paused' ? 'selected' : '' }}>
                                        {{ __('Paused') }}
                                    </option>
                                </select>
                                @error('status')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="image">{{ __('Product images') }}</label>
                                <input name="images[]" class="imgs form-control @error('image') is-invalid @enderror"
                                    type="file" accept="image/*" id="image" multiple />
                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="col-md-12" id="gallery">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/images/products/' . $image->image) }}"
                                            style="width:100px; border: 1px solid #999" class="img-thumbnail img-prev">
                                    @endforeach

                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit">{{ __('Edit
                                                                        Product') }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
