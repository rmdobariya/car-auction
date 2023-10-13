@extends('admin.layouts.master')
@section('title')
    {{trans('web_string.reset_password')}}
@endsection
@section('content')
<div class="container margin-bottom-40 margin-top-70">
    <div class="row">
        <div class="col-md-12">
            <h3 class="headline_part centered margin-bottom-60">{{trans('web_string.reset_password')}}<span>
                    </span>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="utf_dashboard_list_box margin-top-0">
                <h4 class="gray"><i class="sl sl-icon-key"></i> {{trans('web_string.reset_password')}}</h4>
                <div class="utf_dashboard_list_box-static">
                    <div class="my-profile">
                        <form id="addEditForm" method="post">
                            <input type="hidden" name="token" value="{{ $token }}" required>
                            <input type="hidden" name="email" value="{{ $email }}" required>
                            <div class="row with-forms">
                                <div class="col-md-12">
                                    <label for="new_password">{{trans('web_string.new_password')}}</label>
                                    <input type="password" class="input-text"
                                           id="new_password"
                                           name="new_password"
                                           placeholder="*********" required/>
                                </div>
                                <div class="col-md-12">
                                    <label for="confirm_password">{{trans('web_string.confirm_new_password')}}</label>
                                    <input type="password" class="input-text"
                                           id="confirm_password"
                                           name="confirm_password"
                                           placeholder="*********"
                                           value="" required/>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="button btn_center_item margin-top-15">{{trans('web_string.submit')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        var REDIRECT_URL = {!! json_encode(url('/')) !!};
    </script>
    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })

            let $form = $('#addEditForm')
            $form.on('submit', function (e) {
                console.log('dfdsf');
                loaderView()
                let formData = new FormData($form[0])
                axios
                    .post( '/resetPassword', formData)
                    .then(function (response) {
                        if ($('#form-method').val() === 'add') {
                            $form[0].reset()
                        }
                        setTimeout(function () {
                            window.location.href = REDIRECT_URL + '/';
                            loaderHide()
                        }, 1000)
                        notificationToast(response.data.message, 'success')
                    })
                    .catch(function (error) {
                        console.log(error)
                        notificationToast(error.response.data.message, 'warning')
                        loaderHide()
                    })
            })
        })
    </script>
@endsection

