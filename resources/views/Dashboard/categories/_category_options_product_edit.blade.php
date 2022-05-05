@php
isset($count) ? $count++ : ($count = 1);
@endphp

<option value="{{ $scategory->id }}"
    {{ $product->categories()->where('category_id', $scategory->id)->first()? 'selected': '' }}>
    {{ str_repeat(' - ', $count) }} {{ app()->getLocale() == 'ar' ? $scategory->name_ar : $scategory->name_en }}
</option>

@if ($scategory->children->count() > 0)
    @foreach ($scategory->children as $subCat)
        @include('dashboard.categories._category_options_edit', [
            'scategory' => $subCat,
            'count' => $count,
            'product' => $product,
        ])
    @endforeach
@endif
