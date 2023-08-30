<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/media/logos/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.png')}}" type="image/x-icon">
    <title>Admin - @yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
          rel="stylesheet">
    @include('admin.layouts2.authentication.css')
    @yield('style')
    <script>
        var APP_URL = {!! json_encode(url('/admin')) !!};
        var default_message = "{{ trans('admin_string.common_default_message') }}"
        var replace_message = "{{ trans('admin_string.common_replace_message') }}"
        var file_remove = "{{ trans('admin_string.common_file_remove') }}"
        var file_error_message = "{{ trans('admin_string.common_file_error_message') }}"
    </script>
</head>
<body id="kt_body" class="bg-body">
<!-- login page start-->
@yield('content')
<!-- latest jquery-->
@include('admin.layouts2.authentication.script')
</body>
</html>
