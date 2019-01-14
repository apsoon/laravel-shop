@extends('admin.layouts.app')
@section('title', '分类列表')
@section('content')
    <div class="container">
        @foreach($categories as $category)
            <tr role="row">
                <td class="sorting_1">{{ $category->name }}</td>
                {{--                <td>{{ $category->describe }}</td>--}}
            </tr>
        @endforeach
    </div>
@endsection
