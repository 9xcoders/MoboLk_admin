@extends('layouts.base')

@section('content')


<div class="widget-content py-3">
    <form id="needs-validation" enctype="multipart/form-data"
          novalidate method="post"
          action="{{isset($data['hotDeal']) ? route('hot-deal.update', $data['hotDeal']->id) : route('hot-deal.store')}}"
          autocomplete="off">
        @csrf
        @if(isset($data['hotDeal']))
            @method('PUT')
        @endif
        <input type="hidden" class="form-control" id="id" name="id"
               value="{{isset($data['hotDeal']) ? $data['hotDeal']->id : null}}">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder=""
                           value="{{isset($data['hotDeal']) ? $data['hotDeal']->title : null}}">

                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="brand_id">Category *</label>
                    <select required class="form-control" id="category_id" name="category_id">
                        <option value="">--Select a category--</option>
                        @foreach($data['categories'] as $category)

                        @if(isset($data['hotDeal']))
                        @if($data['hotDeal']->category_id === $category->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif

                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif

                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


            </div>

            <div class="col-12 col-md-3">
                <div class="form-group">
                    <label for="name">Button Text *</label>
                    <input type="text" class="form-control" id="button_text" name="button_text" placeholder=""
                           value="{{isset($data['hotDeal']) ? $data['hotDeal']->button_text : null}}">

                    @error('button_text')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="short_desc">Description *</label>
                    <textarea class="form-control" id="description" name="description" rows="4">
                        {{isset($data['hotDeal']) ? $data['hotDeal']->description : null}}
                    </textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
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

                @if(isset($data['hotDeal']))
                <p for="name">Existing Image</p>
                @if($data['hotDeal']->image_url)
                <img src="{{$data['hotDeal']->image_url}}"  height="200px" width="300px"/>
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
