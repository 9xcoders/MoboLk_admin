@extends('layouts.base')

@section('content')


<div class="widget-content py-3">


    <div class="row">
        <div class="col-lg-12 widget-content py-2">


            <form id="needs-validation" class="pt-2" enctype="multipart/form-data"
                  novalidate method="post"
                  action="{{isset($data['version']) ? route('version.update', ['id' => $data['product']->id, 'versionId' => $data['version']->id]) : route('version.store', ['id' => $data['product']->id])}}"
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
                            <label for="name">Version Name *</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder=""
                                   value="{{isset($data['product']) ? $data['product']->name : null}}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('slug')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                @if(isset($data['product']))

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

                                @if($feature->selected)
                                <option value="{{$feature->id}}" selected>{{$feature->name}}
                                </option>
                                @else
                                <option value="{{$feature->id}}">{{$feature->name}}
                                </option>
                                @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

                    @endforeach

                </div>

                @endif

                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="name">Version Price *</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder=""
                                   value="{{isset($data['version']) ? $data['version']->price : $data['product']->price}}">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="name">Discount Price</label>
                            <input type="number" class="form-control" id="off_price" name="off_price"
                                   placeholder=""
                                   value="{{isset($data['version']) ? $data['version']->off_price : $data['product']->off_price}}">
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">

                                    @if(isset($data['version']))
                                    @if($data['version']->in_stock)
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


                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button class="btn btn-primary" type="submit">Save</button>

            </form>

            @if(isset($data['version']))
            <div class="row mt-4">

                <div class="col-12">
                    <h4 class="text-dark">Available Images</h4>
                </div>

                <div class="col-12">

                    @if(count($data['version']->productImages)>0)

                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['version']->productImages as $image)

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

                    <h6 class="text-danger">No version image available</h6>

                    @endif
                </div>

            </div>

            @endif


        </div>
    </div>

</div>

@endsection


@section('js')
@parent
<script src="{{ asset('js/product.js') }}"></script>
@endsection
