<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>

    @include('admin.layouts.css')

    <title>{{ env('APP_NAME') }} | @yield('title')</title>
</head>
<body>
@include('admin.layouts.sidebar')
@yield('content')
@include('admin.layouts.script')
@yield('script')
</body>
</html>
