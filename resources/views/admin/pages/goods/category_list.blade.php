@extends('admin.layouts.app')
@section('title', '分类管理')
@section('subtitle','分类列表')
@section('content')
    <div class="container">
        <div class="col-xs-12">
            <div class="box table-striped">
                <div class="box-header">
                    <a href="{{ url("brand/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加品牌</button>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger  btn-flat">批量删除</button>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox">
                                </label>
                            </th>
                            <th>编号</th>
                            <th>品牌LOGO</th>
                            <th>名称</th>
                            <th>地区</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($brands as $brand)
                            <tr role="row">
                                <td>
                                    <label>
                                        <input type="checkbox">
                                    </label>
                                </td>
                                <td>{{ $brand->brand_id }}</td>
                                <td>{{ $brand->logo }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->region }}</td>
                                <td>{{ $brand->state }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-flat">详情</button>
                                    <button type="button" class="btn btn-info btn-flat">修改</button>
                                    <button type="button" class="btn btn-warning  btn-flat">下架</button>
                                    <button type="button" class="btn btn-danger  btn-flat">删除</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
