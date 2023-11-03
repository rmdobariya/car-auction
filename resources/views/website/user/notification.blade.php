@extends('website.layouts.master')
@section('title')
    {{trans('web_string.notifications')}}
@endsection
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>{{trans('web_string.notifications')}}</h1>
{{--                        <a href="javascript:void(0)">Load more</a>--}}
                    </div>
                </div>
                <div class="clearfix"></div>
                @if(count($notifications) > 0)
                <div class="col-md-12">
                    @foreach($notifications as $notification)
                    <div class="notification-box">
                        <div class="noti-img">
                            <img src="{{asset($notification->vehicle_image)}}" alt="car">
                        </div>
                        <div class="noti-details">
                            <div class="noti-heading">
                                <h2>{{trans('web_string.car_inquiry')}}</h2>
                                <span>{{Carbon\Carbon::parse($notification->created_at)->format('h:i A | l  d F Y')}}</span>
                                <span><a href="#" class="notification_delete" data-id="{{$notification->id}}"> <i class="fa fa-trash" style="color: red"></i></a></span>
                            </div>
                            <p>{!! $notification->message !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                    <h3>{{trans('web_string.no_new_notification')}}</h3>
                @endif
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
@section('custom-script')
    <script>
        var delete_title = '{{trans('web_string.notification_delete')}}';
        var delete_text = '{{trans('web_string.are_you_sure_this_record_delete')}}';
    </script>
    <script src="{{asset('web/assets/custom/notification/notification.js')}}?v={{time()}}"></script>
@endsection
