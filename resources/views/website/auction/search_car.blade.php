@if(count($vehicles) > 0)
@foreach($vehicles as $vehicle)
    <tr>
        <td>{{$vehicle->vehicle_name}}</td>
        <td>{{$vehicle->make}}</td>
        <td>{{$vehicle->model}}</td>
        @if(!is_null($vehicle->minimum_bid_increment_price))
            <td>SAR {{$vehicle->minimum_bid_increment_price}}</td>
        @else
            <td></td>
        @endif
        @if(!is_null($vehicle->bid_increment))
            <td>SAR {{$vehicle->bid_increment}}</td>
        @else
            <td></td>
        @endif
        <td>
            <a href="#" class="view_bid" data-id="{{$vehicle->id}}"
               data-bs-toggle="modal"><i class="las la-eye"></i></a>
            <a href="{{route('edit-car',$vehicle->id)}}" class="edit"><i
                    class="las la-pencil-alt"></i></a>
            <a href="#" class="delete-single" data-id="{{$vehicle->id}}"><i
                    class="las la-trash-alt"></i></a>
            {{--                                        <a href="#" class="download"><i class="las la-download"></i></a>--}}
        </td>
    </tr>
@endforeach
@else
    <h2>{{trans('web_string.car_not_found')}}</h2>
@endif
