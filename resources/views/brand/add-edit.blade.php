@extends('layouts.base')

@section('content')


<div class="widget-content py-3">
    <form id="needs-validation" enctype="multipart/form-data"
          novalidate method="post"
          action="{{isset($data['brand']) ? route('brand.update', $data['brand']->id) : route('brand.store')}}"
          autocomplete="off">
        @csrf
        @if(isset($data['brand']))
        @method('PUT')
        @endif
        <input type="hidden" class="form-control" id="id" name="id"
               value="{{isset($data['brand']) ? $data['brand']->id : null}}">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Brand Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                           value="{{isset($data['brand']) ? $data['brand']->name : null}}">

                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <p for="">Brand Categories *</p>

                @if(isset($data['brand']))
                @foreach($data['categories'] as $category)

                @if($category->checked)

                <div class="form-check-inline">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-categories" type="checkbox" checked
                                   value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                            {{$category->name}}
                        </label>
                    </div>

                    @if($category->showHome)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"checked
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @else
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @endif
                </div>
                @else
                <div class=" form-check-inline">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-categories" type="checkbox"
                                   value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                            {{$category->name}}
                        </label>
                    </div>
                    @if($category->showHome)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"checked
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @else
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @endif
                </div>
                @endif

                @endforeach
                @else
                @foreach($data['categories'] as $category)
                <div class=" form-check-inline">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-categories" type="checkbox"
                                   value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                            {{$category->name}}
                        </label>
                    </div>
                    @if($category->showHome)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"checked
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @else
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input brand-category-home" type="checkbox"
                                   value="{{$category->id}}" name="show_home[]" id="home_{{$category->id}}">
                            DISPLAY IN HOME
                        </label>
                    </div>
                    @endif
                </div>
                @endforeach
                @endif

                @error('categories')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

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

            <div class="col-6 mt-4">

                @if(isset($data['brand']))
                <p for="name">Existing Image</p>
                @if($data['brand']->image)
                <img src="{{$data['brand']->image}}"/>
                @else
                <label class="text-danger">No image available</label>
                @endif

                @endif

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
