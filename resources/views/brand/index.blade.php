@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <a href="{{ route('brand.create') }}" type="button" class="btn btn-primary mb-4">
        <i class="fa fa-plus-circle"></i>&nbsp;Add Brand
    </a>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Brand Categories</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['brands'] as $brand)

        <tr>
            <th scope="row">{{ $brand->id }}</th>
            <td>
                <img class="image" src="{{ $brand->image }}" height="50px" width="100px" alt="{{ $brand->slug }}">
            </td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->categoryNames}}</td>
            <td class="d-inline-flex">
                <a type="button" class="btn btn-info mb-2" href="{{ route('brand.edit', $brand->id) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('brand.delete', $brand->id)}}" method="post">
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
