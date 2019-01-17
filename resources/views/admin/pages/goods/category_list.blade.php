@extends('admin.layouts.app')
@section('title', '分类管理')
@section('title', '分类列表')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="{{ url("category/add") }}">
                    <button type="button" class="btn btn-sm btn-success btn-flat">添加分类</button>
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>上级分类</th>
                        <th>上级分类</th>
                        <th style="width: 270px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr role="row">
                            <td class="sorting_1">{{ $category->name }}</td>
                            {{--                <td>{{ $category->describe }}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
