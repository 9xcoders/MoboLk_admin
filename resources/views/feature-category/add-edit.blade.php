@extends('layouts.base')

@section('content')


<div class="widget-content py-3">
    <form id="needs-validation"
          novalidate method="post"
          action="{{isset($data['featureCategory']) ? route('feature-category.update', $data['featureCategory']->id) : route('feature-category.store')}}"
          autocomplete="off">
        @csrf
        @if(isset($data['featureCategory']))
        @method('PUT')
        @endif
        <input type="hidden" class="form-control" id="id" name="id"
               value="{{isset($data['featureCategory']) ? $data['featureCategory']->id : null}}">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="name">Category Name *</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                           value="{{isset($data['featureCategory']) ? $data['featureCategory']->name : null}}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-12 col-md-2">
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">

                            @if(isset($data['featureCategory']))
                            @if($data['featureCategory']->is_filter)
                            <input class="form-check-input" type="checkbox" value=1 checked
                                   name="in_stock" id="is_filter">
                            ADD AS FILTER
                            @else
                            <input class="form-check-input" type="checkbox"
                                   name="is_filter" id="is_filter">
                            ADD AS FILTER
                            @endif
                            @else
                            <input class="form-check-input" type="checkbox" value=1 checked
                                   name="is_filter" id="is_filter">
                            ADD AS FILTER
                            @endif

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>

    </form>


</div>


@endsection

@section('js')
@parent
@endsection
