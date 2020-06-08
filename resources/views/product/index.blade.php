@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <a href="{{ route('product.create') }}" type="button" class="btn btn-primary mb-4">
        <i class="fa fa-plus-circle"></i>&nbsp;Add Product
    </a>

    <table class="table table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['products'] as $product)

        <tr>
            <th scope="row">{{ $product->unique_id }}</th>
            <td>
                <img class="image" src="{{ $product->default_image }}" height="100px" width="150px"
                     alt="{{ $product->slug }}">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ isset($product->category) ? $product->category->name : ''}}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->in_stock ? 'Yes' : 'No' }}</td>
            <td class="d-inline-flex">
                <a type="button" class="btn btn-info mb-2" href="{{ route('product.edit', $product->id) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('product.delete', $product->id)}}" method="post">
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
</div>


@endsection

@section('js')
@parent

<script src="{{ asset('js/product.js') }}"></script>

@endsection
