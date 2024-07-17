@extends('website.layouts.master')
@section('title')
    Corporate Seller Page
@endsection
@section('content')
    <section id="testimonial">
        <div class="container" id="corporate_seller_part">
            <div class="row">
                {{--                <div class="col-md-12">--}}
                <div class="col-md-6">
                    <div class="title">
                        <h1>{{trans('web_string.corporate_seller')}}</h1>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <input type="text" id="seller_search" placeholder="Search Seller" name="seller_search">
                </div>
                {{--                </div>--}}
                <div class="clearfix"></div>
                @php $count = 0; @endphp
                @foreach($corporate_sellers as $corporate_seller)
                    @if($count % 4 == 0)
            </div>
            <div class="row">
                @endif
                <div class="col-md-3">
                    <div class="testimonial_box">
                        <div class="testimonial_box-inner">
                            <div class="testimonial_box-top">
                                <div>
                                    <img class="img-fluid" src="{{asset($corporate_seller->image)}}" alt="profile">
                                </div>
                                <div class="testimonial_box-name">
                                    <h4>{{$corporate_seller->full_name}}</h4>
                                </div>
                                <div class="testimonial_box-name">
                                    <a href="{{route('seller',encrypt($corporate_seller->id))}}"
                                       class="btn btn-view-all">{{trans('web_string.view_auction')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $count++; @endphp
                @endforeach
            </div>
        </div>
    </section>

@endsection
@section('custom-script')
    <script>
        $('#seller_search').on('keyup', function () {
            const value = $(this).val()
            // if (value.length > 2) {
            loaderView()
            axios
                .post(APP_URL + '/render-corporate-seller',{value:value})
                .then(function (response) {
                    $('#corporate_seller_part').html(response.data.data)
                    loaderHide()
                })
                .catch(function (error) {
                    loaderHide()
                })
            // } else {
            //     // If the length of the input value is not greater than 2, you may want to clear or hide any previous search results
            //     // For example:
            //
            // }

        })
    </script>
@endsection
