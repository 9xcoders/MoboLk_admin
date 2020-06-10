@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <form id="needs-validation"
          novalidate method="post"
          action="{{route('top-selling.store')}}"
          autocomplete="off">

        @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <input type="hidden" id="product_id" name="product_id"/>
                    <label for="name">Product Name *</label>
                    <input type="text" class="form-control" id="autocomplete" placeholder="Search product..">
                    @error('product_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-12 col-md-6">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>

    </form>


    @if(count($data['topSellings']) >0)
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['topSellings'] as $topSelling)

        <tr>
            <th scope="row">{{ $topSelling->id }}</th>
            <td>{{ $topSelling->product->name }}</td>
            <td>{{ $topSelling->category->name}}</td>
            <td class="d-inline-flex">

                <form action="{{ route('top-selling.delete', $topSelling->id)}}" method="post">
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
    <h4 class="alert-danger">No top selling products available</h4>
    @endif
</div>


@endsection


@section('js')
@parent


<script src="{{ asset('js/top-selling.js') }}"></script>

@endsection
