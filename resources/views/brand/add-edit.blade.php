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
                <label for="">Brand Categories *</label>

                @if(isset($data['brand']))
                @foreach($data['categories'] as $category)

                @if($category->checked)

                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input brand-categories" type="checkbox" checked
                               value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                        {{$category->name}}
                    </label>
                </div>
                @else
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input brand-categories" type="checkbox"
                               value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                        {{$category->name}}
                    </label>
                </div>
                @endif

                @endforeach
                @else
                @foreach($data['categories'] as $category)
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input brand-categories" type="checkbox"
                               value="{{$category->id}}" name="categories[]" id="{{$category->id}}">
                        {{$category->name}}
                    </label>
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
        </div>

        <button class="btn btn-primary" type="submit">Save</button>
    </form>


</div>


@endsection
