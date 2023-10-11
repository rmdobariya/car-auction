@extends('website.layouts.master')
@section('content')
    <section id="vehicles" class="featured-vehicles">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading">
                        <h1>Notifications</h1>
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
                                <h2>Car Inquiry</h2>
                                <span>{{Carbon\Carbon::parse($notification->created_at)->format('h:i A | l  d F Y')}}</span>
                            </div>
                            <p>{!! $notification->message !!}</p>
                        </div>
                    </div>
                    @endforeach
{{--                    <div class="notification-box">--}}
{{--                        <div class="noti-img">--}}
{{--                            <img src="images/car.jpg" alt="car">--}}
{{--                        </div>--}}
{{--                        <div class="noti-details">--}}
{{--                            <div class="noti-heading">--}}
{{--                                <h2>Auction Ended!</h2>--}}
{{--                                <span>12:16 am | Wednesday, 6 September 2023</span>--}}
{{--                            </div>--}}
{{--                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="notification-box">--}}
{{--                        <div class="noti-img">--}}
{{--                            <img src="images/car.jpg" alt="car">--}}
{{--                        </div>--}}
{{--                        <div class="noti-details">--}}
{{--                            <div class="noti-heading">--}}
{{--                                <h2>Congratulations!</h2>--}}
{{--                                <span>12:16 am | Wednesday, 6 September 2023</span>--}}
{{--                            </div>--}}
{{--                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="notification-box">--}}
{{--                        <div class="noti-img">--}}
{{--                            <img src="images/car.jpg" alt="car">--}}
{{--                        </div>--}}
{{--                        <div class="noti-details">--}}
{{--                            <div class="noti-heading">--}}
{{--                                <h2>New Listing</h2>--}}
{{--                                <span>12:16 am | Wednesday, 6 September 2023</span>--}}
{{--                            </div>--}}
{{--                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                @else
                    <h3>{{trans('web_string.no_new_notification')}}</h3>
                @endif
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
@endsection
