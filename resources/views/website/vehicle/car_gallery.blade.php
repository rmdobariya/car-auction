<div class="row">
    @foreach($vehicleImages as $image)
        <div class="col-xl-3 col-lg-3">
            <div class="img-thumbnail mb-3 image-container">

                <img src="{{url($image->image)}}" alt="thumb1" class="thumbimg wd-100p" style="width:-webkit-fill-available">
                <div class="btn btn-list pl-0 pb-0">
                    <a href="javascript:void(0)" data-id="{{$image->id}}" data-vehicle-id="{{$image->vehicle_id}}"
                       class="delete-vehicle-image btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete">Delete</a>
                </div>
            </div>
        </div>
    @endforeach

</div>
<script>

</script>
