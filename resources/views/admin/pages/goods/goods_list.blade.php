@extends('admin.layouts.app')
@section('title', '商品管理')
@section('subtitle', '商品列表')
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="{{ url("goods/add") }}">
                <button type="button" class="btn btn-sm btn-info btn-flat">添加商品</button>
            </a>
            <button type="button" class="btn btn-sm btn-success btn-flat">批量上架</button>
            <button type="button" class="btn btn-sm btn-warning btn-flat">批量下架</button>
            <button type="button" class="btn btn-sm btn-danger  btn-flat">批量删除</button>
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
        <div class="box-body no-padding table-responsive">
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
                            <a href="{{ url("goods/detail?goods_id=")}}{{$goods->id}}">
                                <button type="button"
                                        class="btn btn-success btn-flat">详情
                                </button>
                            </a>
                            <button type="button" class="btn btn-info btn-flat">修改</button>
                            <button type="button" class="btn btn-danger  btn-flat">删除</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <script type="text/javascript">
        function navigateToDetail(goodsId, url) {
            console.info(goodsId, url);
        }
    </script>
@endsection
