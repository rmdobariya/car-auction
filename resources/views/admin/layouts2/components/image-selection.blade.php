<div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true">
    <div class="image-input-wrapper w-150px h-150px" @if(isset($image)) style="background-image:url('{{ $image }}')" @else style="background-image: url('{{ asset('assets/media/svg/files/blank-image.svg') }}')" @endif></div>
    <input type="file" name="{{ $id }}" id="{{ $id }}" accept="image/*" style="display: none" />
    <label for="{{ $id }}" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Allowed max 2MB and only JPG, PNG, GIF files are allowed.">
        <i class="bi bi-pencil-fill fs-7"></i>
    </label>
    <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel Image">
        <i class="bi bi-x fs-2"></i>
    </button>
    <button type="button" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
            data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove Image">
        <i class="bi bi-x fs-2"></i>
    </button>
</div>
<div class="text-muted fs-7">{{ $description_string }}</div>
<div id="{{$id}}_error"></div>
