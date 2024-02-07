<div class="card-toolbar">
    <div class="w-100 mw-150px">
        <select class="form-select form-select-solid status-filter min-w-100px"
                id="status"
                data-control="select2"
                data-hide-search="true"
                data-placeholder="Status"
                data-kt-ecommerce-product-filter="Status">
            <option></option>
            <option value="all">{{trans('admin_string.all')}}</option>
            <option value="active">{{trans('admin_string.active')}}</option>
            <option value="inActive">{{trans('admin_string.inactive')}}</option>
        </select>
    </div>
</div>
