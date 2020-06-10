@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <form id="needs-validation"
          novalidate method="post"
          action="{{route('banner-image.store')}}" enctype="multipart/form-data"
          autocomplete="off">

        @csrf
        <div class="row">
            <div class="col-6">
                <div class="file-upload">
                    <div class="image-upload-wrap">
                        <input class="file-upload-input" name="image" type='file' onchange="readURL(this);"
                               accept="image/*"/>
                        <div class="drag-text">
                            <h3>Drag and drop a file or select add Image</h3>
                        </div>
                    </div>
                    <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="your image"/>
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                                    class="image-title">Uploaded Image</span></button>
                        </div>
                    </div>
                </div>
                @error('image')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>

    </form>


    @if(count($data['images']) >0)
    <table class="table mt-4">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['images'] as $image)

        <tr>
            <th scope="row">{{ $image->id }}</th>
            <td>
                <img class="image" src="{{ $image->image_url }}" height="200px" width="500px" alt="">
            </td>
            <td class="d-inline-flex">

                <form action="{{ route('banner-image.delete', $image->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mb-2">
                        <i class="fa fa-remove"></i>
                    </button>
                </form>
            </td>
        </tr>

        @endforeach
        </tbody>
    </table>
    @else
    <h4 class="alert-danger mt-4">No images available</h4>
    @endif
</div>


@endsection


@section('js')
@parent


<script>
    function readURL(input) {
        var Thisinput = $(input)
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function (e) {
                Thisinput.closest('.file-upload').find('.image-upload-wrap').hide();

                Thisinput.closest('.file-upload').find('.file-upload-image').attr('src', e.target.result);
                Thisinput.closest('.file-upload').find('.file-upload-content').show();

                Thisinput.closest('.file-upload').find('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }

    $('.image-upload-wrap').bind('dragover', function () {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
        $('.image-upload-wrap').removeClass('image-dropping');
    });

</script>

@endsection
