@extends('admin.layouts.app')
@section('title', '商品列表')
@section('content')
    <div class="content">
        <div class="col-xs-12">
            <div class="box table-primary">
                <div class="box-header">
                    <a href="{{ url("goods/add") }}">
                        <button type="button" class="btn btn-sm btn-success btn-flat">添加商品</button>
                    </a>
                    <button type="button" class="btn btn-sm btn-danger  btn-flat">批量删除</button>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox">
                                </label>
                            </th>
                            <th>编号</th>
                            <th>分类</th>
                            <th>名称</th>
                            <th>原价格</th>
                            <th>现价</th>
                            <th>地区</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($goodsList as $goods)
                            <tr role="row">
                                <td>
                                    <label>
                                        <input type="checkbox">
                                    </label>
                                </td>
                                <td>{{ $goods->goods_id }}</td>
                                <td>{{ $goods->category }}</td>
                                <td>{{ $goods->name }}</td>
                                <td>{{ $goods->origin_price }}</td>
                                <td>{{ $goods->price }}</td>
                                <td>{{ $goods->state }}</td>
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
