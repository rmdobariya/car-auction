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
