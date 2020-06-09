@extends('layouts.base')

@section('content')


<div class="widget-content py-3">
    <form id="needs-validation"
          novalidate method="post"
          action="{{isset($data['feature']) ? route('feature.update', $data['feature']->id) : route('feature.store')}}"
          autocomplete="off">
        @csrf
        @if(isset($data['feature']))
        @method('PUT')
        @endif
        <input type="hidden" class="form-control" id="id" name="id"
               value="{{isset($data['feature']) ? $data['feature']->id : null}}">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Feature Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                           value="{{isset($data['feature']) ? $data['feature']->name : null}}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">


                <div class="form-group">
                    <label for="brand_id">Category *</label>
                    <select class="form-control" id="feature_category_id" name="feature_category_id">
                        <option value="">--Select a category--</option>
                        @foreach($data['categories'] as $category)

                        @if(isset($data['feature']))
                        @if($data['feature']->feature_category_id === $category->id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif

                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif

                        @endforeach
                    </select>
                    @error('feature_category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>


</div>


@endsection

@section('js')
@parent
@endsection
