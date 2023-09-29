<div class="auction-details-model">
    <input type="hidden" id="vehicle_id" value="{{$vehicle->id}}">
    <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
    <h3>Auction Details</h3>
    <div class="auction-times">
        <div class="start-date">
            <p>Start Date</p>
            <span>{{$vehicle->auction_start_date}}</span>
        </div>
        <div class="end-date">
            <p>End Date</p>
            <span>{{$vehicle->auction_end_date}}</span>
        </div>
        <div class="auction-status">
            <p>Auction Status</p>
            <span>Ongoing</span>
        </div>
    </div>
</div>
<div class="auctions-list bid-list">
    <h3>Auction Cars</h3>
    <div class="auctions-filter">
        <div class="sdate">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search car name">
                <span class="input-group-text" id="basic-addon2">
									<i class="las la-search"></i>
								</span>
            </div>
        </div>
        <select class="form-select">
            <option>Highest Bid Amount</option>
            <option>Lowest Bid Amount</option>
        </select>
        <div class="edate">
            <div class="input-group date" id="datepicker2">
                <input type="text" class="form-control" id="date" placeholder="Search by Date">
                <span class="input-group-append">
									<span class="input-group-text bg-light d-block">
										<i class="las la-calendar-alt"></i>
									</span>
								</span>
            </div>
        </div>
        <div class="apply-filter">
            <input type="submit" name="filter" value="Apply" class="place-bid-blue">
        </div>
    </div>
    <div class="lists">
        <table>
            <thead>
            <tr>
                <th>Car Name</th>
                <th>Minimum Bid Amount</th>
                <th>Bid Increment</th>
                <th>Highest Bidder</th>
                <th>Bid Amount</th>
                <th>Bid On</th>
{{--                <th>Action</th>--}}
            </tr>
            </thead>
            <tbody id="bid_listing">
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
</div>
<script>
    $(document).ready(function(){
        let vehicle_id = $('#vehicle_id').val();
        setInterval(function(){
            // loaderView()
            axios
                .get(APP_URL + '/updated-bid' + '/' + vehicle_id)
                .then(function (response) {
                    $('#bid_listing').html(response.data.data)
                    // notificationToast(response.data.message, 'success')
                    // loaderHide()
                })
                .catch(function (error) {
                    notificationToast(error.response.data.message, 'warning')
                    // loaderHide()
                })

        },5000);
    });
</script>