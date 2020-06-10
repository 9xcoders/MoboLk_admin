@extends('layouts.base')

@section('content')


<div class="widget-content py-3">

    <a href="{{ route('hot-deal.create') }}" type="button" class="btn btn-primary mb-4">
        <i class="fa fa-plus-circle"></i>&nbsp;Add Deal
    </a>

    @if(count($data['hotDeals']) > 0)
    <table class="table">
        <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data['hotDeals'] as $deal)

        <tr>
            <td>
                <img class="image" src="{{ $deal->image_url }}" height="50px" width="100px" alt="{{ $deal->title }}">
            </td>
            <td>{{ $deal->title }}</td>
            <td>{{ $deal->description}}</td>
            <td class="d-inline-flex">
                <a type="button" class="btn btn-info mb-2" href="{{ route('hot-deal.edit', $deal->id) }}">
                    <i class="fa fa-edit"></i>
                </a>

                <form action="{{ route('hot-deal.delete', $deal->id)}}" method="post">
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
    <h4 class="alert-danger">No deals available</h4>
    @endif


</div>


@endsection
