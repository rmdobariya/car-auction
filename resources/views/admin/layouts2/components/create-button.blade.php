<div class="d-flex align-items-center gap-2 gap-lg-3">
{{--    @if((request()->segment(2) == 'category'))--}}
{{--        <a href="{{ route('vendor.category-order-by') }}"--}}
{{--           class="btn btn-sm btn-light-primary me-3">--}}
{{--            <i class="fa fa-sort"></i> OrderBy }}--}}
{{--        </a>--}}
{{--    @endif--}}
    <a href="{{ $url }}" class="btn btn-sm btn-primary">{{trans('admin_string.create')}}</a>
</div>
