@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <a href="{{ route('feature-category.create') }}" type="button" class="btn btn-primary mb-4">
        <i class="fa fa-plus-circle"></i>&nbsp;Add Feature Category
    </a>

    @if(count($data['featureCategories'])> 0)

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>As Filter</th>
            <th>Features</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['featureCategories'] as $feature)

        <tr>
            <th scope="row">{{ $feature->id }}</th>
            <td>{{ $feature->name }}</td>
            <td>{{ $feature->is_filter ? 'YES' : 'NO' }}</td>
            <td>{{ $feature->featureNames}}</td>
            <td class="d-inline-flex">
                <a type="button" class="btn btn-info mb-2" href="{{ route('feature-category.edit', $feature->id) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('feature-category.delete', $feature->id)}}" method="post">
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
    <h4 class="alert-danger">No feature categories available</h4>

    @endif


</div>


@endsection
