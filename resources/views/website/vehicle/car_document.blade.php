<div class="row">
    @foreach($vehicleDocuments as $document)
        <div class="col-xl-3 col-lg-3 col-3">
            <div class="img-thumbnail mb-3 image-container">

                <img src="{{url($document->document)}}" alt="thumb1" class="thumbimg wd-100p" style="max-width:250px">
                <div class="btn btn-list pl-0 pb-0">
                    <a href="javascript:void(0)" data-id="{{$document->id}}" data-vehicle-id="{{$document->vehicle_id}}"
                       class="delete-car-document btn btn-danger waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete">Delete</a>
                </div>
            </div>
        </div>
    @endforeach

</div>
<script>

</script>
