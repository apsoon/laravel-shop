@extends('admin.layouts.app')
@section('title', '规格列表')
@section('content')
    <div class="container">
        @foreach($specifications as $specification)
            <tr role="row">
                <td class="sorting_1">{{ $specification->name }}</td>
                {{--                <td>{{ $category->describe }}</td>--}}
            </tr>
        @endforeach
    </div>
@endsection
