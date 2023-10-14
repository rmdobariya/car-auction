<div class="auction-details-model">
    <input type="hidden" id="vehicle_id" value="{{$vehicle->id}}">
    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    <h3>Auction Details</h3>
    <div class="auction-times">
        <div class="start-date">
            <p>{{trans('web_string.start_date')}}</p>
            <span>{{$vehicle->auction_start_date}}</span>
        </div>
        <div class="end-date">
            <p>{{trans('web_string.end_date')}}</p>
            <span>{{$vehicle->auction_end_date}}</span>
        </div>
        <div class="auction-status">
            <p>{{trans('web_string.auction_status')}}</p>
            @if($vehicle->status == 'approve')
                <span>Approve</span>
            @elseif($vehicle->status == 'auction_start')
                <span>Auction Start</span>
            @elseif($vehicle->status == 'auction_close')
                <span>Auction Close</span>
            @elseif($vehicle->status == 'ongoing')
                <span>Ongoing</span>
            @endif
        </div>
    </div>
</div>
<div class="auctions-list bid-list">
    <h3>{{trans('web_string.auction_cars')}} ({{$vehicle->vehicle_name}})</h3>
    @if(count($bids) > 0)
        {{--    <div class="auctions-filter">--}}
        {{--        <div class="sdate">--}}
        {{--            <div class="input-group">--}}
        {{--                <input type="text" class="form-control" placeholder="Search car name">--}}
        {{--                <span class="input-group-text" id="basic-addon2">--}}
        {{--									<i class="las la-search"></i>--}}
        {{--								</span>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <select class="form-select">--}}
        {{--            <option>Highest Bid Amount</option>--}}
        {{--            <option>Lowest Bid Amount</option>--}}
        {{--        </select>--}}
        {{--        <div class="edate">--}}
        {{--            <div class="input-group date" id="datepicker2">--}}
        {{--                <input type="text" class="form-control" id="date" placeholder="Search by Date">--}}
        {{--                <span class="input-group-append">--}}
        {{--									<span class="input-group-text bg-light d-block">--}}
        {{--										<i class="las la-calendar-alt"></i>--}}
        {{--									</span>--}}
        {{--								</span>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="apply-filter">--}}
        {{--            <input type="submit" name="filter" value="Apply" class="place-bid-blue">--}}
        {{--        </div>--}}
        {{--    </div>--}}
        <div class="lists">
            <table id="bid_listing">
                <thead>
                <tr>
                    <th>{{trans('web_string.car_name')}}</th>
                    <th>{{trans('web_string.minimum_bid_amount')}}</th>
                    <th>{{trans('web_string.bid_increment')}}</th>
                    <th>{{trans('web_string.highest_bidder')}}</th>
                    <th>{{trans('web_string.bid_amount')}}</th>
                    <th>{{trans('web_string.bid_on')}}</th>
                    {{--                <th>Action</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($bids as $bid)
                    <tr>
                        <td>{{$bid->vehicle_name}}</td>
                        <td>SAR {{number_format($bid->minimum_bid_increment_price)}}</td>
                        <td>SAR {{number_format($bid->bid_increment)}}</td>
                        <td>{{$bid->user_name}}</td>
                        <td>SAR {{number_format($bid->amount)}}</td>
                        <td>{{$bid->auction_start_date}}</td>
                        {{--                <td>--}}
                        {{--                    <a href="#" class="view" data-bs-toggle="modal" data-bs-target="#auctiondetails"><i class="las la-eye"></i></a>--}}
                        {{--                    <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#auction-details"><i class="las la-pencil-alt"></i></a>--}}
                        {{--                    <a href="#" class="delete"><i class="las la-trash-alt"></i></a>--}}
                        {{--                    <a href="#" class="download"><i class="las la-download"></i></a>--}}
                        {{--                </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <h2>{{trans('web_string.no_new_bid')}}</h2>
    @endif
</div>
<script>
    var intervalId;

    // $(document).ready(function(){
    function startInterval() {
        let vehicle_id = $('#vehicle_id').val();
        intervalId = setInterval(function () {
            axios
                .get(APP_URL + '/updated-bid' + '/' + vehicle_id)
                .then(function (response) {
                    $('#bid_listing').html(response.data.data)
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                })
        }, 5000);
    }

    // });

    function stopInterval() {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }

    $('#bib_modal_close').on('click', function () {
        $('#auctiondetails').modal('hide')
        $('#vehicle_id').val('')
        stopInterval();
    })
</script>
