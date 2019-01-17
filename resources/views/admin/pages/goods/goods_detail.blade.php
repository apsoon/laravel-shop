@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle','商品详情')
@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">商品信息</h3>
            </div>
            <div class="box-body">
                <b>商品名称</b> {{$detail->name}}<br>
                <b>商品简述</b> {{$detail->brief}}<br>
                <b>品牌</b> {{$detail->brand_id}} <br>
                <b>分类</b> {{$detail->category_id}}<br>
                <!-- 产品列表 -->
                {{--<div class="row">--}}
                <br>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">产品列表</h3>
                        <a href=" {{url("product/add?goods_id=")}}{{$detail->id}}&category_id={{$detail->category_id}}">
                            <button class="btn btn-info btn-flat pull-right">添加产品</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>产品名称</th>
                                    <th>规格参数</th>
                                    <th>原价</th>
                                    <th>现价</th>
                                    <th>状态</th>
                                    <th style="width: 270px">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productList as $product)
                                    <tr>
                                        <td>
                                            {{$product->name}}
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            {{$product->origin_price}}
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            {{$product->state}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-flat">详情</button>
                                            <button type="button" class="btn btn-info btn-flat">修改</button>
                                            <button type="button" class="btn btn-warning  btn-flat">下架</button>
                                            <button type="button" class="btn btn-danger  btn-flat">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
                <br>
                <!-- 轮播图 -->
                <div class="box table-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">轮播图</h3>
                        <a href=" {{url("product/add?goods_id=")}}{{$detail->id}}&category_id={{$detail->category_id}}">
                            <button class="btn btn-info btn-flat pull-right">添加图片</button>
                        </a>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 250px;">图片名称</th>
                                    <th>图片地址</th>
                                    <th style="width: 250px;">排序</th>
                                    <th style="width: 270px">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($productList as $product)
                                    <tr>
                                        <td>
                                            {{$product->name}}
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            {{$product->origin_price}}
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                        <td>
                                            {{$product->state}}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-flat">详情</button>
                                            <button type="button" class="btn btn-info btn-flat">修改</button>
                                            <button type="button" class="btn btn-warning  btn-flat">下架</button>
                                            <button type="button" class="btn btn-danger  btn-flat">删除</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
            <div class="box-footer">

            </div>
        </div>
    </div>
@endsection
