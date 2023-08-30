<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <link href="{{asset('assets/admin/style.css')}}?v={{time()}}">


    <title>{{ env('APP_NAME') }} | @yield('title')</title>
</head>
<body>
<div class="card">
    <div class="card-header px-2 min-height-auto">
        <div class="card-title ">Forget Password</div>
    </div>
    <div class="card-body  p-2">
        <form method="POST" data-parsley-validate="" id="addEditForm" role="form"
              enctype="multipart/form-data">
            @csrf

            <input type="hidden" id="email" value="{{ $email }}"
                   name="email">

            <div class="row mb-2">
                <div class="col-md-12">
                    <label for="name" class="required fs-6 fw-bold">
                        New Password
                    </label>
                    <input type="text" class="form-control"
                           name="new_password" id="new_password"
                           placeholder="New Password" required/>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-12">
                    <label for="confirm_password" class="required fs-6 fw-bold">
                        Confirm Password
                    </label>
                    <input type="text" class="form-control"
                           name="confirm_password" id="confirm_password"
                           placeholder="Confirm Password" required/>
                </div>
            </div>

            <div class="card-footer text-end p-1 btn-showcase">
                <button class="btn btn-primary" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    var APP_URL = {!! json_encode(url('/admin')) !!};
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('assets/admin/custom/custom.js') }}"></script>


<script>
    var form_url = '/reset-password-submit'
    var redirect_url = '/login'
</script>

<script src="{{ asset('assets/admin/custom/form.js') }}"></script>
</html>
