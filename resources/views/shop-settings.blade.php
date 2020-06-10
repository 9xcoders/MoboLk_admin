@extends('layouts.base')

@section('content')


<div class="widget-content py-3">
    <form id="needs-validation" enctype="multipart/form-data"
          novalidate method="post"
          action="{{route('shop-settings.store')}}"
          autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label for="name">Shop Name *</label>
                    <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->shop_name : null}}">
                    @error('shop_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="file-upload">
                    <div class="image-upload-wrap">
                        <input class="file-upload-input" name="shop_logo" type='file' onchange="readURL(this);"
                               accept="image/*"/>
                        <div class="drag-text">
                            <h3>Drag and drop a file or select add Image</h3>
                        </div>

                        @error('shop_logo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="your image"/>
                        <div class="image-title-wrap">
                            <button type="button" onclick="removeUpload()" class="remove-image">Remove <span
                                    class="image-title">Uploaded Image</span></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">

                @if(isset($data['settings']))
                <p for="name">Shop Existing Logo</p>
                @if($data['settings']->shop_logo)
                <img src="{{$data['settings']->shop_logo}}"/>
                @else
                <label class="text-danger">No logo available</label>
                @endif

                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Shop Address Line 1 *</label>
                    <input type="text" class="form-control" id="address_line_1" name="address_line_1" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->address_line_1 : null}}">
                    @error('address_line_1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Shop Address Line 2</label>
                    <input type="text" class="form-control" id="address_line_2" name="address_line_2" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->address_line_2 : null}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Shop Address Line 3</label>
                    <input type="text" class="form-control" id="address_line_3" name="address_line_3" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->address_line_3 : null}}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Shop Address Line 4</label>
                    <input type="text" class="form-control" id="address_line_4" name="address_line_4" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->address_line_4 : null}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <label for="name">Shop Location</label>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Latitude</label>
                    <input type="number" class="form-control" id="latitude" name="latitude" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->latitude : null}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Longitude</label>
                    <input type="number" class="form-control" id="longitude" name="longitude" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->longitude : null}}">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Telephone No</label>
                    <input type="text" class="form-control" id="tel" name="tel" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->tel : null}}">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Mobile No</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->mobile : null}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Hotline No</label>
                    <input type="text" class="form-control" id="hotline" name="hotline" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->hotline : null}}">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->email : null}}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <label for="name">Social Links</label>
            </div>
        </div>


        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Facebook</label>
                    <input type="text" class="form-control" id="facebook_link" name="facebook_link" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->facebook_link : null}}">
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Instagram</label>
                    <input type="text" class="form-control" id="instagram_link" name="instagram_link" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->instagram_link : null}}">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Twitter</label>
                    <input type="text" class="form-control" id="twitter_link" name="twitter_link" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->twitter_link : null}}">
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">YouTube</label>
                    <input type="text" class="form-control" id="youtube_link" name="youtube_link" placeholder=""
                           value="{{isset($data['settings']) ? $data['settings']->youtube_link : null}}">
                </div>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>


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
