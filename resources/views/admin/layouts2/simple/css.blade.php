<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet"
      type="text/css"/>
<link href="{{ asset('assets/custom/custom.css') }}" rel="stylesheet" type="text/css"/>

@if((int)Auth::guard('admin')->user()->panel_mode===1)
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
@elseif((int)Auth::guard('admin')->user()->panel_mode===2)
    <link href="{{ asset('assets/plugins/global/plugins.dark.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.dark.bundle.css') }}" rel="stylesheet" type="text/css"/>
@elseif((int)Auth::guard('admin')->user()->panel_mode===1)
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
@elseif((int)Auth::guard('admin')->user()->panel_mode===2)
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.dark.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.dark.bundle.rtl.css') }}" rel="stylesheet" type="text/css"/>
@endif
<script src="https://unpkg.com/feather-icons"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"/>
@yield('css')

<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/admin')) !!};
    var JS_URL = '{{url('/')}}'
    var is_admin_open = 1
</script>
