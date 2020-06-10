@extends('layouts.base')

@section('content')


<div class="widget-content py-3">


    <div class="row">
        <div class="col-lg-12 widget-content py-2">

            <div class="row">
                <div class="col-12">
                    @if(isset($data['product']))

                    @if(count($data['product']->productVersions) > 0)
                    <h5 class="text-info font-weight-bold">This product has
                        {{count($data['product']->productVersions)}} options</h5>
                    @endif
                    @endif
                </div>
            </div>

            <div class="bd-example bd-example-tabs">
                <ul class="nav nav-tabs" id="myTab1" role="tablist">

                    @if(!isset($isVersion))
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
                    @else
                    <li class="nav-item">
                        <a class="nav-link" id="info" data-toggle="tab" href="#product-info" role="tab"
                           aria-controls="Product Info" aria-selected="false">Product Info</a>
                    </li>
                    @if(isset($data['product']))
                    <li class="nav-item">
                        <a class="nav-link active" id="version" data-toggle="tab" href="#product-version" role="tab"
                           aria-controls="Version" aria-selected="false">Options</a>
                    </li>
                    @endif
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
                                        <label for="name">Product Name *</label>
                                        <input required type="text" class="form-control" id="name" name="name"
                                               placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->name : null}}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('slug')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-3 d-inline d-inline-block">
                                    <div class="form-group">
                                        <label for="brand_id">Category *</label>
                                        <select required class="form-control" id="category_id" name="category_id">
                                            <option value="">--Select a category--</option>
                                            @foreach($data['categories'] as $category)

                                            @if(isset($data['product']))
                                            @if($data['product']->category_id == $category->id)
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
                                        <label for="short_desc">Short Description *</label>
                                        <textarea required class="form-control" id="short_desc" name="short_desc"
                                                  rows="2">
                        {{isset($data['product']) ? $data['product']->short_desc : null}}
                    </textarea>
                                        @error('short_desc')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                        <label for="name">Product Price *</label>
                                        <input required type="number" class="form-control" id="price" name="price"
                                               placeholder=""
                                               value="{{isset($data['product']) ? $data['product']->price : null}}">
                                        @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
                                <div class="col-12 col-md-4 mb-4">

                                    <div class="input-group control-group increment">
                                        <input type="file" name="product_images[]" class="form-control">
                                        <div class="input-group-btn">
                                            <button id="btn-add-image" class="btn btn-success" type="button"><i
                                                    class="glyphicon glyphicon-plus"></i>Add
                                            </button>
                                        </div>
                                    </div>
                                    <div class="clone" style="display:none">
                                        <div class="control-group input-group" style="margin-top:10px">
                                            <input type="file" name="product_images[]" class="form-control">
                                            <div class="input-group-btn">
                                                <button id="btn-remove-image" class="btn btn-danger" type="button"><i
                                                        class="glyphicon glyphicon-remove"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    @error('product_images')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>


                        @if(isset($data['product']))
                        <div class="row mt-4">

                            <div class="col-12">
                                <h4 class="text-dark">Available Images</h4>
                            </div>

                            <div class="col-12">

                                @if(count($data['product']->productImages)>0)

                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['product']->productImages as $image)

                                    <tr>
                                        <td>
                                            <img class="image" src="{{ $image->image_url }}" height="100px"
                                                 width="150px"
                                                 alt="{{ $data['product']->slug }}">
                                        </td>
                                        <td>{{ $image->image_url }}</td>
                                        <td class="d-inline-flex">
                                            <form action="{{ route('product.deleteImage', $image->id)}}" method="post">
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

                                <h6 class="text-danger">No product image available</h6>

                                @endif
                            </div>

                        </div>

                        @endif

                    </div>
                    <div class="tab-pane fade" id="product-version" role="tabpanel"
                         aria-labelledby="product-version-tab">


                        @if(isset($data['product']))

                        <a href="{{ route('version.create', ['id' => $data['product']->id]) }}" type="button"
                           class="btn btn-primary mb-4 mt-4">
                            <i class="fa fa-plus-circle"></i>&nbsp;Add Option
                        </a>

                        @if(count($data['product']->productVersions)> 0)

                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data['product']->productVersions as $productVersion)

                            <tr>
                                <th scope="row">{{ $productVersion->unique_id }}</th>
                                <td>{{ $productVersion->name }}</td>
                                <td>{{ $productVersion->price }}</td>
                                <td>{{ $productVersion->in_stock ? 'Yes' : 'No' }}</td>
                                <td class="d-inline-flex">
                                    <a type="button" class="btn btn-info mb-2"
                                       href="{{ route('version.edit', [ 'versionId' => $productVersion->id, 'id' => $data['product']->id]) }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form
                                        action="{{ route('version.delete', [ 'versionId' => $productVersion->id, 'id' => $data['product']->id])}}"
                                        method="post">
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

                        <h5 class="text-danger">No options available</h5>

                        @endif

                        @endif
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
