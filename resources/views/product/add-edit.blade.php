@extends('layouts.base')

@section('content')


<div class="widget-content py-3">


    <div class="row">
        <div class="col-lg-12 widget-content py-2">
            <div class="bd-example bd-example-tabs">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="info" data-toggle="tab" href="#product-info" role="tab"
                           aria-controls="Product Info" aria-selected="false">Product Info</a>
                    </li>

                    @if(isset($data['product']))

                    <li class="nav-item">
                        <a class="nav-link" id="version" data-toggle="tab" href="#product-version" role="tab"
                           aria-controls="Version" aria-selected="false">Options</a>
                    </li>
                    @endif

                </ul>
                <div class="tab-content" id="myTabContent1">
                    <div class="tab-pane fade active show" id="product-info" role="tabpanel"
                         aria-labelledby="product-info-tab">

                        <form id="needs-validation" class="pt-2" enctype="multipart/form-data"
                              novalidate method="post"
                              action="{{isset($data['product']) ? route('product.update', $data['product']->id) : route('product.store')}}"
                              autocomplete="off">
                            @csrf
                            @if(isset($data['product']))
                            @method('PUT')
                            @endif
                            <input type="hidden" class="form-control" id="id" name="id"
                                   value="{{isset($data['product']) ? $data['product']->id : null}}">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->name : null}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 d-inline d-inline-block">
                                    <div class="form-group">
                                        <label for="brand_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">--Select a category--</option>
                                            @foreach($data['categories'] as $category)

                                            @if(isset($data['product']))
                                            @if($data['product']->category_id === $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                            @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif

                                            @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endif

                                            @endforeach
                                        </select>
                                    </div>


                                </div>

                                <div class="col-12 col-md-3">

                                    @if(isset($data['product']))
                                    <div class="form-group">
                                        <label for="brand_id">Brand</label>
                                        <select class="form-control" id="brand_id" name="brand_id">
                                            <option value="">--Select a brand--</option>

                                            @foreach($data['brands'] as $brand)
                                            @if($data['product']->brand_id === $brand->id)
                                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                            @else
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endif
                                            @endforeach

                                        </select>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label for="brand_id">Brand</label>
                                        <select class="form-control" id="brand_id" name="brand_id" disabled>
                                            <option value="">--Select a brand--</option>
                                        </select>
                                    </div>
                                    @endif

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="short_desc">Short Description</label>
                                        <textarea class="form-control" id="short_desc" name="short_desc"
                                                  rows="2">
                        {{isset($data['product']) ? $data['product']->short_desc : null}}
                    </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="short_desc">Long Description</label>
                                        <textarea class="form-control" id="long_desc" name="long_desc" rows="4">
                        {{isset($data['product']) ? $data['product']->long_desc : null}}
                    </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="name">Product Price</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->price : null}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="name">Discount Price</label>
                                        <input type="number" class="form-control" id="off_price" name="off_price"
                                               placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->off_price : null}}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">

                                    <div class="form-group">
                                        <label for="short_desc">Keywords</label>
                                        <textarea class="form-control" id="keywords" name="keywords" rows="1">
                        {{isset($data['product']) ? $data['product']->keywords : null}}
                    </textarea>
                                    </div>

                                </div>

                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">

                                                @if(isset($data['product']))
                                                @if($data['product']->in_stock)
                                                <input class="form-check-input" type="checkbox" value=1 checked
                                                       name="in_stock" id="in_stock">
                                                IN STOCK
                                                @else
                                                <input class="form-check-input" type="checkbox"
                                                       name="in_stock" id="in_stock">
                                                IN STOCK
                                                @endif
                                                @else
                                                <input class="form-check-input" type="checkbox" value=1 checked
                                                       name="in_stock" id="in_stock">
                                                IN STOCK
                                                @endif

                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="file-upload">
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" name="default_image" type='file'
                                                   onchange="readURL(this);"
                                                   accept="image/*"/>
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image"/>
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">
                                                    Remove <span
                                                        class="image-title">Uploaded Image</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>

                    </div>
                    <div class="tab-pane fade" id="product-version" role="tabpanel"
                         aria-labelledby="product-version-tab">

                        <form id="needs-validation" class="pt-2" enctype="multipart/form-data"
                              novalidate method="post"
                              action="{{isset($data['version']) ? route('version.update', $data['version']->id) : route('version.store')}}"
                              autocomplete="off">
                            @csrf
                            @if(isset($data['version']))
                            @method('PUT')
                            @endif
                            <input type="hidden" class="form-control" id="id" name="id"
                                   value="{{isset($data['version']) ? $data['version']->id : null}}">


                            <input type="hidden" class="form-control" id="product_id" name="product_id"
                                   value="{{isset($data['product']) ? $data['product']->id : null}}">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Version Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->name : null}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label for="">Features</label>
                                </div>
                            </div>

                            <div class="row">
                                @foreach($data['featureCategories'] as $featureCategory)

                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="name">{{$featureCategory->name}}</label>
                                        <select class="form-control" id="feature_category_{{$featureCategory->id}}"
                                                name="features[]">
                                            @foreach($featureCategory->features as $feature)
                                            <option value="{{$feature->id}}">{{$feature->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @endforeach

                            </div>

                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="name">Version Price</label>
                                        <input type="number" class="form-control" id="price" name="price" placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->price : null}}">
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="name">Discount Price</label>
                                        <input type="number" class="form-control" id="off_price" name="off_price"
                                               placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->off_price : null}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                @for($i=0; $i<3; $i++)
                                <div class="col-4">
                                    <div class="file-upload">
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" name="version_images[]" type='file'
                                                   onchange="readURL(this);"
                                                   accept="image/*"/>
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image"/>
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">
                                                    Remove <span
                                                        class="image-title">Uploaded Image</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor


                            </div>

                            <button class="btn btn-primary" type="submit">Save</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection


@section('js')
@parent

<script src="{{ asset('js/product.js') }}"></script>

@endsection
