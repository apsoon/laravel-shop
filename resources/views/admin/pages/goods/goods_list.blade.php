@extends('admin.layouts.app')
@section('title', '商品列表')
@section('content')
    <div class="content">
        <div class="col-xs-12">
            <div class="box table-primary">
                <div class="box-header">
                    <a href="{{ url("goods/add") }}">
                        <button type="button" class="btn btn-sm btn-info btn-flat">添加商品</button>
                    </a>
                    <button type="button" class="btn btn-sm btn-success btn-flat">批量上架</button>
                    <button type="button" class="btn btn-sm btn-warning btn-flat">批量下架</button>
                    <button type="button" class="btn btn-sm btn-danger  btn-flat">批量删除</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width: 40px;">
                                <label>
                                    <input type="checkbox">
                                </label>
                            </th>
                            <th style="width: 150px;">分类</th>
                            <th>名称</th>
                            <th style="width: 150px;">品牌</th>
                            <th style="width: 270px">操作</th>
                        </tr>
                        @foreach($goodsList as $goods)
                            <tr role="row">
                                <td>
                                    <label>
                                        <input type="checkbox">
                                    </label>
                                </td>
                                <td>{{ $goods->category_id }}</td>
                                <td>{{ $goods->name }}</td>
                                <td>{{ $goods->brand_id }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-flat">详情</button>
                                    <button type="button" class="btn btn-info btn-flat">修改</button>
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
